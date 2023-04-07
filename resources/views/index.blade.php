@extends('layouts.app')

@push('head')
    <meta name="csrf_token" content="{{ csrf_token() }}" />
@endpush
@section('content')
    <div class="page-content bg-white">
        @include('banner')
        @include('books')
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/order-controller.js') }}"></script>
@endpush
