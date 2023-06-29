@extends('layouts.home')
<?php
function formatNumber($number)
{
    $suffix = '';
    if ($number >= 1000000) {
        $number = round($number / 1000000, 1);
        $suffix = 'm';
    } elseif ($number >= 1000) {
        $number = round($number / 1000, 1);
        $suffix = 'k';
    }
    return $number . $suffix;
}

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
    <div class="pt-3">
        <div class="" style="width: 300px;">
            <label class="visually-hidden" for="input-date">date</label>
            <div class="input-group input-group-lg">
                <div class="input-group-text" id="inputGroup-sizing-lg">
                    <i class="fa-regular fa-calendar-days"></i>
                </div>
                <div class="dropdown form-control p-0">
                    <form method="POST" action="/" class="d-flex post_date_form">
                        @csrf
                        <input class="dropdown-toggle form-control rounded-0 rounded-end" value="{{ $date }}"
                            name="date" id="input-date" type="text" placeholder="Date"
                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 py-4 col-xl-10 col-12 m-0">
        <div class="col ps-0">
            <div class="card mb-3 shadow-sm border border-1 bg-danger text-white " style="height: 130px;">
                <div class="card-body p-0 rounded-3 d-flex flex-column align-items-center justify-content-center">
                    <div>
                        <span class="d-block">
                            TOTAL REQUESTS
                        </span>
                    </div>
                    <div>
                        <div class="d-flex justify-content-center align-items-center">
                            <i class="fa-solid fa-location-arrow"></i>
                            <h3 class="mb-0 ms-2">{{ formatNumber($data['data'][0]['totalRequests']) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col ps-0">
            <div class="card mb-3 shadow-sm border border-1 bg-warning text-white " style="height: 130px;">
                <div class="card-body p-0 rounded-3 d-flex flex-column align-items-center justify-content-center">
                    <div>
                        <span class="d-block">
                            TOTAL IMPRESSIONS
                        </span>
                    </div>
                    <div>
                        <div class="d-flex justify-content-center align-items-center">
                            <i class="fa-solid fa-star"></i>
                            <h3 class="mb-0 ms-2">{{ formatNumber($data['data'][0]['impressions']) }}</h3>
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
                            TOTAL CLICKS
                        </span>
                    </div>
                    <div>
                        <div class="d-flex justify-content-center align-items-center">
                            <i class="fa-solid fa-hand-pointer"></i>
                            <h3 class="mb-0 ms-2">{{ formatNumber($data['data'][0]['clicks']) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col ps-0">
            <div class="card mb-3 shadow-sm border border-1 bg-primary text-white " style="height: 130px;">
                <div class="card-body p-0 rounded-3 d-flex flex-column align-items-center justify-content-center">
                    <div>
                        <span class="d-block">
                            TOTAL REVENUE
                        </span>
                    </div>
                    <div>
                        <div class="d-flex justify-content-center align-items-center">
                            <i class="fa-solid fa-dollar-sign"></i>
                            <h3 class="mb-0 ms-2">{{ formatNumber($data['data'][0]['revenue']) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col ps-0">
            <div class="card mb-3 shadow-sm border border-1 bg-danger text-white " style="height: 130px;">
                <div class="card-body p-0 rounded-3 d-flex flex-column align-items-center justify-content-center">
                    <div>
                        <span class="d-block">
                            TOTAL ECPM
                        </span>
                    </div>
                    <div>
                        <div class="d-flex justify-content-center align-items-center">
                            <i class="fa-solid fa-dollar-sign"></i>
                            <h3 class="mb-0 ms-2">{{ formatNumber($data['data'][0]['ecpm']) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="earnings shadow-sm mb-3 border">
        <div class="text-start p-2 px-3 border-bottom border-2 border-opacity-50 fw-semibold">EARNINGS</div>
        <div class="table-responsive pb-0">
            <table class="table table-borderless text-start mb-0">
                <thead>
                    <tr>
                        <th scope="col">DATE</th>
                        <th scope="col">REQUESTS</th>
                        <th scope="col">IMPRESSIONS</th>
                        <th scope="col">CLICKS</th>
                        <th scope="col">REVENUE</th>
                        <th scope="col">ECPM</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < count($lastsevendaysdatas['data']); $i++)
                        <tr class="mx-2">
                            <th>{{ $lastsevendaysdatas['data'][$i]['date'] }}</th>
                            <td>{{ $lastsevendaysdatas['data'][$i]['totalRequests'] }}</td>
                            <td>{{ $lastsevendaysdatas['data'][$i]['impressions'] }}</td>
                            <td>{{ $lastsevendaysdatas['data'][$i]['clicks'] }}</td>
                            <td>{{ $lastsevendaysdatas['data'][$i]['revenue'] }}</td>
                            <td>{{ $lastsevendaysdatas['data'][$i]['ecpm'] }}</td>
                        </tr>
                    @endfor
                    <tr class="shadow-sm border border-top border-bottom-0 border-start-0 border-end-0 border-2 fw-semibold">
                        <th>Total</th>
                        <td>{{ $lastSevenDaysdatatotal['data'][0]['totalRequests'] }}</td>
                        <td>{{ $lastSevenDaysdatatotal['data'][0]['impressions'] }}</td>
                        <td>{{ $lastSevenDaysdatatotal['data'][0]['clicks'] }}</td>
                        <td>{{ $lastSevenDaysdatatotal['data'][0]['revenue'] }}</td>
                        <td>{{ $lastSevenDaysdatatotal['data'][0]['ecpm'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')
    <script src="/js/index.js"></script>
@endsection
