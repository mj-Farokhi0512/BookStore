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
                        <th>ایمیل کاربر</th>
                        <th>سبد خرید</th>
                        <th>تعداد کل</th>
                        <th>جمع‌کل</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key => $user_order)
                        <tr data-id="{{ $key }}">
                            <td class="product-item-img">{{ $user_order[0]->email }}</td>
                            <td class="product-item-name">
                                @foreach ($user_order as $order)
                                    {{ $order->name }} ,
                                @endforeach
                            </td>

                            @php
                                $total_number = 0;
                                $total_price = 0;
                                
                                foreach ($user_order as $value) {
                                    $total_price += $value->price + $value->number;
                                    $total_number += $value->number;
                                }
                            @endphp
                            <td class="product-item-quantity">
                                {{ $total_number }}
                            </td>
                            <td class="product-item-totle">{{ $total_price }} تومان</td>
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
    <script src="{{ asset('dash/js/sweetalert.js') }}"></script>
    <script src="{{ asset('dash/js/cart-controller.js') }}"></script>
@endpush
