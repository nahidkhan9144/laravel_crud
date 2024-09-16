@extends('welcome')
@section('content')

<div class="container">
<a href="{{ route('show') }}" class="btn btn-outline-primary" tabindex="-1" role="button" aria-disabled="true">View Books</a>
<button type="button" class="btn btn-outline-secondary">Logout</button>
</div>
@endsection

@push('scripts')

@endpush