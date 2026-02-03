<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpmbPpdb;
use Illuminate\Http\Request;

class SpmbPpdbController extends Controller
{
    public function index()
    {
        $defaultYear = now()->year . '/' . (now()->year + 1);
        $years = range(now()->year - 2, now()->year + 5);

        $spmb = SpmbPpdb::query()->orderBy('id')->first();
        if (!$spmb) {
            $spmb = SpmbPpdb::create([
                'status' => 'closed',
                'tahun' => $defaultYear,
                'kuota' => null,
                'biaya' => 0,
            ]);
        }

        $sourceCandidate = SpmbPpdb::query()->get()->map(function ($row) {
            $score = 0;
            foreach ($row->getFillable() as $field) {
                $value = $row->{$field};
                if ($value === null) {
                    continue;
                }
                if (is_string($value) && trim($value) === '') {
                    continue;
                }
                $score++;
            }

            return [
                'row' => $row,
                'score' => $score,
            ];
        })->sort(function ($a, $b) {
            if ($a['score'] === $b['score']) {
                return $b['row']->id <=> $a['row']->id;
            }

            return $b['score'] <=> $a['score'];
        })->first();

        $source = $sourceCandidate['row'] ?? null;

        if ($source && $source->id !== $spmb->id) {
            $spmb->fill($source->only($spmb->getFillable()));
            $spmb->save();
        }

        SpmbPpdb::query()->where('id', '!=', $spmb->id)->delete();

        return view('admin.pages.spmb.index', compact('spmb', 'defaultYear', 'years'));
    }

    public function update(Request $request)
    {
        // Normalisasi input: ubah string kosong menjadi null agar validasi nullable berfungsi
        $input = $request->all();
        foreach ($input as $key => $value) {
            if (is_string($value) && trim($value) === '') {
                $request->merge([$key => null]);
            }
        }

        $rules = [
            'status' => 'nullable|in:open,pending,closed',
            'tahun' => ['nullable', 'string', 'max:9', 'regex:/^\d{4}\/\d{4}$/'],
            'kuota' => 'nullable|integer|min:0',
            'biaya' => 'nullable|integer|min:0',
        ];

        for ($wave = 1; $wave <= 2; $wave++) {
            for ($stage = 1; $stage <= 5; $stage++) {
                $rules["g{$wave}t{$stage}nm"] = 'nullable|string|max:255';
                $rules["g{$wave}t{$stage}st"] = 'nullable|date';
                $rules["g{$wave}t{$stage}en"] = 'nullable|date|after_or_equal:' . "g{$wave}t{$stage}st";
            }
        }

        $validated = $request->validate($rules);

        $defaultYear = now()->year . '/' . (now()->year + 1);
        $data = [
            'status' => $validated['status'] ?? 'closed',
            'tahun' => $validated['tahun'] ?? $defaultYear,
            'kuota' => $validated['kuota'] ?? null,
            'biaya' => $validated['biaya'] ?? null,
        ];

        for ($wave = 1; $wave <= 2; $wave++) {
            for ($stage = 1; $stage <= 5; $stage++) {
                $data["g{$wave}t{$stage}nm"] = $validated["g{$wave}t{$stage}nm"] ?? null;
                $data["g{$wave}t{$stage}st"] = $validated["g{$wave}t{$stage}st"] ?? null;
                $data["g{$wave}t{$stage}en"] = $validated["g{$wave}t{$stage}en"] ?? null;
            }
        }

        $spmb = SpmbPpdb::query()->orderBy('id')->first();
        if (!$spmb) {
            $spmb = new SpmbPpdb();
        }

        $spmb->fill($data);
        $spmb->save();

        SpmbPpdb::query()->where('id', '!=', $spmb->id)->delete();

        return redirect()->route('admin.spmb.index')->with('success', 'Pengaturan SPMB/PPDB berhasil diperbarui!');
    }
}
