<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Wisata;
class WisataController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wisatas = Wisata::all();
        return view('dashboard', compact('wisatas'));
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
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'tempat' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('gambar')) {
            $imageName = time().'.'.$request->gambar->extension();  
            $request->gambar->move(public_path('images'), $imageName);

            $wisata = new Wisata();
            $wisata->nama = $request->nama;
            $wisata->tempat = $request->tempat;
            $wisata->gambar = 'images/'.$imageName;
            $wisata->save();

            return redirect()->route('dashboard')->with('success', 'Wisata berhasil ditambahkan.');
        }

        return redirect()->back()->with('error', 'Gagal menambahkan wisata. Mohon pilih gambar.');
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
        $request->validate([
            'nama' => 'required',
            'tempat' => 'required',
        ]);

        $wisata = Wisata::find($id);
        $wisata->nama = $request->nama;
        $wisata->tempat = $request->tempat;

        if ($request->hasFile('gambar')) {
            $request->validate([
                'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $imageName = time().'.'.$request->gambar->extension();  
            $request->gambar->move(public_path('images'), $imageName);
            $wisata->gambar = 'images/'.$imageName;
        }

        $wisata->save();

        return redirect()->route('dashboard')->with('success', 'Wisata berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $wisata = Wisata::find($id);
        $wisata->delete();

        return redirect()->route('dashboard')->with('success', 'Wisata berhasil dihapus.');
    }
}

