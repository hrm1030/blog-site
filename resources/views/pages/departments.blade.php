@extends('layout.app')

@section('page-content')
<script src="{{ asset('/js/search.js') }}"></script>
<form class="d-flex position-relative w-75 px-lg-40 m-auto" action="{{ url('/departments/search') }}" method="POST" id="searchForm">
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
        <input type="text" class="form-control h-auto border-0 py-7 px-1 font-size-h6" placeholder="Search department" id="keyword" name="keyword">
        <!--end::Input-->
    </div>
</form>
<div class="row py-8">
    @foreach($departments as $department)
    <div class="col-xl-4">
        <!--begin::Card-->
        <div class="card card-custom gutter-b card-stretch">
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Info-->
                <div class="d-flex align-items-center">
                    <!--begin::Info-->
                    <div class="d-flex flex-column mr-auto">
                        <!--begin: Title-->
                        <div class="d-flex flex-column mr-auto">
                            <a href="{{ url('/department/'.$department->id) }}" class="text-dark text-hover-primary font-size-h4 font-weight-bolder mb-1">{{ $department->name }}</a>
                            <span class="text-muted font-weight-bold">{{ $department->university_name }} / {{ $department->faculty_name }}</span>
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Info-->
                <!--begin::Description-->
                <div class="mb-10 mt-5 font-weight-bold">{{ substr($department->description, 0, 200) }}...</div>
                {{-- <!--end::Description-->
                <!--begin::Data-->
                <div class="d-flex mb-5">
                    <div class="d-flex align-items-center mr-7">
                        <span class="font-weight-bold mr-4">Departments</span>
                        <span class="btn btn-light-primary btn-sm font-weight-bold btn-upper btn-text">{{ $department->departments_cnt }} </span>
                    </div>
                </div>
                <!--end::Data--> --}}
            </div>
            <!--end::Body-->
            <!--begin::Footer-->
            <div class="card-footer d-flex align-items-center">
                <div class="d-flex">
                    <div class="d-flex align-items-center mr-7">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <a href="#" class="font-weight-bolder text-primary ml-2">{{ $department->professors_cnt }} professors</a>
                    </div>
                    <div class="d-flex align-items-center mr-7">
                        <i class="fas fa-graduation-cap"></i>
                        <a href="#" class="font-weight-bolder text-primary ml-2">{{ $department->students_cnt }} students</a>
                    </div>
                </div>
            </div>
            <!--end::Footer-->
        </div>
        <!--end:: Card-->
    </div>
    @endforeach

</div>
@endsection
