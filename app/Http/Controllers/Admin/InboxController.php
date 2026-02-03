<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pesan;

class InboxController extends Controller
{
    /**
     * Tampilkan daftar pesan masuk
     */
    public function index(Request $request)
    {
        $query = Pesan::query();

        // Filter: Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%")
                    ->orWhere('pesan', 'like', "%{$search}%");
            });
        }

        // Filter: Status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Filter: Sort
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('tanggal', 'asc');
                break;
            case 'az':
                $query->orderBy('nama', 'asc');
                break;
            case 'za':
                $query->orderBy('nama', 'desc');
                break;
            case 'latest':
            default:
                $query->orderBy('tanggal', 'desc');
                break;
        }

        $messages = $query->paginate(30)->withQueryString();

        return view('admin.pages.interaction.messages.index', compact('messages'));
    }

    /**
     * Tampilkan detail pesan
     */
    public function show($id)
    {
        $message = Pesan::findOrFail($id);
        
        // Mark as read when opened if it's unread
        if ($message->status === 'unread') {
            $message->update(['status' => 'read']);
        }

        return view('admin.pages.interaction.messages.detail', ['message' => $message]);
    }

    /**
     * Hapus pesan
     */
    public function destroy($id)
    {
        $message = Pesan::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.interaksi.pesan-masuk.index')->with('success', 'Pesan berhasil dihapus');
    }

    /**
     * Tandai pesan sebagai sudah dibaca
     */
    public function markAsRead(Request $request, $id)
    {
        $message = Pesan::findOrFail($id);
        $message->update(['status' => 'read']);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pesan ditandai sebagai sudah dibaca',
                'status' => 'read'
            ]);
        }

        return redirect()->back()->with('success', 'Pesan ditandai sebagai sudah dibaca');
    }

    /**
     * Tandai pesan sebagai belum dibaca
     */
    public function markAsUnread(Request $request, $id)
    {
        $message = Pesan::findOrFail($id);
        $message->update(['status' => 'unread']);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pesan ditandai sebagai belum dibaca',
                'status' => 'unread'
            ]);
        }

        return redirect()->back()->with('success', 'Pesan ditandai sebagai belum dibaca');
    }

    /**
     * Tandai semua pesan sebagai sudah dibaca
     */
    public function markAllRead(Request $request)
    {
        Pesan::where('status', 'unread')->update(['status' => 'read']);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Semua pesan ditandai sebagai sudah dibaca'
            ]);
        }

        return redirect()->back()->with('success', 'Semua pesan telah ditandai sebagai sudah dibaca');
    }

    /**
     * Hapus pesan massal
     */
    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);
        
        if (empty($ids)) {
            return response()->json(['success' => false, 'message' => 'Tidak ada pesan yang dipilih']);
        }

        Pesan::whereIn('id', $ids)->delete();

        return response()->json(['success' => true, 'message' => count($ids) . ' pesan berhasil dihapus']);
    }

    /**
     * Update status pesan massal
     */
    public function bulkStatus(Request $request)
    {
        $ids = $request->input('ids', []);
        $status = $request->input('status'); // 'read' or 'unread'
        
        if (empty($ids) || !in_array($status, ['read', 'unread'])) {
            return response()->json(['success' => false, 'message' => 'Data tidak valid']);
        }

        Pesan::whereIn('id', $ids)->update(['status' => $status]);

        return response()->json(['success' => true, 'message' => 'Status pesan berhasil diperbarui', 'status' => $status]);
    }
}
