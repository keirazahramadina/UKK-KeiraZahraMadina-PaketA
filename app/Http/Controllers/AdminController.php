<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        $semuaPengaduan = Pengaduan::get();
        $notProcess = Pengaduan::where('status', '=', '0')->get();
        $process = Pengaduan::where('status', '=', 'proses')->get();
        $done = Pengaduan::where('status', '=', 'selesai')->get();
        return view('admin.show', compact('semuaPengaduan', 'notProcess', 'process', 'done'));
    }

    public function show($status) {
        switch ($status) {
            case 'semua':
                $data = Pengaduan::get();
                break;
            case 'belum-proses':
                $data = Pengaduan::where('status', '=', '0')->get();
                break;
            case 'proses':
                $data = Pengaduan::where('status', '=', 'proses')->get();
                break;
            case 'selesai':
                $data = Pengaduan::where('status', '=', 'selesai')->get();
                break;
            default:
                # code...
                break;
        }

        return view('admin.detail', compact('data'));
    }
}
