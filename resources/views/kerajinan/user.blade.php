@extends('layouts.app')

@section('content')

    <div class="container">
        @include('inc.messages')

        <div class="row">
            <div class="col-md-4 col-sm-12 col-xs-12">
                <h4>Kerajinan {{ $user->nama }}</h4>
                <hr class="new1"/>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <a href="{{ route('kerajinan.create') }}" class="btn btn-tambah">Tambah</a>
            </div>
        </div>

        @if (count ($user->getKerajinanUser) > 0)
        <div class="list-group">

            @foreach ($user->getKerajinanUser as $kerajinan)
                
                <a href="{{ route('kerajinan.edit', $kerajinan->id) }}" class="list-group-item list-group-item-action flex-column align-items-start mb-2 list-kerajinan-user">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ asset($kerajinan->gambar) }}" alt="" width="100%" class="mb-1 mt-1">
                        </div>

                        <div class="col-md-8">
                            <div class="row">
                                <div class="container title-list-laporan-group">
                                <div class="kiri">
                                    <h4>{{ $kerajinan->nama }}</h4>
                                </div>
                                <div class="kanan">
                                    {{ Form::open(['action' => ['App\Http\Controllers\KerajinanTanganController@destroy', $kerajinan->id], 'method' => 'POST', 'class' => 'pull-right']) }}
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
                </a>
            
            @endforeach
            
            {{ $kerajinan->paginate(5)->links() }}
        </div>

        @else
            
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <span class="text-danger font-medium" style="font-weight: 600">Kamu belum menawarkan produk kerajinan apapun. Ayo, <a href="{{ route('kerajinan.create') }}">tambahkan sekarang.</a></span>
                </div>
            </div>

        @endif

    </div>
    
@endsection