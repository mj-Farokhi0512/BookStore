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
        <h5 class="card-header">جدول کاربران</h5>
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
                        value="{{route('users')}}/?sort_by=name" {{request()->query('sort_by') == 'name' ? 'selected' : ''}}>
                        براساس
                        نام
                    </option>
                    <option
                        value="{{route('users')}}/?sort_by=date" {{request()->query('sort_by') == 'date' ? 'selected' : ''}}>
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
                        id="user_search"
                    />
                </div>
            </div>
        </div>
        <div class="card-datatable table-responsive">
            <table class="dt-responsive table" id="users_table">
                <thead>
                <tr>
                    <th>پروفایل</th>
                    <th>نام</th>
                    <th>ایمیل</th>
                    <th>تاریخ</th>
                    <th>وضعیت</th>
                    <th>نقش</th>
                    <th>عملیات ها</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr data-id="{{ $user->id }}">
                        <td>
                            <img
                                src="{{ $user->profile ? asset('storage/' . $user->profile) : asset('dash/images/profile-placeholder.png') }}"
                                alt="Profile" class="profile-img"/>
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        @php
                            $date = new Date($user->created_at);
                            $jdate = \Morilog\Jalali\Jalalian::fromDateTime($date)->format('Y/m/d');
                        @endphp
                        <td>{{$jdate}}</td>
                        <td>
                            @if($user->role_id != 2)
                                <select class="status_select" value="{{$user->status}}">
                                    <option value="1" {{$user->status == 1 ? 'selected' : ''}}>فعال</option>
                                    <option value="0" {{$user->status == 0 ? 'selected' : ''}}>غیرفعال</option>
                                </select>
                            @else
                                {{$user->status ? 'فعال' : 'غیرفعال'}}
                            @endif
                        </td>
                        <td>
                            @if($user->role_id != 2)
                                <select class="role_select" value="{{$user->role_id}}">
                                    @foreach ($roles as $role)
                                        <option
                                            value="{{ $role->id }}" {{$role->id == $user->role_id ? 'selected="selected"' : ''}}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            @else
                                MANAGER
                            @endif
                        </td>
                        <td>
                            @if($user->role_id != 2)
                                <div class="d-flex">
                                    <button class="btn btn-primary edit-btn">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <button class="btn btn-danger delete-btn">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $users->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>

    {{-- Edit User Modal --}}
    <div class="modal fade" id="edit_user" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="card-body" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">
                            Modal title
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label" for="multicol-username">نام</label>
                                <input type="text" id="multicol-name" name="name" class="form-control"/>
                                <div class="errors text-danger fs-6 mt-1"></div>
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="multicol-email">ایمیل</label>
                                <div class="input-group input-group-merge">
                                    <input type="email" name="email" disabled id="multicol-email" class="form-control"
                                           aria-describedby="multicol-email2"/>
                                </div>
                                <div class="errors text-danger fs-6 mt-1"></div>
                            </div>
                            <div class="col-12">
                                <div class="form-password-toggle">
                                    <label class="form-label" for="multicol-password">رمزعبور</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" name="password" id="password" class="form-control"
                                               placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                               aria-describedby="multicol-password2"/>
                                        <span class="input-group-text cursor-pointer" id="multicol-password2"><i
                                                class="ti ti-eye-off"></i></span>
                                    </div>
                                    <div class="errors text-danger fs-6 mt-1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                            لغو
                        </button>
                        <button type="submit" class="btn btn-primary">
                            ارسال
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Vendors JS -->
    <script src="{{ asset('dash/js/sweetalert.js') }}"></script>
    <script src="{{ asset('dash/js/datatables-bootstrap5.js') }}"></script>
    <script src="{{asset('dash/js/bootstrap-select.js')}}"></script>


    <!-- Flat Picker -->
    <script src="{{ asset('dash/js/moment.js') }}"></script>
    <script src="{{ asset('dash/js/flatpickr.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('dash/js/main.js') }}"></script>

    <script src="{{ asset('dash/js/users-controller.js') }}"></script>
    <!-- Page JS -->
    <script src="{{asset('dash/js/forms-selects.js')}}"></script>
    {{-- <script src="{{ asset('dash/js/tables-datatables-advanced.js') }}"></script> --}}
@endpush
