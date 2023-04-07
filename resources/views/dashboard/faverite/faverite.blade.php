@extends('layouts.dashboard')

@push('head')
    <link rel="stylesheet" href="{{ asset('dash/css/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('dash/css/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('dash/css/flatpickr.css') }}">
    <link rel="stylesheet" href="{{ asset('dash/css/bootstrap-select.css') }}">
    <meta name="csrf_token" content="{{ csrf_token() }}" />
@endpush
@section('content')
    <div class="card">
        <div class="card-datatable table-responsive">
            <table id="fave_table" class="table check-tbl">
                <thead>
                    <tr>
                        <th>کتاب</th>
                        <th>نام کتاب</th>
                        <th>نام نویسنده</th>
                        <th>قیمت</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($faves as $fave)
                        <tr data-id="{{ $fave->id }}">
                            <td class="product-item-img"><img
                                    src="{{ $fave->image ? asset('storage/' . $fave->image) : asset('images/book-placeholder.jpg') }}"
                                    alt></td>
                            <td class="product-item-name">{{ $fave->name }}</td>
                            <td>{{ $fave->author }}</td>
                            <td class="product-item-price">{{ $fave->price }} تومان </td>
                            <td class="text-success">
                                <button class="btn btn-danger delete-btn"><i class="fa-solid fa-xmark"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Vendors JS -->
    <script src="{{ asset('dash/js/sweetalert.js') }}"></script>
    <script src="{{ asset('dash/js/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('dash/js/bootstrap-select.js') }}"></script>


    <!-- Flat Picker -->
    <script src="{{ asset('dash/js/moment.js') }}"></script>
    <script src="{{ asset('dash/js/flatpickr.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('dash/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('dash/js/faverite-controller.js') }}"></script>
@endpush
