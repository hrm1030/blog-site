@extends('layout.app')

@section('page-content')

@if($errors->first('alert'))
<script>
    var alert = "{!! $errors->first('alert') !!}";
</script>
@else
<script>
    var alert = '';
</script>
@endif
<script src="{{ asset('js/admin/management/universities.js') }}"></script>

<div class="alert alert-custom alert-white alert-shadow fade show gutter-b" role="alert">
    <div class="alert-icon">
        <i class="icon-2x text-dark-50 flaticon-users"></i>
    </div>
    <div class="alert-text">
    University list can be managed by admin. Link <a href="{{ route('management.universities') }}" class="font-weight-bold">management/universities</a>
    </div>
</div>
<div class="card card-custom">
    <div class="card-header flex-wrap py-5">
        <div class="card-title">
            <h3 class="card-label">University Management
            <div class="text-muted pt-2 font-size-sm">custom colu rendering</div></h3>
        </div>
        <div class="card-toolbar">
            <button type="button" class="btn btn-sm btn-success font-weight-bold" id="btn_new">
                <i class="fas fa-plus"></i>Add New
            </button>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="university_table">
            <thead>
                <tr>
                    <th><i class="icon-xl la la-university"></i> University</th>
                    <th><i class="fa fa-map-marker-alt"></i> Location</th>
                    <th width="15%"><i class="icon-xl la la-university"></i> Faculties</th>
                    <th width="15%"><i class="fas fa-chalkboard-teacher"></i> Professors</th>
                    <th width="15%"><i class="icon-xl la la-graduation-cap"></i>Students</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($universities as $university)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-50 flex-shrink-0">
                                    <img src="{{ asset($university->photo) }}" alt="{{ $university->name }}">
                                </div>
                                <div class="ml-3">
                                    <span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2">{{ $university->name }}</span>
                                    <a href="#" class="text-muted text-hover-primary">{{ $university->founded_date }}</a>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="font-weight-bolder text-danger">{{ $university->location }}</span>
                        </td>
                        <td>
                            {{ $university->faculties_cnt }}
                        </td>
                        <td>
                            {{ $university->professors_cnt }}
                        </td>
                        <td>
                            {{ $university->students_cnt }}
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary btn-icon btn_edit" university_id="{{ $university->id }}" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></button>
                            <button type="button" class="btn btn-sm btn-danger btn-icon btn_delete" university_id="{{ $university->id }}" data-toggle="tooltip" title="Delete"><i class="far fa-trash-alt"></i></button>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <!--end: Datatable-->
    </div>
</div>

<div class="modal fade" id="universityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeLg" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">University Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{ route('management.university.save') }}" method="POST" enctype="multipart/form-data" id="university_form">
                    @csrf
                    <input type="hidden" name="university_id" id="university_id">
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">University Image <span class="text-danger">*</span></label>
                            <div class="col-lg-9 col-xl-6">
                                <div class="image-input image-input-outline" id="kt_university_image" style="background-image: url({{ asset('assets/media/users/blank.png') }})">

                                    <div class="image-input-wrapper"></div>
                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="university_image" id="university_image" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="university_image_remove" />
                                    </label>
                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>
                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>
                                </div>
                                <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">University Name <span class="text-danger">*</span></label>
                            <div class="col-lg-9 col-xl-6">
                                <input class="form-control" type="text" id="name" name="name" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Location <span class="text-danger">*</span></label>
                            <div class="col-lg-9 col-xl-6">
                                <input class="form-control" type="text" id="location" name="location" placeholder="Tomsk, Russian Federation" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Founded Date <span class="text-danger">*</span></label>
                            <div class="col-lg-9 col-xl-6">
                                <div class="input-group date">
                                    <input type="text" class="form-control" id="founded_date" data-date-format="yyyy-mm-dd" name="founded_date" readonly="readonly" placeholder="Select date" />
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-calendar-check-o"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Number of Faculties <span class="text-danger">*</span></label>
                            <div class="col-lg-9 col-xl-6">
                                <input class="form-control" type="number" id="faculties_cnt" name="faculties_cnt" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Number of Professors <span class="text-danger">*</span></label>
                            <div class="col-lg-9 col-xl-6">
                                <input class="form-control" type="number" id="professors_cnt" name="professors_cnt" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Number of Students <span class="text-danger">*</span></label>
                            <div class="col-lg-9 col-xl-6">
                                <input class="form-control" type="number" id="students_cnt" name="students_cnt" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Description <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <textarea class="form-control" id="description" name="description" rows="8"></textarea>
                            </div>
                        </div>
                    </div>
                    <!--end::Body-->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn_save"><i class="fas fa-save"></i>Save</button>
            </div>
        </div>
    </div>
</div>
@endsection
