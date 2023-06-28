@extends('layouts.admin')
@section('style')
    <style>
        .hover_menu_tag a:nth-child(2) {
            border-left: 3px solid #ff0505 !important;
            background: rgba(255, 255, 255, 0.251);
        }
    </style>
@endsection
@section('page')
    <div class="card text-start mt-2 shadow-sm">
        <div class="card-body">
            <div class="border-bottom border-2">
                <h5 class="">USERS</h5>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <div class="table-responsive w-100">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">NAME</th>
                                <th scope="col">EMAIL</th>
                                <th scope="col">SITE NAME</th>
                                <th scope="col">ROLE</th>
                                <th scope="col">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($users as $user)
                                <tr id="{{ $user->id }}">
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->siteName }}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm rounded-0">
                                            {{ $user->role }}
                                        </button>
                                    </td>
                                    <td class="d-flex flex-row">
                                        <a href="/admin/{{ $user->id }}/edit"
                                            class="btn btn-info btn-sm rounded-0 text-white">
                                            Edit
                                        </a>
                                        <button onclick="Delete_item({{ $user->id }})"
                                            class="btn btn-danger btn-sm rounded-0 text-white ms-2">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            {{ $users->links('layouts.bootstrap-5') }}
        </div>
    </div>
@endsection
@section('script')
    <script>
        function Delete_item(id) {
            if (confirm("Are you sure?")) {
                axios.delete('/admin/' + id)
                    .then(function(response) {
                        // $('#' + id).remove();
                        var toast = document.getElementById('toast');
                        toast.classList.add('show');
                    })
                    .catch(function(error) {
                        // Check if error response exists and contains a message
                        if (error.response && error.response.data && error.response.data.error) {
                            var toast = document.getElementById('error_toast');
                            toast.classList.add('show');
                        } else {
                            // Handle generic error
                            console.log(error);
                            alert('An error occurred while deleting the items.');
                        }
                    });
            }
        }
    </script>
@endsection
