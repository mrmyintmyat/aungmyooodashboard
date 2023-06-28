@extends('layouts.admin')
@section('style')
    <style>
        .hover_menu_tag a:nth-child(3) {
            border-left: 3px solid #ff0505 !important;
            background: rgba(255, 255, 255, 0.251);
        }
    </style>
@endsection
@section('page')
    <div class="card text-start mt-2 shadow-sm">
        <div class="card-body">
            <div class="border-bottom border-2">
                <h5 class="">CREATE USER</h5>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <form method="POST" action="{{ route('admin.store') }}" class="col-lg-6 col-12">
                    @csrf

                    <div class="row mb-3">
                        <label for="name" class="form-label">NAME</label>

                        <div class="">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror rounded-0" name="name" value="{{ old('name') }}" required value="{{ old('name') }}" autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>

                        <div class="">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror rounded-0" name="email" value="{{ old('email') }}" required value="{{ old('name') }}" autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="siteName" class="form-label">SITE NAME</label>

                        <div class="">
                            <input id="siteName" type="text" class="form-control @error('siteName') is-invalid @enderror rounded-0" name="siteName" value="{{ old('siteName') }}" required value="{{ old('siteName') }}" autocomplete="siteName" placeholder="eg - site1.com,site2.com">

                            @error('siteName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>

                        <div class="">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror rounded-0" name="password" required value="{{ old('password') }}" autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>

                        <div class="">
                            <input id="password-confirm" type="password" class="form-control rounded-0" name="password_confirmation" required value="{{ old('password_confirmation') }}" autocomplete="new-password">
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="">
                            <button type="submit" class="btn btn-primary rounded-0 btn-info text-white">
                                {{ __('CREATE') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
