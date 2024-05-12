<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kendaraan;
use App\Models\Penyewaan;
use Carbon\Carbon;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Kendaraan::all();
        return view('home', compact('data'));
    }

    public function pengembalian()
    {
       
        return view('pengembalian');
    }

    
    public function search(Request $request)
{
    $noplat = $request->input('noplat');

    $data = Penyewaan::whereHas('kendaraan', function ($query) use ($noplat) {
        $query->where('noplat', 'LIKE', "%$noplat%")
              ->where('status', '=', 'disewa');
    })->get();
    foreach ($data as $penyewaan) {
        $tanggalSewa = Carbon::parse($penyewaan->tanggalsewa);
        $tanggalKembali = Carbon::parse($penyewaan->tanggalkembali);
    
        $selisihHari = $tanggalKembali->diffInDays($tanggalSewa);
    
        $tarif = $penyewaan->kendaraan->tarif;
    
        $totalBiaya = $selisihHari * $tarif;
    
        $penyewaan->total_biaya = $totalBiaya;
    }
    return view('pengembalian', compact('data'));
}
}
