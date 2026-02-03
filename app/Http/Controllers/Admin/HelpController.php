<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HelpController extends Controller
{
    /**
     * Tampilkan halaman bantuan
     */
    public function index()
    {
        return view('admin.pages.help.index');
    }
}
