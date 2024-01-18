@extends('auth.main')

@section('title', config('app.name') . ' - ' . __('auth.reg_title'))

@section('container')
    <div class="container" data-aos="fade-up">
        <div class="row justify-content-center">
            <div class="col-lg-7" data-aos="zoom-in" data-aos-delay="100">
                <div class="card bg-light o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-5">
                        <h3 class="text-center mb-3">@lang('auth.reg_title')</h3>
                        @if (session('error'))
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
                        @endif
                        <form action="" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">@lang('auth.name_label')</label>
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
                                <label for="email">@lang('auth.email_label')</label>
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
                                <label for="password">@lang('auth.password_label')</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="@lang('auth.password_placeholder')" required>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password2">@lang('auth.confirm_password_label')</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password2" name="password_confirmation" placeholder="@lang('auth.confirm_password_placeholder')" required>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <!-- Gender Field -->
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
                            </div>

                            <!-- Submit Button -->
                            <button class="btn btn-primary btn-block" type="submit">@lang('auth.reg_title')</button>
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
