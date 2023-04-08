@extends('layouts.dashboard')

@push('head')
    <meta name="csrf_token" content="{{ csrf_token() }}" />
@endpush
@section('content')
    <div class="card">
        <div class="card-datatable table-responsive">
            <table id="orders_table" class="table check-tbl">
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
                                {{ $order->number }}
                            </td>
                            <td class="product-item-totle">{{ $order->price * $order->number }} تومان</td>
                            <td class="">
                                <div class="d-flex">
                                    <button class="btn btn-primary send-btn">ارسال</button>
                                    <button class="btn btn-danger cancel-btn">لغو</button>
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
