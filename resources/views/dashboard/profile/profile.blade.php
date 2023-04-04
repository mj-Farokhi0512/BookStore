@extends('layouts.dashboard')

@push('head')
    <link rel="stylesheet" href="{{ asset('dash/css/page-profile.css') }}">
    <link rel="stylesheet" href="{{ asset('dash/css/dropzone.css') }}">

    <meta name="csrf_token" content="{{ csrf_token() }}">
@endpush

@php
    $user = Auth::user();
@endphp
@section('content')
    @include('dashboard.profile.header')
    @include('dashboard.profile.content')

    <!-- Modal -->
    <div class="modal fade" id="delete_account" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('profile.destroy') }}" method="POST">
                    @csrf
                    @method('delete')
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">
                            حذف حساب
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-password-toggle">
                                <label class="form-label" for="basic-default-password12">رمزعبور</label>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control" id="old_password"
                                           placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                           aria-describedby="basic-default-password2"/>
                                    <span id="basic-default-password2" class="input-group-text cursor-pointer"><i
                                            class="ti ti-eye-off"></i></span>
                                </div>
                                <div class="errors text-danger fs-6 mt-1">
                                    {{ $errors->get('password') ? $errors->get('password')[0] : '' }}
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                            لغو
                        </button>
                        <button type="submit" class="btn btn-danger">
                            حذف حساب
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal --}}
@endsection

@push('scripts')
    <script src="{{ asset('dash/js/profile-controller.js') }}"></script>
@endpush
