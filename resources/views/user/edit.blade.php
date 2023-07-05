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
        <div class="row">
           <div class="col-md-12">
                <form method="POST" action="{{ route('users.update', $user) }}">
                    @csrf
                    @method('patch')
                    <div class="form-group row">
                        <label for="nama" class="col-md-4 col-form-label label-auth">{{ __('Nama') }}</label>

                        <div class="col-md-6">
                            <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $user->nama }}"  autocomplete="nama" autofocus>

                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label label-auth">{{ __('Alamat Email') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}"  autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="no_telp" class="col-md-4 col-form-label label-auth">{{ __('Nomor Telp.') }}</label>

                        <div class="col-md-6">
                            <input id="no_telp" type="text" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ $user->no_telp }}"  autocomplete="no_telp" autofocus>

                            @error('no_telp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="alamat" class="col-md-4 col-form-label label-auth">{{ __('Alamat') }}</label>

                        <div class="col-md-6">
                            <textarea id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}"  autocomplete="alamat" autofocus>{{ $user->alamat }}</textarea>

                            @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="no_rek" class="col-md-4 col-form-label label-auth">{{ __('Nomor Rekening') }}</label>

                        <div class="col-md-6">
                            <input id="no_rek" type="text" class="form-control @error('no_rek') is-invalid @enderror" name="no_rek" value="{{ $user->no_rek }}"  autocomplete="no_rek" autofocus>

                            @error('no_rek')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label label-auth">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="password-confirm" class="col-md-4 col-form-label label-auth">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <button type="submit" class="btn-auth">
                                {{ __('Edit') }}
                            </button>
                        </div>
                    </div>
                    
                </form>
           </div>
        </div>
    </div>
@endsection