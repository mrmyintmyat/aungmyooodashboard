<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Error</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <div style="height: 100vh;" class="d-flex justify-content-center align-items-center">
        <div class="d-flex flex-column align-items-center p-5 shadow-sm border">
            <h1 class="fs-5 text-danger">ERROR</h1>
            @if (session('error'))
                <p class="text-warning fs-5 mb-0 fs-4">{{ session('error') }}</p>
                @if (session('error') == 'No data found.')
                    <p class="text-warning fs-5 mt-0">Check Your SiteName.</p>
                @endif
            @else
                <p class="text-warning fs-5 mb-0">Something was Wrong</p>
                <p class="mb-0 fw-semibold">Or</p>
                <p class="text-warning fs-5 mt-0">Your Connection.......................</p>
            @endif
            <div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>


                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();"
                    class="text-white btn btn-info rounded-0">
                    Logout
                </a>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
