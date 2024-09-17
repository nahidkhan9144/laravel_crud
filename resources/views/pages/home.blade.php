@extends('welcome')
@section('content')

<div class="container">
<a href="{{ route('show') }}" class="btn btn-outline-primary" tabindex="-1" role="button" aria-disabled="true">View Books</a>
<a href="{{ route('logout') }}" class="btn btn-outline-primary" tabindex="-1" role="button" aria-disabled="true">Logout</a>
<!-- <button type="button" class="btn btn-outline-secondary">Logout</button> -->
</div>
@endsection

@push('scripts')
<!-- https://laravel.com/docs/11.x/authentication -->
@endpush