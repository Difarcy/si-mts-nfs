<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Tampilkan halaman galeri foto
     */
    public function index()
    {
        return view('admin.pages.media.photo.index');
    }

    /**
     * Tampilkan halaman tambah foto (jika diperlukan diluar modal)
     */
    public function create()
    {
        return view('admin.pages.media.photo.index'); // Sementara redirect ke index karena pakai modal
    }

    /**
     * Tampilkan halaman edit foto
     */
    public function edit($id)
    {
        return view('admin.pages.media.photo.index'); // Sementara redirect ke index
    }
}
