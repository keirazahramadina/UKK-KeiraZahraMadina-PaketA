<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\Petugas;
use App\Models\User;
use App\Models\Masyarakat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengaduan = Pengaduan::get();
        return view('pengaduan.show', compact('pengaduan'));
    }

    public function pengaduanku()
    {
        $username = Auth::user()->username;
        $masyarakat = Masyarakat::where('username', $username)->first();
        $nik = $masyarakat->nik;
        $pengaduan = Pengaduan::where('nik', $nik)->get();
        return view('pengaduan.show', compact('pengaduan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'masyarakat') {
                $user = Auth::user()->username;
                $masyarakat = Masyarakat::where('username', $user)->first();
                return view('pengaduan.add', compact('masyarakat'));
            }else{
                return redirect('/');
            }
        }
        return redirect('/login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'id_pengaduan',
            'tgl_pengaduan',
            'nama',
            'nik',
            'isi_laporan' => 'required',
            'foto' => 'nullable',
            'status'
        ]);
        // dd($request->hasFile('foto'));
        if($request->hasFile('foto')){
            $fileNameExt = $request->file('foto')->getClientOriginalName();
            $fileName = pathinfo($fileNameExt, PATHINFO_FILENAME);
            $ext = $request->file('foto')->getClientOriginalExtension();
            $saveName = $fileName .'_'. time().'.'.$ext;
            $path = $request->file('foto')->storeAs('public/pengaduan', $saveName);
        }else{
            $saveName = null;
        }

        $today = Carbon::now()->toDateString();
        $countPengaduan = Pengaduan::where('tgl_pengaduan', $today)->count();
        // $randomInt = rand(1000,9999);
        $user = Auth::user()->username;
        $masyarakat = Masyarakat::where('username', $user)->first();
        $pengaduanKu = Pengaduan::where('nik', $masyarakat->nik)->count();
        $nikPrefix = substr($masyarakat->nik, -3);
        $prefix = '1'.$nikPrefix .$pengaduanKu .$countPengaduan;


        $data['id_pengaduan'] = (int)$prefix;
        $data['tgl_pengaduan'] = $today;
        $data['nama'] = $masyarakat->nama;
        $data['nik'] = $masyarakat->nik;
        $data['foto'] = $saveName;
        $data['status'] = '0';

        // dd($data);

        Pengaduan::create($data);

        return redirect('/pengaduan');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function show(Pengaduan $pengaduan, $id)
    {
        $pengaduan = Pengaduan::where('id_pengaduan',$id)->first();
        $masyarakat = Masyarakat::where('nik', $pengaduan->nik)->first();
        // $tanggapan = Tanggapan::where('id_pengaduan', $id)->get();
        $tanggapan = Tanggapan::select('*')->join('petugas', 'petugas.id_petugas', '=', 'tanggapan.id_petugas')->where('tanggapan.id_pengaduan', $id)->get();
        // if ($tanggapan != null) {
        //     $petugas = Petugas::where('id_petugas', $tanggapan->id_petugas)->first();
        // }else{
        //     $petugas = null;
        // }
        // dd($pengaduan, $masyarakat);

        return view('pengaduan.detail', compact('pengaduan', 'masyarakat', 'tanggapan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengaduan $pengaduan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengaduan $pengaduan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengaduan $pengaduan, $id)
    {
        Pengaduan::Destroy($id);
        return redirect('/pengaduan');
    }
}
