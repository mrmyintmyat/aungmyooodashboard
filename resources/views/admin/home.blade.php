@extends('layouts.admin')
<?php
use App\Models\Order;
use App\Models\Item;
use App\Models\User;
?>
@section('style')
    <style>
        .hover_menu_tag a:nth-child(1) {
            border-left: 3px solid #ff0505 !important;
            background: rgba(255, 255, 255, 0.251);
        }
    </style>
@endsection
@section('page')
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 py-4">
        <div class="col ps-0">
            <div class="card mb-3 shadow-sm border border-1 bg-danger text-white " style="height: 130px;">
                <div class="card-body p-0 rounded-3 d-flex flex-column align-items-center justify-content-center">
                    <div>
                        <span class="d-block">
                            Users
                        </span>
                    </div>
                    <div>
                        <div class="d-flex justify-content-center align-items-center">
                            <i class="fa fa-users"></i>
                            <h3 class="mb-0 ms-2">{{ count(User::all()) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col ps-0">
            <div class="card mb-3 shadow-sm border border-1 bg-info text-white " style="height: 130px;">
                <div class="card-body p-0 rounded-3 d-flex flex-column align-items-center justify-content-center">
                    <div>
                        <span class="d-block">
                            Admins
                        </span>
                    </div>
                    <div>
                        <div class="d-flex justify-content-center align-items-center">
                            <i class="fa fa-users"></i>
                            <h3 class="mb-0 ms-2">{{ count(User::where('role', 'admin')->get()) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
