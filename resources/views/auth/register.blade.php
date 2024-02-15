@extends('auth.mainauth')

@section('title', config('app.name') . ' - ' . __('auth.reg_title'))

@section('container')
    <div class="container" data-aos="fade-up">
        <div class="row justify-content-center">
            <div class="col-lg-5 mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="100">
                <div class="card login-card">
                    <div class="card-body">
                        <h3 class="card-title mt-2 mb-5 text-center"><span class="text-bold fw-bold">Register</span></h3>
                        {{-- @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @elseif (session('warning'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{ session('warning') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @elseif (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif --}}
                        <form action="" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" placeholder="@lang('auth.name_placeholder')"
                                       value="{{ old('name') }}" required>
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="name">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="@lang('auth.email_placeholder')"
                                    value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="name">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="@lang('auth.password_placeholder')" required>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="name">Konfirmasi Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password2" name="password_confirmation" placeholder="@lang('auth.confirm_password_placeholder')" required>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- <!-- Gender Field -->
                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender">
                                    <option value="laki-laki" {{ old('gender') == 'laki-laki' ? 'selected' : '' }}>@lang('laki-laki')</option>
                                    <option value="perempuan" {{ old('gender') == 'perempuan' ? 'selected' : '' }}>@lang('perempuan')</option>
                                </select>
                                @error('gender')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Address Field -->
                            <div class="mb-3">
                                <label for="address">Alamat</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    id="address" name="address" placeholder="Isi alamat lengkap anda disini"
                                    value="{{ old('address') }}">
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Phone Number Field -->
                            <div class="mb-3">
                                <label for="phone_number">Nomor Telepon</label>
                                <input type="number" class="form-control @error('phone_number') is-invalid @enderror"
                                    id="phone_number" name="phone_number"
                                    placeholder="Masukkan nomor telepon anda (aktif WhatssApp)"
                                    value="{{ old('phone_number') }}">
                                @error('phone_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div> --}}

                            <!-- Submit Button -->
                            <div class="form-group d-flex align-items-center justify-content-center mt-3">
                                <button class="btn btn-primary mt-3 mb-2 " style="width: 85%" type="submit">@lang('auth.reg_title')</button>
                            </div>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a href="{{ url('login') }}">@lang('auth.login_link')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
