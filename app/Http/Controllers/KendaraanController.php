<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kendaraan;
class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        {
            $data = Kendaraan::all();
            return view('kendaraan/index', compact('data'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        {
            
            return view('kendaraan/create');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Kendaraan::create([
            'merek' => $request->input('merek'),
            'model' => $request->input('model'),
            'tarif' => $request->input('tarif'),
            'noplat' => $request->input('noplat'),
            // Tambahkan kolom lain jika diperlukan
        ]);

        return redirect()->route('kelolakendaraan.index')->with('success', 'Data berhasil ditambahkan!');
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
        $data = Kendaraan::find($id);
        return view('kendaraan/edit', compact('data'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data input jika diperlukan
        $request->validate([
            'merek' => 'required',
            'model' => 'required',
            'noplat' => 'required',
            'tarif' => 'required|numeric',
        ]);

        // Update data dalam database
        Kendaraan::where('id', $id)->update([
            'merek' => $request->input('merek'),
            'model' => $request->input('model'),
            'noplat' => $request->input('noplat'),
            'tarif' => $request->input('tarif'),
            // Tambahkan kolom lain jika diperlukan
        ]);

        return redirect()->route('kelolakendaraan.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Kendaraan::find($id);

        $data->delete();

        return redirect()->route('kelolakendaraan.index')->with('success', 'Data berhasil dihapus!');
    }
    
}
