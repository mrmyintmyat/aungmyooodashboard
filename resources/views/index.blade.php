@extends('layouts.home')
@section('style')
    <style>
        .hover_menu_tag a:nth-child(1) {
            border-left: 3px solid #ff0505 !important;
            background: rgba(255, 255, 255, 0.251);
        }

        #SvgjsG1016 * {
            height: 100px;
        }
    </style>
@endsection
@section('page')
    <div class="pt-3">
        <div class="" style="width: 340px;">
            <label class="visually-hidden" for="input-date">date</label>
            <div class="input-group input-group-lg">
                <div class="input-group-text" id="inputGroup-sizing-lg">
                    <i class="fa-regular fa-calendar-days"></i>
                </div>
                <div class="dropdown form-control p-0 d-flex flex-row">
                    <input class="dropdown-toggle form-control rounded-0" value="{{ $date }}" name="date"
                        id="input-date" type="text" placeholder="Date" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-lg">
                    <button onclick="get_total()" class="btn btn-info rounded-0 rounded-end text-white">APPLY</button>
                </div>
            </div>
        </div>
    </div>
    <div class="error text-warning mt-3" style="display: none">
    </div>
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 py-4 col-xl-10 col-12 m-0">
        <div class="col ps-0">
            <div class="card mb-3 shadow-sm border border-1 bg-danger text-white " style="height: 130px;">
                <div class="card-body p-0 rounded-3 d-flex flex-column align-items-center justify-content-center">
                    <div class="hide_total">
                        <div>
                            <span class="d-block">
                                TOTAL REQUESTS
                            </span>
                        </div>
                        <div>
                            <div class="d-flex justify-content-center align-items-center">
                                <i class="fa-solid fa-location-arrow"></i>
                                <h3 id="total_requests" class="mb-0 ms-2">
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="spinner-border loading" role="status" style="display: none">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col ps-0">
            <div class="card mb-3 shadow-sm border border-1 bg-warning text-white " style="height: 130px;">
                <div class="card-body p-0 rounded-3 d-flex flex-column align-items-center justify-content-center">
                    <div class="hide_total">
                        <div>
                            <span class="d-block">
                                TOTAL IMPRESSIONS
                            </span>
                        </div>
                        <div>
                            <div class="d-flex justify-content-center align-items-center">
                                <i class="fa-solid fa-star"></i>
                                <h3 id="total_impressions" class="mb-0 ms-2">
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="spinner-border loading" role="status" style="display: none">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col ps-0">
            <div class="card mb-3 shadow-sm border border-1 bg-info text-white " style="height: 130px;">
                <div class="card-body p-0 rounded-3 d-flex flex-column align-items-center justify-content-center">
                    <div class="hide_total">
                        <div>
                            <span class="d-block">
                                TOTAL CLICKS
                            </span>
                        </div>
                        <div>
                            <div class="d-flex justify-content-center align-items-center">
                                <i class="fa-solid fa-hand-pointer"></i>
                                <h3 id="total_clicks" class="mb-0 ms-2">
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="spinner-border loading" role="status" style="display: none">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col ps-0">
            <div class="card mb-3 shadow-sm border border-1 bg-primary text-white " style="height: 130px;">
                <div class="card-body p-0 rounded-3 d-flex flex-column align-items-center justify-content-center">
                    <div class="hide_total">
                        <div>
                            <span class="d-block">
                                TOTAL REVENUE
                            </span>
                        </div>
                        <div>
                            <div class="d-flex justify-content-center align-items-center">
                                <i class="fa-solid fa-dollar-sign"></i>
                                <h3 id="total_revenue" class="mb-0 ms-2">
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="spinner-border loading" role="status" style="display: none">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col ps-0">
            <div class="card mb-3 shadow-sm border border-1 bg-danger text-white " style="height: 130px;">
                <div class="card-body p-0 rounded-3 d-flex flex-column align-items-center justify-content-center">
                    <div class="hide_total">
                        <div>
                            <span class="d-block">
                                TOTAL ECPM
                            </span>
                        </div>
                        <div>
                            <div class="d-flex justify-content-center align-items-center">
                                <i class="fa-solid fa-dollar-sign"></i>
                                <h3 id="total_ecpm" class="mb-0 ms-2">
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="spinner-border loading" role="status" style="display: none">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="earnings shadow-sm mb-3 border">
        <div class="text-start p-2 px-3 border-bottom border-2 border-opacity-50 fw-semibold">REVENUES</div>
        <div class="spinner-border loading my-4" role="status" style="display: none">
            <span class="visually-hidden">Loading...</span>
        </div>
        <canvas id="myChart" style="display: none"></canvas>
    </div>
