@extends('layout.app')

@section('page-content')
<script src="{{ asset('/js/search.js') }}"></script>
<form class="d-flex position-relative w-75 px-lg-40 m-auto" action="{{ url('/professor/search') }}" method="POST" id="searchForm">
    @csrf
    <div class="input-group">
        <!--begin::Icon-->
        <div class="input-group-prepend">
            <span class="input-group-text bg-white border-0 py-7 px-8">
                <span class="svg-icon svg-icon-xl">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"></rect>
                            <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                            <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"></path>
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>
            </span>
        </div>
        <!--end::Icon-->
        <!--begin::Input-->
        <input type="text" class="form-control h-auto border-0 py-7 px-1 font-size-h6" placeholder="Search professor" id="keyword" name="keyword">
        <!--end::Input-->
    </div>
</form>
<div class="row py-8">
    @foreach($professors as $professor)
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <!--begin::Card-->
        <div class="card card-custom gutter-b card-stretch">
            <!--begin::Body-->
            <div class="card-body pt-4">
                <!--begin::User-->
                <div class="d-flex align-items-end mb-7">
                    <!--begin::Pic-->
                    <div class="d-flex align-items-center">
                        <!--begin::Pic-->
                        <div class="flex-shrink-0 mr-4 mt-lg-0 mt-3">
                            <div class="symbol symbol-circle symbol-lg-75">
                                <img src="{{ asset($professor->photo) }}" alt="image" />
                            </div>
                            <div class="symbol symbol-lg-75 symbol-circle symbol-primary d-none">
                                <span class="font-size-h3 font-weight-boldest">JM</span>
                            </div>
                        </div>
                        <!--end::Pic-->
                        <!--begin::Title-->
                        <div class="d-flex flex-column">
                            <a href="#" class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0">{{ $professor->fullname }}</a>
                            <span class="text-muted font-weight-bold">{{ $professor->majors }}</span>
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::User-->
                <!--begin::Desc-->
                <p class="mb-7"> {{ $professor->description }}</p>
                <!--end::Desc-->
                <!--begin::Info-->
                <div class="mb-7">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-dark-75 font-weight-bolder mr-2">Email:</span>
                        <a href="#" class="text-muted text-hover-primary">{{ $professor->email }}</a>
                    </div>
                    <div class="d-flex justify-content-between align-items-cente my-1">
                        <span class="text-dark-75 font-weight-bolder mr-2">Phone:</span>
                        <a href="#" class="text-muted text-hover-primary">{{ $professor->phone }}</a>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-dark-75 font-weight-bolder mr-2">Birthday:</span>
                        <span class="text-muted font-weight-bold">{{ $professor->birthday }}</span>
                    </div>
                </div>
                <!--end::Info-->
                @php
                    $color_array = array('success', 'danger', 'warning', 'dark', 'primary', 'info');
                    $color = array_rand($color_array, 1);
                @endphp
                <a href="http://{{ $professor->website }}" class="btn btn-block btn-sm btn-light-{{ $color_array[$color] }} font-weight-bolder text-uppercase py-4">Visit website</a>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card-->
    </div>
    @endforeach

</div>
@endsection
