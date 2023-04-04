@extends('layouts.dashboard')

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
                        <th>تاریخ پرداخت</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($paids as $paid)
                        <tr data-id="{{ $paid->id }}">
                            <td class="product-item-img"><img
                                    src="{{ $paid->image ? asset('storage/' . $paid->image) : asset('images/book-placeholder.jpg') }}"
                                    alt></td>
                            <td class="product-item-name">{{ $paid->name }}</td>
                            <td class="product-item-price">{{ $paid->price }} تومان </td>
                            <td class="product-item-quantity">
                                {{ $paid->pivot->number }}
                            </td>
                            <td class="product-item-totle">{{ $paid->price * $paid->pivot->number }} تومان</td>
                            <td>{{ \Morilog\Jalali\Jalalian::fromDateTime($paid->pivot->updated_at)->format('h:m Y/m/d') }}
                            </td>
                            <td class="text-success">
                                پرداخت شده
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
