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
<script src="{{ asset('js/admin/management/faculties.js') }}"></script>

<div class="alert alert-custom alert-white alert-shadow fade show gutter-b" role="alert">
    <div class="alert-icon">
        <i class="icon-2x text-dark-50 flaticon-users"></i>
    </div>
    <div class="alert-text">
    Faculty list can be managed by admin. Link <a href="{{ route('management.faculties') }}" class="font-weight-bold">management/faculties</a>
    </div>
</div>
<div class="card card-custom">
    <div class="card-header flex-wrap py-5">
        <div class="card-title">
            <h3 class="card-label">Faculty Management
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
        <table class="table table-separate table-head-custom table-checkable" id="faculty_table">
            <thead>
                <tr>
                    <th width="20%"><i class="icon-xl la la-university"></i> Faculty</th>
                    <th width="20%"><i class="icon-xl la la-university"></i> University</th>
                    <th width="13%"><i class="icon-xl la la-university"></i> Departments</th>
                    <th width="13%"><i class="fas fa-chalkboard-teacher"></i> Professors</th>
                    <th width="13%"><i class="icon-xl la la-graduation-cap"></i>Students</th>
                    <th width="10%">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($faculties as $faculty)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-50 flex-shrink-0">
                                    <img src="{{ asset($faculty->photo) }}" alt="{{ $faculty->name }}">
                                </div>
                                <div class="ml-3">
                                    <span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2">{{ $faculty->name }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="font-weight-bolder text-danger">{{ $faculty->university_name }}</span>
                        </td>
                        <td>
                            {{ $faculty->departments_cnt }}
                        </td>
                        <td>
                            {{ $faculty->professors_cnt }}
                        </td>
                        <td>
                            {{ $faculty->students_cnt }}
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary btn_edit" faculty_id="{{ $faculty->id }}" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></button>
                            <button type="button" class="btn btn-sm btn-danger btn_delete" faculty_id="{{ $faculty->id }}" data-toggle="tooltip" title="Delete"><i class="far fa-trash-alt"></i></button>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <!--end: Datatable-->
    </div>
</div>

<div class="modal fade" id="facultyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeLg" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Faculty Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{ route('management.faculty.save') }}" method="POST" enctype="multipart/form-data" id="faculty_form">
                    @csrf
                    <input type="hidden" name="faculty_id" id="faculty_id">
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Faculty Image <span class="text-danger">*</span></label>
                            <div class="col-lg-9 col-xl-6">
                                <div class="image-input image-input-outline" id="kt_faculty_image" style="background-image: url({{ asset('assets/media/users/blank.png') }})">

                                    <div class="image-input-wrapper"></div>
                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="faculty_image" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="faculty_image_remove" />
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
                            <label class="col-xl-3 col-lg-3 col-form-label">Faculty Name <span class="text-danger">*</span></label>
                            <div class="col-lg-9 col-xl-6">
                                <input class="form-control" type="text" id="name" name="name" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">University <span class="text-danger">*</span></label>
                            <div class="col-lg-9 col-xl-6">
                                <select class="form-control" name="university" id="university" style="width: 100%">
                                    <option value=""></option>
                                    @foreach($universities as $university)
                                        <option value="{{ $university->id }}">{{ $university->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Number of Departments <span class="text-danger">*</span></label>
                            <div class="col-lg-9 col-xl-6">
                                <input class="form-control" type="number" id="departments_cnt" name="departments_cnt" />
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
