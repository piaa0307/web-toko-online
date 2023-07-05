@extends('layouts.app')

@section('content')

    <div class="container">
        @include('inc.messages')
        <div class="row mb-1 d-flex justify-content-between">
            <div class="col-md-4">
                <h4>Keranjang Saya</h4>
                <hr class="new1"/>
            </div>
            {{-- <div class="col-md-2 mb-3 text-right">
                <a href="{{ route('order.index') }}" class="btn btn-beli-keranjang">Order</a>
            </div> --}}
        </div>

        @if (count($keranjang->getKeranjangKerajinan) > 0)
            
            @foreach ($keranjang->getKeranjangKerajinan as $kerajinan)
                <span class="list-group-item list-group-item-action flex-column align-items-start mb-2">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ asset($kerajinan->gambar) }}" alt="{{ $kerajinan->nama }}" width="100%" class="mb-1 mt-1">

                            {{ Form::open(['action' => 'App\Http\Controllers\OrderController@confirm', 'method' => 'POST', 'class' => 'pull-right']) }}
                            {{ Form::hidden('id_kerajinan', $kerajinan->id) }}
                            <select name="jumlah_barang" id="" class="form-control" style="color: orange; font-weight:600" onchange='if(this.value != 0) { this.form.submit(); }'>
                                <option selected disabled value="0">-Ingin Order? Pilih Jumlah Barang-</option>
                                @for($i = 1; $i <= $kerajinan->stok; $i++)
                                    <option value="{{ $i }}" class="font-black">{{ $i }}</option>
                                @endfor
                            </select>
                            {{ Form::close() }}
                        </div>

                        <div class="col-md-8">
                            <div class="row">
                                <div class="container title-list-laporan-group">
                                <div class="kiri">
                                    <a href="{{ route('kerajinan.show', $kerajinan->id) }}">
                                        <h4>{{ $kerajinan->nama }}</h4>
                                    </a>
                                </div>
                                <div class="kanan">
                                    {{ Form::open(['action' => ['App\Http\Controllers\KeranjangController@destroy', $kerajinan->id], 'method' => 'POST', 'class' => 'pull-right']) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    {{ Form::submit('Hapus', ['class' => 'btn btn-hapus', 'onclick' => 'return confirm("Konfirmasi penghapusan?");']) }}
                                    {{ Form::close() }}
                                </div>
                                </div>
                            </div>
                            <span class="font-medium font-semi-bold">Rp{{ number_format($kerajinan->harga) }}</span>
                            <br/>
                            <p class="font-medium">Tersisa {{ $kerajinan->stok }} barang</p>

                            <?php
                                if(strlen($kerajinan->deskripsi) > 200){
                                    $kerajinan->deskripsi=substr($kerajinan->deskripsi, 0, 200) . "...";
                                }
                            ?>
                            <span class="font-semi-medium">Deskripsi Produk Kerajinan:</span>
                            <p class="font-medium">{{ $kerajinan->deskripsi }}</p>
                        </div>
                    </div>
                </span>
            @endforeach
        @else

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <span class="font-medium" style="font-weight: 600">Kamu belum menambahkan apapun di keranjang kamu. Ayo, <a href="{{ route('kerajinan.index') }}">belanja sekarang.</a></span>
                </div>
            </div>

        @endif

    </div>
    
@endsection