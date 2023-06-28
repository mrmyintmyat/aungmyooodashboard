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
                <h5 class="">EDIT USER</h5>
            </div>
            @if (!session('error'))
            <div class="d-flex justify-content-center mt-3">
                <form method="post" action="{{ url('admin/' . $user->id) }}" class="col-lg-6 col-12">
                    @csrf @method('PUT')

                    <div class="row mb-3">
                        <label for="name" class="form-label">NAME</label>

                        <div class="">
                            <input id="name" type="text"
                                class="form-control @error('name') is-invalid @enderror rounded-0" name="name"
                                value="{{ $user->name }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="siteName" class="form-label">SITE NAME</label>

                        <div class="">
                            <input id="siteName" type="text" class="form-control @error('siteName') is-invalid @enderror rounded-0" name="siteName" value="{{ $user->siteName }}" required value="{{ old('siteName') }}" autocomplete="siteName" autofocus>

                            @error('siteName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>

                        <div class="">
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror rounded-0" name="email"
                                value="{{ $user->email }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="Role" class="form-label">{{ __('ROLE') }}</label>

                        <select class="form-select rounded-0 @error('role') is-invalid @enderror w-100" name="role" aria-label="Default select example" id="Role">
                            <option class="rounded-0" @if ($user->role == 'admin') selected @endif value="admin">admin</option>
                            <option class="rounded-0" @if ($user->role == 'user') selected @endif value="user">user</option>
                        </select>

                        @error('role')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="row mb-0">
                        <div class="">
                            <button type="submit" class="btn btn-primary rounded-0 btn-info text-white">
                                {{ __('EDIT') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            @else
              <h3>User Not found</h3>
            @endif

        </div>
    </div>
@endsection
