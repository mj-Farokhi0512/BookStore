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
            <h5 class="mb-0">جدول دسته بندی ها</h5>
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
                        value="{{route('tag_category')}}/?sort_cates=name" {{request()->query('sort_by') == 'name' ? 'selected' : ''}}>
                        براساس
                        نام
                    </option>
                    <option
                        value="{{route('tag_category')}}/?sort_cates=date" {{request()->query('sort_by') == 'date' ? 'selected' : ''}}>
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
                        id="cat_search"
                    />
                </div>
            </div>
        </div>
        <div class="card-datatable table-responsive">
            <table class="dt-responsive table" id="cates_table">
                <thead>
                <tr>
                    <th>شماره</th>
                    <th>نام</th>
                    <th>تاریخ</th>
                    <th>وضعیت</th>
                    <th>عملیات ها</th>
                </tr>
                </thead>
                <tbody>
                <tr id="input_cate">
                    <td>ایجاد دسته بندی</td>
                    <td>
                        <input type="text" class="form-control cate-input"/>
                    </td>
                    <td></td>
                    <td>
                        <select class="status_select">
                            <option value="1">فعال</option>
                            <option value="0">غیرفعال</option>
                        </select>
                    </td>
                    <td>
                        <button class="btn btn-primary">ثبت</button>
                    </td>
                </tr>
                @foreach ($cates as $cate)
                    <tr data-id="{{ $cate->id }}">
                        <td>
                            {{$loop->index + 1}}
                        </td>
                        <td>{{ $cate->name }}</td>
                        @php
                            $date = new Date($cate->created_at);
                            $jdate = \Morilog\Jalali\Jalalian::fromDateTime($date)->format('Y/m/d');
                        @endphp
                        <td>{{$jdate}}</td>
                        <td>
                            <select class="status_select" value="{{$cate->status}}">
                                <option value="1" {{$cate->status == 1 ? 'selected' : ''}}>فعال</option>
                                <option value="0" {{$cate->status == 0 ? 'selected' : ''}}>غیرفعال</option>
                            </select>
                        </td>
                        <td>
                            <div class="d-flex">
                                <button class="btn btn-primary edit-btn">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button class="btn btn-danger delete-btn">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $cates->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
    <div class="card mt-5">
        <div class="d-flex align-items-center justify-content-between card-header">
            <h5 class="mb-0">جدول برچسب ها</h5>
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
                        value="{{route('tag_category')}}/?sort_tags=name" {{request()->query('sort_by') == 'name' ? 'selected' : ''}}>
                        براساس
                        نام
                    </option>
                    <option
                        value="{{route('tag_category')}}/?sort_tags=date" {{request()->query('sort_by') == 'date' ? 'selected' : ''}}>
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
                        id="tag_search"
                    />
                </div>
            </div>
        </div>
        <div class="card-datatable table-responsive">
            <table class="dt-responsive table" id="tags_table">
                <thead>
                <tr>
                    <th>شماره</th>
                    <th>نام</th>
                    <th>تاریخ</th>
                    <th>وضعیت</th>
                    <th>عملیات ها</th>
                </tr>
                </thead>
                <tbody>
                <tr id="input_tag">
                    <td>ایجاد برچسب</td>
                    <td>
                        <input type="text" class="form-control tag-input"/>
                    </td>
                    <td></td>
                    <td>
                        <select class="status_select">
                            <option value="1">فعال</option>
                            <option value="0">غیرفعال</option>
                        </select>
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary">ثبت</button>
                    </td>
                </tr>
                @foreach ($tags as $tag)
                    <tr data-id="{{ $tag->id }}">
                        <td>
                            {{$loop->index + 1}}
                        </td>
                        <td>{{ $tag->name }}</td>
                        @php
                            $date = new Date($tag->created_at);
                            $jdate = \Morilog\Jalali\Jalalian::fromDateTime($date)->format('Y/m/d');
                        @endphp
                        <td>{{$jdate}}</td>
                        <td>
                            <select class="status_select" value="{{$tag->status}}">
                                <option value="1" {{$tag->status == 1 ? 'selected' : ''}}>فعال</option>
                                <option value="0" {{$tag->status == 0 ? 'selected' : ''}}>غیرفعال</option>
                            </select>
                        </td>
                        <td>
                            <div class="d-flex">
                                <button class="btn btn-primary edit-btn">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button class="btn btn-danger delete-btn">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $tags->links('vendor.pagination.bootstrap-5') }}
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

    <!-- Page JS -->
    <script src="{{ asset('dash/js/forms-selects.js') }}"></script>
    <script src="{{ asset('dash/js/tag_category.js') }}"></script>
@endpush
