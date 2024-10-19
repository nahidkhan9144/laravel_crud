@extends('welcome')
@section('content')
<div class="mx-5 d-flex p-3 justify-center-between justify-center-around" style="flex-direction: column-reverse; align-items: center">
    <div class="row" id="form-container">
        <div class="row mb-4 my-3">
            <h2 class="text-center border-bottom">Dashboard</h2>
        </div>
        <div class="col-md-8">
            <div class="card shadow p-3 mb-5 bg-white rounded" style="width: 18rem;">
                <img class="card-img-top" src="{{ asset('img/books_logo.avif') }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title mb-3 text-center">Books Info</h5>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('show') }}" class="btn btn-success">View Books</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow p-3 mb-5 bg-white rounded" style="width: 18rem;">
                <img class="card-img-top" src="{{ asset('img/logout.png') }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title mb-3 text-center">Logout</h5>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('logout') }}" class="btn btn-warning">Logout</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- <a href="{{ route('show') }}" class="btn btn-outline-primary" tabindex="-1" role="button" aria-disabled="true">View Books</a> -->
    <!-- <a href="{{ route('logout') }}" class="btn btn-outline-primary" tabindex="-1" role="button" aria-disabled="true">Logout</a> -->
    <!-- <button type="button" class="btn btn-outline-secondary">Logout</button> -->
</div>
@endsection

@push('scripts')
<!-- https://laravel.com/docs/11.x/authentication -->
@endpush