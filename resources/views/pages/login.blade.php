@extends('welcome')
@section('content')
<div class="d-flex justify-content-center align-items-center vh-100 ">

    <form class="p-5 bg-white rounded border shadow">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Email input -->
        <label class="form-label" for="userName">User Name</label>
        <div data-mdb-input-init class="form-outline mb-4">
            <input type="text" id="userName" class="form-control" />
        </div>

        <!-- Password input -->
        <label class="form-label" for="pass">Password</label>
        <div data-mdb-input-init class="form-outline mb-4">
            <input type="password" id="pass" class="form-control" />
        </div>

        <!-- Submit button -->
        <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4" onclick="btnClick()">Sign in</button>

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
        if (username != '' && pass != '') {
            data = {
                username,
                pass
            }
            $.ajax({
                url: '/login',
                method: "POST",
                timeout: 0,
                headers: {
                    "Content-Type": "application/json",
                },
                data: JSON.stringify(data),
                success: function(res) {
                    if (res.error == '0') {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: res.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        // window.location.href = "{{ route('show') }}";
                        window.location.href = "/goToHome";
                    } else {
                        Swal.fire({
                            position: "top-end",
                            icon: "error ",
                            title: res.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                    $("#msg").html(res);

                },
            });
        } else {
            show_snack("please fill all required fields");
            Swal.fire({
                position: "top-end",
                icon: "error ",
                title: "please fill all required fields",
                showConfirmButton: false,
                timer: 1500
            });
        }
    }
</script>
@endpush