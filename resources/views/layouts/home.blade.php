<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="/fontawesome-free-6.4.0-web/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/date_input/daterangepicker-master/daterangepicker.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
@yield('style')

<body class="overflow-auto">
    @if (session('success'))
        <div aria-live="polite" aria-atomic="true" class="position-relative">
            <div class="toast-container top-0 end-0 p-3">


                <div id="liveToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true" data-aos="fade-left">
                    <div class="toast-header">
                        <i class="fa-solid fa-circle-check rounded me-2" style="color: #13C39C;"></i>
                        <strong class="me-auto">Success</strong>
                        <small class="text-muted">just now</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="text-center" style="overflow-x: hidden;">
        <div class="row">
            <aside class="col-md-2 menu bg-menu p-0 d-flex flex-row flex-md-column">
                <h1 class="text-white h4 text-center my-4 d-md-block d-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor"
                        class="bi bi-bar-chart-line-fill" viewBox="0 0 16 16">
                        <path
                            d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2z" />
                    </svg>
                    <span class=" ms-1 d-none d-lg-inline">Dashboard</span>
                </h1>
                <div class="w-100">
                    <div
                        class="list-group rounded-0 hover_menu_tag ps-3 d-flex align-content-around flex-row flex-md-column">
                        <a href="/" id="focus_tag"
                            class="list-group-item list-group-item-action text-center p-2 border-0 d-flex justify-content-center justify-content-md-start align-items-center text-white text-lg-start bg-menu"
                            aria-current="true">
                            <div class="d-flex flex-column flex-md-row align-items-center">
                                <i class="fas fa-home"></i>
                                <span class="ms-2 d-md-block d-none">HOME</span>
                            </div>
                        </a>
                        <a id="focus_tag" href="/reports"
                            class="list-group-item list-group-item-action text-center p-2 border-0 d-flex justify-content-center justify-content-md-start align-items-center text-white text-lg-start bg-menu">
                            <div class="d-flex flex-column flex-md-row align-items-center">
                                <i class="fa-solid fa-chart-column"></i>
                                <span class="ms-2 d-md-block d-none">REPORTS</span>
                            </div>
                        </a>
                        <a id="focus_tag" href="/password-change"
                            class="list-group-item list-group-item-action text-center p-2 border-0 d-flex justify-content-center justify-content-md-start align-items-center text-white text-lg-start bg-menu">
                            <div class="d-flex flex-column flex-md-row align-items-center">
                                <i class="fa-solid fa-lock"></i>
                                <span class="ms-2 d-md-block d-none">CHANGE PASSWORD</span>
                            </div>
                        </a>
                    </div>
                </div>
            </aside>
            <main class="col-md-10 overflow-scroll main_page p-0">
                <nav class="navbar navbar-expand shadow-sm border-bottom p-0">
                    <div class="container-fluid">
                        <div class="flex-grow"></div>
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>


                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                          document.getElementById('logout-form').submit();"
                                            class="text-decoration-none dropdown-item">
                                            Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <section class="scroll_page px-4 h-100" style="overflow-x: hidden;">
                    @yield('page')
                </section>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="/date_input/daterangepicker-master/moment.min.js"></script>
    <script src="/date_input/daterangepicker-master/daterangepicker.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    @yield('script')
</body>

</html>
