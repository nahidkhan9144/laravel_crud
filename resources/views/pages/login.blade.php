@extends('welcome')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
    <form class="p-5 bg-white rounded border shadow" method="POST" action="/login">
        @csrf
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- User Name input -->
        <label class="form-label" for="userName">User Name</label>
        <div class="form-outline mb-4">
            <input type="text" id="userName" name="username" class="form-control" required />
        </div>

        <!-- Password input -->
        <label class="form-label" for="pass">Password</label>
        <div class="form-outline mb-4">
            <input type="password" id="pass" name="pass" class="form-control" required />
        </div>

        <!-- Submit button -->
        <button type="button" class="btn btn-primary btn-block mb-4" onclick="btnClick()">Sign in</button>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    function btnClick() {
        var username = document.getElementById("userName").value;
        var pass = document.getElementById("pass").value;
        
        if (username && pass) {
            $.ajax({
                url: '/logins',
                method: "POST",
                contentType: 'application/x-www-form-urlencoded',
                data: {
                    username: username,
                    pass: pass
                },
                success: function(res) {
                    if (res.error == '0') {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: res.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = "/goToHome";
                        });
                    } else {
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: res.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                }
            });
        } else {
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please fill all required fields",
                showConfirmButton: false,
                timer: 1500
            });
        }
    }
</script>
@endpush
