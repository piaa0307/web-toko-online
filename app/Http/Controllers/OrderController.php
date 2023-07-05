<?php

namespace App\Http\Controllers;

use App\Models\KerajinanTangan;
use App\Models\Keranjang;
use App\Models\Order;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_user = Auth::user()->id;
        // $order = Order::where('id_pengguna', $id_user)->get();
        $order = Order::with('getKerajinan')->latest()->where('id_pengguna', $id_user)->get();
        
        return view('order.index', compact('order'));
        // return $order;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'id_kerajinan' => 'required',
            'jumlah_barang' => 'required',
        ]);

        $user = Auth::user();        
        $kerajinan = KerajinanTangan::find($request->input('id_kerajinan'));

        $order = new Order;

        $order->jumlah_barang = $request->input('jumlah_barang');
        $order->total_harga = $order->jumlah_barang * $kerajinan->harga;
        $order->status = 'Menunggu Pembayaran';
        $order->id_pengguna = $user->id;
        $order->id_kerajinan = $kerajinan->id ;

        $order->save();

        $kerajinan->stok -= $order->jumlah_barang;
        $kerajinan->save();
        
        return redirect()->route('order.index')->with('success', 'Berhasil membuat pesanan. Segera lakukan pembayaran');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with(['getKerajinan', 'getPengguna'])->find($id);
        $order->getKerajinan->getUser = KerajinanTangan::with(['getPengrajin', 'getKategori'])->find($order->getKerajinan->id);

        // return $order->getKerajinan->getUser->getPengrajin->nama;
        return view('order.detail', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'status' => 'required|string',
        ]);

        $order = Order::find($id);
        $order->status = $request->input('status');

        $order->save();

        return redirect()->route('order.show', $id)->with('succss', 'Status berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function confirm(Request $request)
    {
        $id_kerajinan = $request->input('id_kerajinan');
        
        $kerajinan = KerajinanTangan::with('getKategori', 'getPengrajin')->find($id_kerajinan);
        $kerajinan->jumlah_barang = $request->input('jumlah_barang');
        $kerajinan->harga_akhir = $kerajinan->harga * $kerajinan->jumlah_barang;

        $user = Auth::user();
        
        return view('order.confirm', compact(['kerajinan', 'user']));
    }

    public function pdf($id)
    {
        $user = Auth::user();
        $order = Order::with('getKerajinan')->find($id);
        $order->getKerajinan->getUser = KerajinanTangan::with(['getPengrajin', 'getKategori'])->find($order->getKerajinan->id);
        
        $pdf = PDF::loadView("order.pdf", compact(['order', 'user']));
        return $pdf->stream();
        // return $pdf->download("Order_$user->nama-id_order_$order->id-$order->waktu_dibuat.pdf");
    }

    public function pengrajin()
    {
        if(Auth::user()->hasRole('Pengrajin')){
            $user = Auth::user();

            // $kerajinan = KerajinanTangan::with('getOrder')->where('id_pengrajin', $user->id)->get();

            $order = Order::with(['getKerajinan', 'getPengguna'])->get();
            $order->getKerajinan = KerajinanTangan::with('getKategori')->where('id_pengrajin', $user->id);
            
            return view('order.pengrajin', compact('order'));
        }
    }
}
