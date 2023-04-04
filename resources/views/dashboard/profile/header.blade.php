    <!-- Header -->
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="user-profile-header-banner">
                    <img src="{{ asset('dash/images/profile-banner.png') }}" alt="Banner image" class="rounded-top" />
                </div>
                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                    <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                        <img id="profile_img"
                            src="{{ $user->profile ? asset('storage/' . $user->profile) : asset('dash/images/profile-placeholder.png') }}"
                            alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
                    </div>
                    <div class="flex-grow-1 mt-3 mt-sm-5">
                        <div class="mx-4 gap-4">
                            <div class="user-profile-info">
                                <h4>{{ $user->name }}</h4>
                                <p>{{ $user->email }}</p>
                            </div>
                            <div>
                                <button class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal"
                                    data-bs-target="#delete_account">حذف حساب</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Header -->
