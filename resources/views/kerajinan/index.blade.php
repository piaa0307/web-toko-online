@extends('layouts.app')

@section('content')
    
    <div class="container">
        @include('inc.messages')    


        <div class="row">
            <div class="col-md-4 col-sm-12 col-xs-12">
                <h4>Kerajinan Tangan</h4>
                <hr class="new1"/>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-2 col-sm-12 col-xs-12 mb-1" style="margin-right: -35px">
                <a href="{{ route('kerajinan.kategori', 1) }}" class="btn btn-kategori">Serat Alam</a>
            </div>
            <div class="col-md-2 col-sm-12 col-xs-12 mb-1" style="margin-right: -35px">
                <a href="{{ route('kerajinan.kategori', 2) }}" class="btn btn-kategori">Daur Ulang</a>
            </div>
            <div class="col-md-1 col-sm-12 col-xs-12 mb-1">
                <a href="{{ route('kerajinan.kategori', 3) }}" class="btn btn-kategori">Tembikar</a>
            </div>
        </div>

        @if(count($kerajinan) > 0)

        @foreach($kerajinan->chunk(3) as $chunk)        
            
            <div class="row">
                @foreach($chunk as $kerajinan)
                <div class="col-md-4 col-sm-12 col-xs-12" style="padding-bottom: 60px">
                    
                    <div class="card card-kerajinan">
                        <img class="card-img-top" src="{{ asset($kerajinan->gambar) }}" alt="Card image cap" height="50%">
                        <div class="card-body">
                            <span class="card-title font-semi-large font-semi-bold">{{ $kerajinan->nama }}</span>
                            <br/>
                            <span>Bahan {{ $kerajinan->getKategori->nama }}</span>
                            
                            <?php
                                if(strlen($kerajinan->deskripsi) > 80){
                                    $kerajinan->deskripsi=substr($kerajinan->deskripsi, 0, 80) . "...";
                                }
                            ?>
                            <p class="card-text">{{ $kerajinan->deskripsi }}</p>

                            <label class="font-medium font-semi-bold">Rp{{ number_format($kerajinan->harga) }}</label>

                            <div class="row">
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <a href="{{ route('kerajinan.show', $kerajinan->id) }}" class="btn btn-detail">Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                @endforeach
            </div>

        @endforeach
        {{ $kerajinan->paginate(6)->links() }}

        @else
            <div class="row">
                <div class="col-md-6">
                    <b>Waduh, belum ada produk kerajinan yang ditawarkan oleh para pengrajin.</b>
                    <p>Tetap ditunggu, ya!</p>
                </div>
            </div>

        @endif

    </div>

@endsection