<h1>User page</h1>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>


<a href="{{ route('logout') }}"
    onclick="event.preventDefault();
                                                          document.getElementById('logout-form').submit();"
    class="text-decoration-none dropdown-item">
    Logout
</a>
