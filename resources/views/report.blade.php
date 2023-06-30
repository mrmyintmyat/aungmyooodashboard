@extends('layouts.home')
@section('style')
    <style>
        .hover_menu_tag a:nth-child(2) {
            border-left: 3px solid #ff0505 !important;
            background: rgba(255, 255, 255, 0.251);
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
    <div class="earnings shadow-sm border mt-3 position-relative">
        <div class="text-start p-2 px-3 border-bottom border-2 border-opacity-50 fw-semibold">REPORTS</div>
        <div class="table-responsive pb-0">
            <table class="table table-borderless text-start mb-0 ">
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
                <tbody id="tbody" class="hide_total">
                    {{-- @for ($i = 0; $i < count($data['data']); $i++)
                    <tr class="mx-2">
                        <th>{{ $data['data'][$i]['date'] }}</th>
                        <td>{{ $data['data'][$i]['totalRequests'] }}</td>
                        <td>{{ $data['data'][$i]['impressions'] }}</td>
                        <td>{{ $data['data'][$i]['clicks'] }}</td>
                        <td>{{ $data['data'][$i]['revenue'] }}</td>
                        <td>{{ $data['data'][$i]['ecpm'] }}</td>
                    </tr>
                @endfor --}}
                </tbody>
            </table>
        </div>

        <div class="spinner-border loading my-5" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>

        <div class="error mb-4 text-center text-warning" style="display: none">
        </div>
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

        let check = false;
        get_total();
        let myChart = false;

        function get_total() {
            if (navigator.onLine) {
                $('.loading').fadeIn();
                $('.error').hide();
                $('.hide_total').show();
            } else {
                $('.loading').hide();
                $('.error').fadeIn();
                $('.hide_total').hide();
                $('.error').html('Please check your connection.')
                return;
            }

            if (check == true) {
                return;
            }
            let tbody = document.getElementById("tbody");
            let total = document.getElementById("total");
            tbody.innerHTML = '';
            var url = '{{ route('post_reports.date') }}';
            var dateValue = $('#input-date').val();
            var requestData = {
                input: dateValue,
                _token: '{{ csrf_token() }}'
            };

            $('.hide_total').fadeOut();

            setTimeout(() => {
                $('.loading').fadeIn();
            }, 300);

            check = true;

            $.ajax({
                url: url,
                type: 'POST',
                data: requestData,
                dataType: 'json',
                success: function(response) {
                    for (let i = 0; i < response.datas.data.length; i++) {
                        let data = response.datas.data[i];
                        let html = `
                        <tr class="mx-2">
                        <th>${data['date']}</th>
                        <td>${data['totalRequests']}</td>
                        <td>${data['impressions']}</td>
                        <td>${data['clicks']}</td>
                        <td>${data['revenue']}</td>
                        <td>${data['ecpm']}</td>
                        </tr>
                        `;
                        tbody.innerHTML += html;
                    }

                    let totalhtml = `
                    <tr class="mx-2 shadow-sm border border-top border-bottom-0 border-start-0 border-end-0 border-2 fw-semibold">
                        <th>Total</td>
                        <td>${response.total_data.data[0]['totalRequests']}</td>
                        <td>${response.total_data.data[0]['impressions']}</td>
                        <td>${response.total_data.data[0]['clicks']}</td>
                        <td>${response.total_data.data[0]['revenue']}</td>
                        <td>${response.total_data.data[0]['ecpm']}</td>
                    </tr>
                        `
                    tbody.innerHTML += totalhtml;
                    $('.loading').fadeOut();

                    setTimeout(() => {
                        $('.hide_total').fadeIn();
                    }, 300);


                    check = false;
                },
                error: function(xhr, textStatus, errorThrown) {
                    if (xhr.status === 500) {
                        const errorResponse = xhr.responseJSON;
                        if (errorResponse && errorResponse.error) {
                            $('.loading').hide();
                            $('.error').fadeIn();
                            $('.hide_total').hide();
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
        }
    </script>
@endsection
