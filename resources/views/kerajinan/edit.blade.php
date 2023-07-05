@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row mb-1">
            <div class="col-md-4">
                <h4>Edit {{ $kerajinan->nama }}</h4>
                <hr class="new1"/>
            </div>
        </div>

        {!! Form::open(['action' => ['App\Http\Controllers\KerajinanTanganController@update', $kerajinan->id], 'method' => 'POST', 'files' => true, 'enctype' => 'multipart/form-data']) !!}

            <div class="row">
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="gambar">Gambar produk Anda saat ini</label>

                        <img src="{{ asset($kerajinan->gambar) }}" id="gambar" alt="Gambar Produk Kerainan {{ $kerajinan->nama }}" width="100%">
                    </div>

                    <div class="form-group">
                        {{ Form::label('gambar', 'Ingin mengubah gambar?') }}
                        <br/>
                        {{ Form::file('gambar') }}
                    </div>
                </div>
            
                <div class="col-md-8">
                    <div class="form-group">
                        {{ Form::label('nama', 'Nama Kerajinan') }}
                        {{ Form::text('nama', $kerajinan->nama, ['class' => 'form-control', 'placeholder' => 'Nama Kerajinan...']) }}
                    </div>
        
                    <div class="form-group">
                        {{ Form::label('deskripsi', 'Deskripsi Kerajinan') }}
                        {{ Form::textarea('deskripsi', $kerajinan->deskripsi, ['class' => 'form-control', 'placeholder' => 'Deskripsi Kerajinan...']) }}
                    </div>
        
                    <div class="form-group">
                        {{ Form::label('id_kategori', 'Kategori Kerajinan') }}
                        <br/>
                        {{ Form::select('id_kategori', ['1' => 'Serat Alam', '2' => 'Daur Ulang', '3' => 'Tembikar'], $kerajinan->id_kategori, ['class' => 'form-select form-select-sm']) }}
                    </div>
        
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                {{ Form::label('harga', 'Harga') }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                            {{ Form::text('harga', $kerajinan->harga, ['class' => 'form-control', 'placeholder' => 'Harga...']) }}
                            </div>
                        </div>
                    </div>
        
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                {{ Form::label('stok', 'Stok') }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                            {{ Form::number('stok', $kerajinan->stok, ['class' => 'form-control', 'placeholder' => 'Stok...']) }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::hidden('_method', 'PUT') }} {{-- Penting untuk bagian edit --}}
                        {{ Form::submit('Edit Kerajinan', ['class' => 'btn btn-edit']) }}
                    </div>
                </div>

            </div>

        {!! Form::close() !!}
    </div>
    
@endsection