@extends('layouts.app')

@section('content')
    
    <div class="container">
        <div class="row mb-1">
            <div class="col-md-4">
                <h4>Tambah Kerajinan Tangan</h4>
                <hr class="new1"/>
            </div>
        </div>
        
        @include('inc.messages')

        {!! Form::open(['action' => 'App\Http\Controllers\KerajinanTanganController@store', 'files' => true, 'enctype' => 'multipart/form-data']) !!}

        <div class="form-group">
            {{ Form::label('nama', 'Nama Kerajinan') }}
            {{ Form::text('nama', '', ['class' => 'form-control', 'placeholder' => 'Nama Kerajinan...']) }}
        </div>

        <div class="form-group">
            {{ Form::label('deskripsi', 'Deskripsi Kerajinan') }}
            {{ Form::textarea('deskripsi', '', ['class' => 'form-control', 'placeholder' => 'Deskripsi Kerajinan...']) }}
        </div>

        <div class="form-group">
            {{ Form::label('id_kategori', 'Kategori Kerajinan') }}
            <br/>
            {{ Form::select('id_kategori', ['1' => 'Serat Alam', '2' => 'Daur Ulang', '3' => 'Tembikar'], null, ['class' => 'form-select form-select-sm']) }}
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-2">
                    {{ Form::label('harga', 'Harga') }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                {{ Form::text('harga', '', ['class' => 'form-control', 'placeholder' => 'Harga...']) }}
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
                {{ Form::number('stok', '', ['class' => 'form-control', 'placeholder' => 'Stok...']) }}
                </div>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('gambar', 'Gambar') }}
            <br/>
            {{ Form::file('gambar') }}
        </div>
        
        <br/>
        
        {{ Form::submit('Tambah Kerajinan', ['class' => 'btn btn-success']) }}

        {!! Form::close() !!}
    </div>


@endsection