@endsection
@section('script')
    <script src="/js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @if (isset($date))
        <script>
            $(function() {
                $('#input-date').val('{{ $date }}');
            });
        </script>
    @endif

    <script>
        function formatNumber(number) {
            let suffix = '';
            if (number >= 1000000) {
                number = (number / 1000000).toFixed(1);
                suffix = 'm';
            } else if (number >= 1000) {
                number = (number / 1000).toFixed(1);
                suffix = 'k';
            }
            return number + suffix;
        }
        get_total();
        let myChart = false;

        function get_total() {
            if (navigator.onLine) {
                $('.loading').fadeIn();
                $('.error').hide();
            } else {
                $('.loading').hide();
                $('.error').fadeIn();
                $('.error').html('Please check your connection.')
                return;
            }
            $("#myChart").fadeOut();
            let myChartcheck = false;
            var url = '{{ route('post.date') }}';
            var dateValue = $('#input-date').val();
            var requestData = {
                input: dateValue,
                _token: '{{ csrf_token() }}'
            };

            for (let i = 0; i < $('.hide_total').length; i++) {
                $('.hide_total').eq(i).fadeOut();
            }

            for (let i = 0; i < $('.loading').length; i++) {
                setTimeout(() => {
                    $('.loading').eq(i).fadeIn();
                }, 300);
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: requestData,
                dataType: 'json',
                success: function(response) {

                    $('#total_requests').html(formatNumber(response.total_data.data[0].totalRequests));
                    $('#total_impressions').html(formatNumber(response.total_data.data[0].impressions));
                    $('#total_clicks').html(formatNumber(response.total_data.data[0].clicks));
                    $('#total_revenue').html(formatNumber(response.total_data.data[0].revenue));
                    $('#total_ecpm').html(formatNumber(response.total_data.data[0].ecpm));

                    for (let i = 0; i < $('.loading').length; i++) {
                        $('.loading').eq(i).fadeOut();
                    }

                    for (let i = 0; i < $('.hide_total').length; i++) {
                        setTimeout(() => {
                            $('.hide_total').eq(i).fadeIn();
                            $("#myChart").fadeIn();
                        }, 300);

                    }
                    renderChart(response.revenueData, response.dateData);

                },
                error: function(xhr, textStatus, errorThrown) {
                    if (xhr.status === 500) {
                        const errorResponse = xhr.responseJSON; 
                        if (errorResponse && errorResponse.error) {
                            $('.loading').hide();
                            $('.error').fadeIn();
                            for (let i = 0; i < $('.hide_total').length; i++) {
                                $('.hide_total').eq(i).fadeIn();
                            }
                            $('.error').html(errorResponse.error)
                            return;
                        } else {
                            alert('An unknown server error occurred.');
                        }
                    } else {
                        alert('An error occurred: ' + textStatus + ' - ' + errorThrown);
                    }
                }
            });

            function renderChart(revenueData, dateData) {
                if (myChart) {
                    myChart.destroy();
                }
                var ctx = document.getElementById('myChart').getContext('2d');
                myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: dateData,
                        datasets: [{
                            label: 'REVENUE',
                            data: revenueData,
                            borderWidth: 2,
                            borderColor: 'rgb(17,202,240)',
                            backgroundColor: 'rgb(17,202,240)'
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

            }
        }
    </script>
@endsection
