@extends('layouts.dashboard')

@push('head')
    <meta name="csrf_token" content="{{ csrf_token() }}" />
@endpush
@section('content')
    <div class="card">
        <div class="card-datatable table-responsive">
            <table id="cart_table" class="table check-tbl">
                <thead>
                    <tr>
                        <th>کتاب</th>
                        <th>نام کتاب</th>
                        <th>قیمت</th>
                        <th>تعداد</th>
                        <th>جمع‌کل</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr data-id="{{ $order->id }}">
                            <td class="product-item-img"><img
                                    src="{{ $order->image ? asset('storage/' . $order->image) : asset('images/book-placeholder.jpg') }}"
                                    alt></td>
                            <td class="product-item-name">{{ $order->name }}</td>
                            <td class="product-item-price">{{ $order->price }} تومان </td>
                            <td class="product-item-quantity">
                                <div class="quantity btn-quantity d-flex align-items-stretch me-3">
                                    <button class="btn btn-count-down"><i class="fa fa-minus"></i></button>
                                    <input type="text" value="{{ $order->pivot->number }}" name="demo_vertical2"
                                        class="quantity-input">
                                    <button class="btn btn-count-up"><i class="fa fa-plus"></i></button>
                                </div>
                            </td>
                            <td class="product-item-totle">{{ $order->price * $order->pivot->number }} تومان</td>
                            <td class="">
                                <div class="d-flex">
                                    <button class="btn btn-primary paid-btn">پرداخت</button>
                                    <button class="btn btn-danger delete-btn"><i class="fa fa-close"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('dash/js/cart-controller.js') }}"></script>
@endpush
