@extends('layouts.app')

@section('content')
    <div class="page-content bg-white">
        @include('banner')
        @include('books')
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/order-controller.js') }}"></script>
@endpush
