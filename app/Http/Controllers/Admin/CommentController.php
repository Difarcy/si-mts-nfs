<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Artikel;
use App\Models\Berita;
use App\Models\Komentar;
use App\Models\Pengumuman;
use App\Models\PrestasiSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Kontak;

class CommentController extends Controller
{
    protected function unreadCount(): int
    {
        return Komentar::where('is_read', false)
            ->where('author_type', '!=', 'admin')
            ->count();
    }

    /**
     * Tampilkan daftar komentar
     */
    public function index(Request $request)
    {
        $query = Komentar::query()
            ->where('author_type', '!=', 'admin')
            ->select('komentar.*');

        if ($request->filled('search')) {
            $search = trim((string) $request->search);
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('isi', 'like', "%{$search}%")
                    ->orWhereExists(function ($sub) use ($search) {
                        $sub->selectRaw('1')
                            ->from('komentar as k2')
                            ->whereColumn('k2.thread_id', 'komentar.id')
                            ->where(function ($sq) use ($search) {
                                $sq->where('nama', 'like', "%{$search}%")
                                    ->orWhere('email', 'like', "%{$search}%")
                                    ->orWhere('isi', 'like', "%{$search}%");
                            });
                    });
            });
        }

        if ($request->filled('status') && in_array($request->status, ['pending', 'approved'], true)) {
            $query->where('status', $request->status);
        }

        $sort = $request->get('sort', 'latest');
        if ($sort === 'oldest') {
            $query->orderBy('tanggal', 'asc');
        } elseif ($sort === 'az') {
            $query->orderBy('nama', 'asc');
        } elseif ($sort === 'za') {
            $query->orderBy('nama', 'desc');
        } else {
            $query->orderBy('tanggal', 'desc');
        }

        $comments = $query->paginate(30)->withQueryString();

        $totalCount = Komentar::count();
        $pendingCount = Komentar::where('status', 'pending')->count();
        $approvedCount = Komentar::where('status', 'approved')->count();
        $unreadCount = $this->unreadCount();

        return view('admin.pages.interaction.comments.index', compact('comments', 'totalCount', 'pendingCount', 'approvedCount', 'unreadCount'));
    }

    /**
     * Tampilkan detail komentar
     */
    public function show($id)
    {
        $comment = Komentar::findOrFail($id);

        $threadId = $comment->thread_id ?? $comment->id;
        $threadRoot = Komentar::find($threadId) ?? $comment;

        // Mark only the specific comment being viewed as read
        $comment->update(['is_read' => true]);
        $thread = Komentar::where('thread_id', $threadId)
            ->withCount(['likedByAdmins', 'likedByPublic'])
            ->orderBy('tanggal', 'asc')
            ->get();

        $contentInfo = $this->resolveContentInfo($threadRoot->konten_tipe, $threadRoot->konten_id);

        $likedMap = [];
        if (Auth::check()) {
            $likedIds = DB::table('komentar_like')
                ->where('user_id', Auth::id())
                ->whereIn('komentar_id', $thread->pluck('id'))
                ->pluck('komentar_id')
                ->all();

            $likedMap = array_fill_keys($likedIds, true);
        }

        $likeCounts = $thread
            ->mapWithKeys(function ($item) {
                return [$item->id => $item->total_likes];
            })
            ->all();

        return view('admin.pages.interaction.comments.detail', compact('comment', 'threadRoot', 'thread', 'contentInfo', 'likedMap', 'likeCounts'));
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'isi' => ['required', 'string', 'max:5000'],
            'nama' => ['nullable', 'string', 'max:100'],
        ]);

        $target = Komentar::findOrFail($id);
        $threadId = $target->thread_id ?? $target->id;
        $threadRoot = Komentar::find($threadId) ?? $target;

        $admin = Auth::user();
        $displayName = trim((string) $request->input('nama'));
        if ($displayName === '') {
            $displayName = $admin?->nama ?? 'Admin';
        }

        $reply = Komentar::create([
            'konten_tipe' => $threadRoot->konten_tipe,
            'konten_id' => $threadRoot->konten_id,
            'thread_id' => $threadId,
            'parent_id' => $target->id,
            'nama' => $displayName,
            'email' => (Kontak::first()?->email ?: ($admin?->username ? ($admin->username . '@admin.local') : 'admin@admin.local')),
            'isi' => $request->input('isi'),
            'status' => 'approved',
            'is_read' => true,
            'tanggal' => now(),
            'author_type' => 'admin',
        ]);

        return response()->json([
            'success' => true,
            'item_html' => view('admin.partials.interaction.comments.thread-item', [
                'item' => $reply,
                'likeCount' => 0,
                'liked' => false,
            ])->render(),
        ]);
    }

    public function toggleLike(Request $request, $id)
    {
        $comment = Komentar::findOrFail($id);
        $userId = Auth::id();

        $exists = $comment->likedByAdmins()->where('user_id', $userId)->exists();
        if ($exists) {
            $comment->likedByAdmins()->detach($userId);
        } else {
            $comment->likedByAdmins()->attach($userId);
        }

        $count = $comment->total_likes;

        return response()->json([
            'success' => true,
            'liked' => !$exists,
            'count' => $count,
        ]);
    }

    public function destroy($id)
    {
        $comment = Komentar::findOrFail($id);

        $threadId = $comment->thread_id ?? $comment->id;
        $isThreadRoot = ($comment->id === $threadId);

        if ($isThreadRoot) {
            $deleteIds = Komentar::where('thread_id', $threadId)->pluck('id')->all();
            if (count($deleteIds) > 0) {
                DB::transaction(function () use ($deleteIds) {
                    DB::table('komentar_like')->whereIn('komentar_id', $deleteIds)->delete();
                    Komentar::whereIn('id', $deleteIds)->delete();
                });
            }
        } else {
            DB::transaction(function () use ($comment) {
                DB::table('komentar_like')->where('komentar_id', $comment->id)->delete();
                $comment->delete();
            });
        }

        return redirect()->route('admin.interaksi.komentar.index')->with('success', 'Komentar berhasil dihapus');
    }

    private function resolveContentInfo(?string $type, $id): array
    {
        $info = [
            'type' => $type,
            'label' => null,
            'title' => null,
            'excerpt' => null,
            'url' => null,
        ];

        if (!$type || !$id)
            return $info;

        if ($type === 'news') {
            $model = Berita::find($id);
            $info['label'] = 'Berita';
            $info['title'] = $model?->judul;
            $info['excerpt'] = $model?->deskripsi ? trim(strip_tags((string) $model->deskripsi)) : null;
            $info['url'] = route('web.news.detail', ['berita' => $id]);
            return $info;
        }

        if ($type === 'article') {
            $model = Artikel::find($id);
            $info['label'] = 'Artikel';
            $info['title'] = $model?->judul;
            $info['excerpt'] = $model?->deskripsi ? trim(strip_tags((string) $model->deskripsi)) : null;
            $info['url'] = route('web.article.detail', ['artikel' => $id]);
            return $info;
        }

        if ($type === 'announcement') {
            $model = Pengumuman::find($id);
            $info['label'] = 'Pengumuman';
            $info['title'] = $model?->judul;
            $info['excerpt'] = $model?->deskripsi ? trim(strip_tags((string) $model->deskripsi)) : null;
            $info['url'] = route('web.announcement.detail', ['pengumuman' => $id]);
            return $info;
        }

        if ($type === 'agenda') {
            $model = Agenda::find($id);
            $info['label'] = 'Agenda';
            $info['title'] = $model?->judul;
            $info['excerpt'] = $model?->deskripsi ? trim(strip_tags((string) $model->deskripsi)) : null;
            $info['url'] = route('web.agenda.detail', ['agenda' => $id]);
            return $info;
        }

        if ($type === 'achievement') {
            $model = PrestasiSiswa::find($id);
            $info['label'] = 'Prestasi Siswa';
            $info['title'] = $model?->nama_lomba;
            $info['excerpt'] = $model?->deskripsi ? trim(strip_tags((string) $model->deskripsi)) : null;
            $info['url'] = route('web.achievement.detail', ['prestasiSiswa' => $id]);
            return $info;
        }

        return $info;
    }

    public function markAsRead(Request $request, $id)
    {
        $comment = Komentar::findOrFail($id);
        $threadId = $comment->thread_id ?? $comment->id;
        Komentar::query()->where('id', $threadId)->orWhere('thread_id', $threadId)->update(['is_read' => true]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'is_read' => true,
                'unreadCount' => $this->unreadCount(),
            ]);
        }

        return redirect()->back()->with('success', 'Komentar ditandai dibaca');
    }

    public function markAsUnread(Request $request, $id)
    {
        $comment = Komentar::findOrFail($id);
        $threadId = $comment->thread_id ?? $comment->id;
        Komentar::query()->where('id', $threadId)->orWhere('thread_id', $threadId)->update(['is_read' => false]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'is_read' => false,
                'unreadCount' => $this->unreadCount(),
            ]);
        }

        return redirect()->back()->with('success', 'Komentar ditandai belum dibaca');
    }

    public function markAsApproved(Request $request, $id)
    {
        $comment = Komentar::findOrFail($id);
        $comment->update(['status' => 'approved', 'is_read' => true]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'status' => 'approved',
                'is_read' => true,
                'unreadCount' => $this->unreadCount(),
                'pendingCount' => Komentar::whereColumn('id', 'thread_id')
                    ->where(function ($q) {
                        $q->where('status', 'pending')
                            ->orWhereExists(function ($sub) {
                                $sub->selectRaw('1')
                                    ->from('komentar as k2')
                                    ->whereColumn('k2.thread_id', 'komentar.id')
                                    ->where('k2.status', 'pending');
                            });
                    })
                    ->count(),
                'approvedCount' => Komentar::whereColumn('id', 'thread_id')
                    ->where('status', 'approved')
                    ->whereNotExists(function ($sub) {
                        $sub->selectRaw('1')
                            ->from('komentar as k2')
                            ->whereColumn('k2.thread_id', 'komentar.id')
                            ->where('k2.status', 'pending');
                    })
                    ->count(),
            ]);
        }

        return redirect()->back()->with('success', 'Komentar disetujui');
    }

    public function markAsPending(Request $request, $id)
    {
        $comment = Komentar::findOrFail($id);
        $comment->update(['status' => 'pending']);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'status' => 'pending']);
        }

        return redirect()->back()->with('success', 'Komentar dijadikan pending');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return response()->json(['success' => false, 'message' => 'Tidak ada komentar yang dipilih']);
        }

        $comments = Komentar::query()
            ->whereIn('id', $ids)
            ->get(['id', 'thread_id']);

        $selectedRootIds = $comments
            ->filter(function ($comment) {
                $rootId = $comment->thread_id ?? $comment->id;
                return $comment->id === $rootId;
            })
            ->pluck('id')
            ->values()
            ->all();

        $deleteIds = $comments->pluck('id')->all();

        if (count($selectedRootIds) > 0) {
            $threadIds = Komentar::query()
                ->whereIn('thread_id', $selectedRootIds)
                ->pluck('id')
                ->all();
            $deleteIds = array_merge($deleteIds, $threadIds);
        }

        $deleteIds = array_values(array_unique($deleteIds));

        if (count($deleteIds) > 0) {
            DB::transaction(function () use ($deleteIds) {
                DB::table('komentar_like')->whereIn('komentar_id', $deleteIds)->delete();
                Komentar::whereIn('id', $deleteIds)->delete();
            });
        }

        return response()->json([
            'success' => true,
            'message' => count($ids) . ' komentar berhasil dihapus',
            'unreadCount' => $this->unreadCount(),
        ]);
    }

    public function bulkRead(Request $request)
    {
        $ids = $request->input('ids', []);
        $isRead = $request->input('is_read');

        if (empty($ids) || !in_array($isRead, [0, 1, '0', '1', true, false], true)) {
            return response()->json(['success' => false, 'message' => 'Data tidak valid']);
        }

        // Collect all affected thread IDs
        $comments = Komentar::whereIn('id', $ids)->get();
        $targetIds = [];

        foreach ($comments as $comment) {
            $threadId = $comment->thread_id ?? $comment->id;
            // Add root
            $targetIds[] = $threadId;
        }
        $targetIds = array_unique($targetIds);

        // Update roots and their children
        Komentar::where(function ($q) use ($targetIds) {
            $q->whereIn('id', $targetIds)
                ->orWhereIn('thread_id', $targetIds);
        })->update(['is_read' => (bool) $isRead]);

        return response()->json([
            'success' => true,
            'is_read' => (bool) $isRead,
            'unreadCount' => $this->unreadCount(),
        ]);
    }

    public function bulkStatus(Request $request)
    {
        $ids = $request->input('ids', []);
        $status = $request->input('status');

        if (empty($ids) || !in_array($status, ['pending', 'approved'], true)) {
            return response()->json(['success' => false, 'message' => 'Data tidak valid']);
        }

        $payload = ['status' => $status];
        if ($status === 'approved') {
            $payload['is_read'] = true;
        }

        // Collect all affected thread IDs to ensure full thread update
        $comments = Komentar::whereIn('id', $ids)->get();
        $targetIds = [];

        foreach ($comments as $comment) {
            $threadId = $comment->thread_id ?? $comment->id;
            $targetIds[] = $threadId;
        }
        $targetIds = array_unique($targetIds);

        // Update roots and their children
        Komentar::where(function ($q) use ($targetIds) {
            $q->whereIn('id', $targetIds)
                ->orWhereIn('thread_id', $targetIds);
        })->update($payload);

        return response()->json([
            'success' => true,
            'status' => $status,
            'unreadCount' => $this->unreadCount(),
            'pendingCount' => Komentar::whereColumn('id', 'thread_id')
                ->where(function ($q) {
                    $q->where('status', 'pending')
                        ->orWhereExists(function ($sub) {
                            $sub->selectRaw('1')
                                ->from('komentar as k2')
                                ->whereColumn('k2.thread_id', 'komentar.id')
                                ->where('k2.status', 'pending');
                        });
                })
                ->count(),
            'approvedCount' => Komentar::whereColumn('id', 'thread_id')
                ->where('status', 'approved')
                ->whereNotExists(function ($sub) {
                    $sub->selectRaw('1')
                        ->from('komentar as k2')
                        ->whereColumn('k2.thread_id', 'komentar.id')
                        ->where('k2.status', 'pending');
                })
                ->count(),
        ]);
    }

    public function approveAll(Request $request)
    {
        $query = Komentar::query()->whereColumn('id', 'thread_id');

        if ($request->filled('search')) {
            $search = trim((string) $request->search);
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('isi', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status') && in_array($request->status, ['pending', 'approved'], true)) {
            $query->where('status', $request->status);
        }

        $query->where('status', 'pending')->update(['status' => 'approved', 'is_read' => true]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'unreadCount' => $this->unreadCount()]);
        }

        return redirect()->back()->with('success', 'Semua komentar berhasil disetujui');
    }

    public function markAllRead(Request $request)
    {
        $query = Komentar::query()->whereColumn('id', 'thread_id');

        if ($request->filled('search')) {
            $search = trim((string) $request->search);
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('isi', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status') && in_array($request->status, ['pending', 'approved'], true)) {
            $query->where('status', $request->status);
        }

        $updated = $query->where('is_read', false)->update(['is_read' => true]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'updated' => $updated, 'unreadCount' => $this->unreadCount()]);
        }

        return redirect()->back()->with('success', 'Semua komentar berhasil ditandai dibaca');
    }
}
