<?php

namespace App\Http\Controllers;

use App\Models\KategoriKerajinan;
use App\Models\KerajinanTangan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KerajinanTanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:kerajinan-list|kerajinan-create|kerajinan-edit|kerajinan-delete', ['only' => ['index','show']]);
         $this->middleware('permission:kerajinan-create', ['only' => ['create','store']]);
         $this->middleware('permission:kerajinan-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:kerajinan-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kerajinan = KerajinanTangan::with('getPengrajin', 'getKategori')->latest()->paginate(6);
        return view('kerajinan.index')->with('kerajinan', $kerajinan);
        // return $kerajinan;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kerajinan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:10000',
            'id_kategori' => 'required',
        ]);
        
        $id_user = Auth::user()->id;

        $file = $request->file('gambar');
        $extension = $request->file('gambar')->guessExtension();
        $fileName = $request->input('nama') . '_' . date("d-m-Y_H-i-s") . '_' . $id_user . '.' . $extension;
        $fileDestination = 'uploaded/kerajinan';

        $file->move($fileDestination, $fileName);

        $kerajinan = new KerajinanTangan;
        $kerajinan->nama = $request->input('nama');
        $kerajinan->deskripsi = $request->input('deskripsi');
        $kerajinan->harga = $request->input('harga');
        $kerajinan->stok = $request->input('stok');
        $kerajinan->gambar = $fileDestination . '/' . $fileName;
        $kerajinan->id_kategori = $request->input('id_kategori'); // foreign key
        $kerajinan->id_pengrajin = $id_user; // foreign key

        $kerajinan->save();

        return redirect()->route('kerajinan.index')->with('success', 'Kerajinan Tangan Anda sudah ditayangkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kerajinan = KerajinanTangan::with('getKategori', 'getPengrajin')->find($id);
        
        return view('kerajinan.detail', compact('kerajinan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kerajinan = KerajinanTangan::with('getPengrajin')->find($id);
        
        $id_user = Auth::user()->id;

        if($kerajinan->getPengrajin->id != $id_user){
            return redirect()->route('kerajinan.show', $id)->with('error', 'Kamu tidak dapat meng-edit kerajinan yang bukan milikmu!');
        }

        return view('kerajinan.edit', compact('kerajinan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:10000',
            'id_kategori' => 'required',
        ]);

        $id_user = Auth::user()->id;

        if($request->file('gambar')){

            $file = $request->file('gambar');
            $extension = $request->file('gambar')->guessExtension();
            $fileName = $request->input('nama') . '_' . date("d-m-Y_H-i-s") . '_' . $id_user . '.' . $extension;
            $fileDestination = 'uploaded/kerajinan';

            $file->move($fileDestination, $fileName);
        }

        $kerajinan = KerajinanTangan::find($id);
        $kerajinan->nama = $request->input('nama');
        $kerajinan->deskripsi = $request->input('deskripsi');
        $kerajinan->harga = $request->input('harga');
        $kerajinan->stok = $request->input('stok');
        if($request->file('gambar')){
            $kerajinan->gambar = $fileDestination . '/' . $fileName;
        }
        $kerajinan->id_kategori = $request->input('id_kategori'); // foreign key
        $kerajinan->id_pengrajin = $id_user; // foreign key

        $kerajinan->save();
        
        return redirect()->route('kerajinan.index')->with('success', 'Berhasil mengedit kerajinan dengan nama ' . $kerajinan->nama);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kerajinan = KerajinanTangan::find($id);

        $id_user = Auth::user()->id;
        
        if($kerajinan->getPengrajin->id != $id_user){
            return redirect()->route('kerajinan.show', $id)->with('error', 'Kamu tidak dapat menghapus kerajinan yang bukan milikmu!');
        }

        $kerajinan->delete();

        return redirect()->route('kerajinan.index')->with('success', 'Berhasil menghapus produk kerajinan.');
    }

    public function perKategori($id)
    {
        $kategori = KategoriKerajinan::with('getKerajinan')->find($id);
        $kategori->getKerajinan = $kategori->getKerajinan()->orderBy('waktu_dibuat', 'desc')->paginate(6);

        return view('kerajinan.kategori', compact('kategori'));
    }

    public function user()
    {
        $id_user = Auth::user()->id;

        $user = User::with('getKerajinanUser')->find($id_user);
        $user->getKerajinanUser = $user->getKerajinanUser()->orderBy('waktu_dibuat', 'desc')->paginate(5);
        
        return view('kerajinan.user', compact('user'));
    }
    
}
