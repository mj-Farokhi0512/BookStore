@extends('layouts.dashboard')

@push('head')
    <link rel="stylesheet" href="{{ asset('dash/css/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('dash/css/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('dash/css/flatpickr.css') }}">
    <link rel="stylesheet" href="{{ asset('dash/css/bootstrap-select.css') }}">
    <link rel="stylesheet" href="{{ asset('dash/css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('dash/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('dash/css/tagify.css') }}">
    {{--    <link rel="stylesheet" href="{{ asset('dash/css/typeahead.css') }}">--}}
    <meta name="csrf_token" content="{{ csrf_token() }}"/>
@endpush


@section('content')
    <div class="card mb-4">
        <h5 class="card-header">ثبت کتاب</h5>
        <form class="card-body" id="book_form" action="{{ route('books.save') }}" method="POST"
              enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="multicol-first-name"
                    >نام</label
                    >
                    <input
                        type="text"
                        id="multicol-first-name"
                        class="form-control"
                        name="name"
                        value="{{old('name')}}"
                    />
                    <div
                        class="errors text-danger fs-6 mt-1">{{ $errors->get('name') ? $errors->get('name')[0] : '' }}</div>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="multicol-last-name"
                    >نام نویسنده</label
                    >
                    <input
                        type="text"
                        id="multicol-last-name"
                        class="form-control"
                        name="author"
                        value="{{ old('author') }}"
                    />
                    <div
                        class="errors text-danger fs-6 mt-1">{{ $errors->get('author') ? $errors->get('author')[0] : '' }}</div>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="multicol-phone">تعداد موجود</label>
                    <input
                        type="number"
                        id="multicol-phone"
                        class="form-control"
                        name="available"
                        min="0"
                        value="{{ old('available') }}"
                    />
                    <div
                        class="errors text-danger fs-6 mt-1">{{ $errors->get('available') ? $errors->get('available')[0] : '' }}</div>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="multicol-phone">قیمت</label>
                    <input
                        type="number"
                        id="multicol-phone"
                        class="form-control"
                        name="price"
                        min="0"
                        value="{{ old('price') }}"
                    />
                    <div
                        class="errors text-danger fs-6 mt-1">{{ $errors->get('price') ? $errors->get('price')[0] : '' }}</div>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="multicol-phone">تعداد صفحات</label>
                    <input
                        type="number"
                        id="multicol-phone"
                        class="form-control"
                        name="pages"
                        min="0"
                        value="{{ old('pages') }}"
                    />
                    <div
                        class="errors text-danger fs-6 mt-1">{{ $errors->get('pages') ? $errors->get('pages')[0] : '' }}</div>
                </div>
                <div class="col-md-6">
                    <label
                        for="tag_input"
                        class="form-label"
                    >برچسب</label
                    >
                    <input
                        id="tag_input"
                        name="tags"
                        class="form-control"
                    />
                </div>
                <div class="col-md-6">
                    <label
                        for="cat_input"
                        class="form-label"
                    >دسته بندی</label
                    >
                    <input
                        id="cat_input"
                        name="cats"
                        class="form-control"
                    />
                </div>
                <div class="col-12">
                    <label class="form-label">توضیحات</label>
                    <textarea
                        id="autosize-demo"
                        rows="3"
                        class="form-control"
                        name="description"
                    > {{ old('description') }}</textarea>
                    <div
                        class="errors text-danger fs-6 mt-1">{{ $errors->get('description') ? $errors->get('description')[0] : '' }}</div>
                </div>

                <div class="col-12">
                    <label class="form-label">عکس</label>
                    <div class="dropzone needsclick dz-clickable" id="dropzone-basic">
                        <div class="dz-message needsclick ">
                            فایل ها را اینجا رها کنید یا برای آپلود کلیک کنید
                        </div>
                        <div class="fallback">
                            <input name="image" type="file" accept="image/*"/>
                        </div>
                    </div>
                    <div
                        class="errors text-danger fs-6 mt-1">{{ $errors->get('image') ? $errors->get('image')[0] : '' }}</div>
                </div>
            </div>
            <div class="pt-4">
                <button type="submit" class="btn btn-primary me-sm-3 me-1">
                    ارسال
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')

    <!-- Vendors JS -->
    <script src="{{asset('dash/js/bootstrap-select.js')}}"></script>
    {{--    <script src="{{ asset('dash/js/tagify.js') }}"></script>--}}
    {{--    <script src="{{ asset('dash/js/typeahead.js') }}"></script>--}}
    <script src="{{ asset('dash/js/jquery-tagify.js') }}"></script>

    <!-- Flat Picker -->
    <script src="{{ asset('dash/js/moment.js') }}"></script>
    <script src="{{ asset('dash/js/flatpickr.js') }}"></script>
    <script src="{{ asset('dash/js/select2.js') }}"></script>

    <!-- Main JS -->
    <script src="{{asset('dash/js/autosize.js') }}"></script>
    <script src="{{ asset('dash/js/main.js') }}"></script>
    <!-- Page JS -->
    <script src="{{asset('dash/js/forms-selects.js')}}"></script>
    <script src="{{ asset('dash/js/forms-extras.js') }}"></script>
    {{--    <script src="{{ asset('dash/js/forms-tagify.js') }}"></script>--}}
    <script src="{{ asset('dash/js/create-book.js') }}"></script>
@endpush
