@extends('layouts.app')

@section('content')

    <div class="container">
        @include('inc.messages')

        <div class="row mb-3">
            <div class="col-md-5 col-sm-12 col-xs-12">
                <h4>Kerajinan Kategori {{ $kategori->nama }}</h4>
                <hr class="new1"/>
                <span>{{ $kategori->deskripsi }}</span>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <a href="{{ route('kerajinan.index') }}" class="btn btn-kategori">Kembali</a>
            </div>
        </div>

        @if (count ($kategori->getKerajinan) > 0)
            
            @foreach ($kategori->getKerajinan->chunk(3) as $chunk)

                <div class="row">
                    @foreach ($chunk as $kerajinan)
                        <div class="col-md-4 col-sm-12 col-xs-12" style="padding-bottom: 60px">
                        
                            <div class="card card-kerajinan">
                                <img class="card-img-top" src="{{ asset($kerajinan->gambar) }}" alt="Card image cap" height="50%">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $kerajinan->nama }}</h5>
                                    
                                    <?php
                                        if(strlen($kerajinan->deskripsi) > 80){
                                            $kerajinan->deskripsi=substr($kerajinan->deskripsi, 0, 80) . "...";
                                        }
                                    ?>
        
                                    <p class="card-text">{{ $kerajinan->deskripsi }}</p>
        
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
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <span class="text-danger" style="font-weight: 600">Belum ada produk kerajinan untuk kategori ini. Coba lihat produk-produk lainnya, ya!</span>
                </div>
            </div>

        @endif

    </div>

@endsection