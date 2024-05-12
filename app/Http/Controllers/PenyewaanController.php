<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penyewaan;


class PenyewaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $iduser = $request->input('iduser');
        $idkendaraan = $request->input('idkendaraan');
        $tanggalsewa = $request->input('tanggalsewa');
        $tanggalkembali = $request->input('tanggalkembali');   
        $tanggalkembali = $request->input('tanggalkembali');   
     
        $isKendaraanSewa = Penyewaan::where('idkendaraan', $idkendaraan)
            ->where(function ($query) use ($tanggalsewa, $tanggalkembali) {
                $query->whereBetween('tanggalsewa', [$tanggalsewa, $tanggalkembali])
                    ->orWhereBetween('tanggalkembali', [$tanggalsewa, $tanggalkembali])
                    ->orWhere(function ($query) use ($tanggalsewa, $tanggalkembali) {
                        $query->where('tanggalsewa', '<=', $tanggalsewa)
                            ->where('tanggalkembali', '>=', $tanggalkembali)
                            ->where('status', 'disewa');
                    });
            })
            ->exists(); 
      
        if ($isKendaraanSewa) {
            return redirect()->back()->with('error', 'Mobil sedang disewa pada rentang tanggal yang dimasukkan.');
        }
         
        Penyewaan::create([
            'iduser' => $iduser,
            'idkendaraan' => $idkendaraan,
            'tanggalsewa' => $tanggalsewa,
            'tanggalkembali' => $tanggalkembali,
            'status'=>'disewa',
           
        ]);
    
        return redirect()->route('home')->with('success', 'Data berhasil ditambahkan!');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Update data dalam database
        Penyewaan::where('id', $id)->update([
            'totaltarif' => $request->input('totaltarif'),
            'status' => $request->input('status'),
            // Tambahkan kolom lain jika diperlukan
        ]);

        return redirect()->route('pengembalian')->with('success', 'Berhasil di Kembalikan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
