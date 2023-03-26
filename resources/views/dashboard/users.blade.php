@extends('layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">دیتاتیبل /</span> پیشرفته
        </h4>

        <div class="card">
            <h5 class="card-header">جدول کاربران</h5>
            <div class="card-datatable text-nowrap table-responsive">
                <table class="datatables-ajax table">
                    <thead>
                        <tr>
                            <th>پروفایل</th>
                            <th>نام</th>
                            <th>ایمیل</th>
                            <th>عملیات ها</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
