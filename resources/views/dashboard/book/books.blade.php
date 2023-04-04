@extends('layouts.dashboard')

@push('head')
    <link rel="stylesheet" href="{{ asset('dash/css/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('dash/css/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('dash/css/flatpickr.css') }}">
    <link rel="stylesheet" href="{{ asset('dash/css/bootstrap-select.css') }}">
    <meta name="csrf_token" content="{{ csrf_token() }}"/>
@endpush

@section('content')
    <div class="card">
        <div class="d-flex align-items-center justify-content-between card-header">
            <h5 class="mb-0">جدول کتاب ها</h5>
            <a class="btn btn-primary" href="{{route('books.create')}}">
                ثبت کتاب
                <i class="ti ti-plus ms-1 mt-n1"></i>
            </a>
        </div>
        <div class="d-flex px-4 align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <label>مرتب سازی :</label>
                <select
                    id="sort_select"
                    class="selectpicker ms-2"
                    data-style="btn-default"
                    onChange="location = this.value;"
                >
                    <option class="d-none"></option>
                    <option
                        value="{{route('books')}}/?sort_by=name" {{request()->query('sort_by') == 'name' ? 'selected' : ''}}>
                        براساس
                        نام
                    </option>
                    <option
                        value="{{route('books')}}/?sort_by=date" {{request()->query('sort_by') == 'date' ? 'selected' : ''}}>
                        براساس تاریخ
                    </option>
                </select>
            </div>
            <div class="d-flex align-items-center">
                <label>جستجو: </label>
                <div class="input-group input-group-merge ms-2">
                    <span class="input-group-text" id="basic-addon-search31">
                        <i class="ti ti-search"></i>
                    </span>
                    <input
                        type="text"
                        class="form-control"
                        placeholder="جستجو..."
                        aria-label="Search..."
                        aria-describedby="basic-addon-search31"
                        id="book_search"
                    />
                </div>
            </div>
        </div>
        <div class="card-datatable table-responsive">
            <table class="dt-responsive table" id="books_table">
                <thead>
                <tr>
                    <th>عکس</th>
                    <th>نام</th>
                    <th>نویسنده</th>
                    <th>قیمت</th>
                    <th>تعداد صفحات</th>
                    <th>تاریخ</th>
                    <th>وضعیت</th>
                    <th>عملیات ها</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($books as $book)
                    <tr data-id="{{ $book->id }}">
                        <td>
                            <img
                                src="{{ $book->image ? asset('storage/' . $book->image) : asset('images/book-placeholder.jpg') }}"
                                alt="Profile" class="profile-img"/>
                        </td>
                        <td>{{ $book->name }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->price }}</td>
                        <td>{{ $book->pages }}</td>
                        @php
                            $date = new Date($book->created_at);
                            $jdate = \Morilog\Jalali\Jalalian::fromDateTime($date)->format('Y/m/d');
                        @endphp
                        <td>{{$jdate}}</td>
                        <td>
                            <select class="status_select" value="{{$book->status}}">
                                <option value="1" {{$book->status == 1 ? 'selected' : ''}}>فعال</option>
                                <option value="0" {{$book->status == 0 ? 'selected' : ''}}>غیرفعال</option>
                            </select>
                        </td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('books.edit' , $book->id)}}"
                                   class="btn btn-primary edit-btn text-white">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <button class="btn btn-danger delete-btn">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $books->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>

@endsection

@push('scripts')
    <!-- Vendors JS -->
    <script src="{{ asset('dash/js/sweetalert.js') }}"></script>
    <script src="{{ asset('dash/js/datatables-bootstrap5.js') }}"></script>
    <script src="{{  asset('dash/js/bootstrap-select.js') }}"></script>


    <!-- Flat Picker -->
    <script src="{{ asset('dash/js/moment.js') }}"></script>
    <script src="{{ asset('dash/js/flatpickr.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('dash/js/main.js') }}"></script>

    <script src="{{ asset('dash/js/bookController.js') }}"></script>
    <!-- Page JS -->
    <script src="{{ asset('dash/js/forms-selects.js') }}"></script>
    {{-- <script src="{{ asset('dash/js/tables-datatables-advanced.js') }}"></script> --}}
@endpush
