@extends('layouts.app')

@section('content')
    
    <div class="container">
        @include('inc.messages')

        <div class="row">
            <div class="col-md-4 mb-2 col-sm-12 col-xs-12">
                <img src="{{ asset($kerajinan->gambar) }}" alt="Produk Kerajinan {{ $kerajinan->nama }}" width="100%">
            </div>
            
            <div class="col-md-6 mb-2 col-sm-12 col-xs-12">
                
                <h3 class="title-kerajinan mb-2">{{ $kerajinan->nama }}</h3>
                
                <hr class="new1">
                
                <div class="row mb-0">
                    <span class="col-md-12 col-sm-12 col-xs-12 font-medium">Dijual pertama kali pada {{ date('d-M-Y', strtotime($kerajinan->waktu_dibuat)) }}</span>
                </div>

                <div class="row">
                    <label class="col-md-4 harga-kerajinan">Rp{{ number_format($kerajinan->harga) }}</label>
                </div>

                <div class="row">
                    <span class="col-md-12 penjual-kerajinan font-medium">Hasil kerajinan ini merupakan karya dari <span class="nama-pengrajin-kerajinan">{{ $kerajinan->getPengrajin->nama }}</span></span>
                </div>

                <div class="row">
                    <label class="col-md-12 font-medium mb-3">Kategori Kerajinan : {{ $kerajinan->getKategori->nama }}</label>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label for="deskripsiKerajinan" class="font-medium">Deskripsi : </label>
                        <p id="deskripsiKerajinan" class="deskripsi-kerajinan font-medium"> {{ $kerajinan->deskripsi }}</p>
                    </div>
                </div>

            </div>
            
            <div class="col-md-2 bagian-kiri-kerajinan">
                
                <div class="row mb-2">
                    <span class="col-md-12 font-large">Stok : {{ $kerajinan->stok }}</span>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        {{ Form::open(['action' => ['App\Http\Controllers\KeranjangController@store'], 'method' => 'POST']) }}
                        {{ Form::hidden('id_kerajinan', $kerajinan->id) }}
                        {{ Form::submit('Beli', ['class' => 'btn btn-beli']) }}
                        {{ Form::close() }}
                    </div>
                </div>
                
                {{-- <div class="row mt-3">
                    <div class="col-md-12">
                        <a href="{{ route('kerajinan.edit', $kerajinan->id) }}" class="btn btn-edit">Edit</a>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        {{ Form::open(['action' => ['App\Http\Controllers\KerajinanTanganController@destroy', $kerajinan->id], 'method' => 'POST', 'class' => 'pull-right']) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::submit('Hapus', ['class' => 'btn btn-hapus']) }}
                        {{ Form::close() }}
                    </div>
                </div> --}}
                
            </div>
        </div>
        
    </div>

@endsection