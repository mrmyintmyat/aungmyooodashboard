@extends('layouts.home')
@section('style')
  <style>
    .hover_menu_tag a:nth-child(2){
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
                <form method="POST" action="#" class="d-flex post_date_form">
                    @csrf
                    <input class="dropdown-toggle form-control rounded-0 rounded-end" value=""
                        name="date" id="input-date" type="text" placeholder="Date"
                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
                </form>
            </div>
        </div>
    </div>
</div>
<div class="earnings shadow-sm border mt-3">
    <div class="text-start p-2 px-3 border-bottom border-2 border-opacity-50 fw-semibold">REPORTS</div>
    <div class="table-responsive  p-2">
        <table class="table table-borderless text-start">
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
                {{-- @for ($i = 0; $i < count($lastsevendaysdatas['data']); $i++)
                    <tr>
                        <th>{{ $lastsevendaysdatas['data'][$i]['date'] }}</th>
                        <td>{{ $lastsevendaysdatas['data'][$i]['totalRequests'] }}</td>
                        <td>{{ $lastsevendaysdatas['data'][$i]['impressions'] }}</td>
                        <td>{{ $lastsevendaysdatas['data'][$i]['clicks'] }}</td>
                        <td>{{ $lastsevendaysdatas['data'][$i]['revenue'] }}</td>
                        <td>{{ $lastsevendaysdatas['data'][$i]['ecpm'] }}</td>
                    </tr>
                @endfor --}}
                <tr>
                    <th>DD</th>
                    <td>ff</td>
                    <td>ff</td>
                    <td>dd</td>
                    <td>fffd</td>
                    <td>dsadfs</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('script')
    <script src="/js/index.js"></script>
@endsection
