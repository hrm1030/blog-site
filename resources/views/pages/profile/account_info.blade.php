@extends('layout.app')

@section('page-content')
<script src="{{ asset('js/profile/account_info.js') }}"></script>
<div class="d-flex flex-row">
    <!--begin::Aside-->
    @include('pages.profile.profile_sidebar')
    <!--end::Aside-->
    <!--begin::Content-->
    <div class="flex-row-fluid ml-lg-8">
        <!--begin::Card-->
        <div class="card card-custom">
            <!--begin::Header-->
            <div class="card-header py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">Account Information</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Change your account settings</span>
                </div>
                <div class="card-toolbar">
                    <button type="button" class="btn btn-success mr-2" id="btn_save">Save Changes</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form class="form" action="{{ route('profile.account_info.save') }}" method="POST" id="account_form" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    @if($errors->first('alert'))
                        <div class="alert alert-custom alert-notice alert-light-success fade show" role="alert">
                            <div class="alert-icon"><i class="flaticon2-check-mark"></i></div>
                            <div class="alert-text">{{ $errors->first('alert') }}</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                </button>
                            </div>
                        </div>
                    @endif
                    <!--begin::Form Group-->
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Username</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="spinner spinner-sm spinner-success spinner-right">
                                <input class="form-control form-control-lg form-control-solid" type="text" value="{{ Auth::user()->username }}" id="username" name="username" />
                            </div>
                        </div>
                    </div>
                    <!--begin::Form Group-->
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-at"></i>
                                    </span>
                                </div>
                                <input type="email" class="form-control form-control-lg form-control-solid" value="{{ Auth::user()->email }}" id="email" name="email" placeholder="Email" />
                            </div>
                            <span class="form-text text-muted">Email will not be publicly displayed.
                            <a href="#" class="font-weight-bold">Learn more</a>.</span>
                        </div>
                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Content-->
</div>
@endsection
