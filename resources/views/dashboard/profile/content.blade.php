    <!-- User Profile Content -->
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#form-tabs-update"
                                role="tab" aria-selected="true">
                                بروزرسانی اطلاعات
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-reset"
                                role="tab" aria-selected="false">
                                تغییر رمزعبور
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="form-tabs-update" role="tabpanel">
                        <form class="card-body" id="profile_update" enctype="multipart/form-data" method="POST">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="multicol-username">نام</label>
                                    <input type="text" id="multicol-name" name="name" class="form-control"
                                        value="{{ $user->name }}" />
                                    <div class="errors text-danger fs-6 mt-1">
                                        {{ $errors->get('name') ? $errors->get('name')[0] : '' }}</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="multicol-email">ایمیل</label>
                                    <div class="input-group input-group-merge">
                                        <input type="email" name="email" id="multicol-email" class="form-control"
                                            aria-describedby="multicol-email2" value="{{ $user->email }}" />
                                        {{-- <span class="input-group-text" id="multicol-email2">example@gmail.com</span> --}}
                                    </div>
                                    <div class="errors text-danger fs-6 mt-1">
                                        {{ $errors->get('email') ? $errors->get('email')[0] : '' }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-password-toggle">
                                        <label class="form-label" for="multicol-password">رمزعبور</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" name="password" id="password" class="form-control"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="multicol-password2" />
                                            <span class="input-group-text cursor-pointer" id="multicol-password2"><i
                                                    class="ti ti-eye-off"></i></span>
                                        </div>
                                        <div class="errors text-danger fs-6 mt-1">
                                            {{ $errors->get('password') ? $errors->get('password')[0] : '' }}</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="dropzone needsclick dz-clickable" id="dropzone-basic">
                                        <div class="dz-message needsclick ">
                                            فایل ها را اینجا رها کنید یا برای آپلود کلیک کنید
                                        </div>
                                        <div class="fallback">
                                            <input name="profile" type="file" accept="image/*" />
                                        </div>
                                    </div>
                                    <div class="errors text-danger fs-6 mt-1">
                                        {{ $errors->get('profile') ? $errors->get('profile')[0] : '' }}</div>
                                </div>
                            </div>
                            <div class="pt-4">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">
                                    ارسال
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade" id="form-tabs-reset" role="tabpanel">
                        <form id="update_pass" method="POST">
                            <div class="row">
                                <div class="col-md-6 py-2">
                                    <div class="form-password-toggle">
                                        <label class="form-label" for="basic-default-password12">رمزعبور قدیمی</label>
                                        <div class="input-group">
                                            <input type="password" name="current_password" class="form-control"
                                                id="old_password"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="basic-default-password2" />
                                            <span id="basic-default-password2"
                                                class="input-group-text cursor-pointer"><i
                                                    class="ti ti-eye-off"></i></span>
                                        </div>
                                        <div class="errors text-danger fs-6 mt-1">
                                            {{ $errors->get('current_password') ? $errors->get('current_password')[0] : '' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 py-2">
                                    <div class="form-password-toggle">
                                        <label class="form-label" for="basic-default-password12">رمزعبور جدید</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="new_password"
                                                name="new_password"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="basic-default-password2" />
                                            <span id="basic-default-password2"
                                                class="input-group-text cursor-pointer"><i
                                                    class="ti ti-eye-off"></i></span>
                                        </div>
                                        <div class="errors text-danger fs-6 mt-1">
                                            {{ $errors->get('new_password') ? $errors->get('new_password')[0] : '' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 py-2">
                                    <div class="form-password-toggle">
                                        <label class="form-label" for="basic-default-password12">تکرار رمزعبور
                                            جدید</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="new_password_conf"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="basic-default-password2" />
                                            <span id="basic-default-password2"
                                                class="input-group-text cursor-pointer"><i
                                                    class="ti ti-eye-off"></i></span>
                                        </div>
                                        <div class="errors text-danger fs-6 mt-1"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-4">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">
                                    ارسال
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
