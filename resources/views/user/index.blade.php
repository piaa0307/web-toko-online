@extends('layouts.app')

@section('content')


<div class="container">
    @include('inc.messages')
    <div class="row mb-1">
        <div class="col-md-4">
            <h4>Profil Saya</h4>
            <hr class="new1"/>
        </div>
    </div>

    <ul class="list-group list-group-display-user mb-3">
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-4">
                    <span class="font-bold">Nama Lengkap</span>
                </div>
                <div class="col-md-8">
                    <span>{{ $user->nama }}</span>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-4">
                    <span class="font-bold">Alamat Email</span>
                </div>
                <div class="col-md-8">
                    <span>{{ $user->email }}</span>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-4">
                    <span class="font-bold">Nomor Telepon</span>
                </div>
                <div class="col-md-8">
                    <span>{{ $user->no_telp }}</span>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-4">
                    <span class="font-bold">Alamat Rumah</span>
                </div>
                <div class="col-md-8">
                    <span>{{ $user->alamat }}</span>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-4">
                    <span class="font-bold">Nomor Rekening</span>
                </div>
                <div class="col-md-8">
                    <span>{{ $user->no_rek }}</span>
                </div>
            </div>
        </li>
    </ul>

    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('users.edit', Auth::user()->id) }}" class="btn btn-edit">Edit Profil</a>
        </div>
    </div>

</div>
@endsection