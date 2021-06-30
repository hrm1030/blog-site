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

<script src="{{ asset('js/admin/management/departments.js') }}"></script>

<div class="alert alert-custom alert-white alert-shadow fade show gutter-b" role="alert">
    <div class="alert-icon">
        <i class="icon-2x text-dark-50 flaticon-users"></i>
    </div>
    <div class="alert-text">
    Department list can be managed by admin. Link <a href="{{ route('management.departments') }}" class="font-weight-bold">management/departments</a>
    </div>
</div>
<div class="card card-custom">
    <div class="card-header flex-wrap py-5">
        <div class="card-title">
            <h3 class="card-label">Deartment Management
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
        <table class="table table-separate table-head-custom table-checkable" id="department_table">
            <thead>
                <tr>
                    <th width="24%"><i class="icon-xl la la-university"></i> Department</th>
                    <th width="40%"><i class="icon-xl la la-university"></i> University & Faculty</th>
                    <th width="13%"><i class="fas fa-chalkboard-teacher"></i> Professors</th>
                    <th width="13%"><i class="icon-xl la la-graduation-cap"></i>Students</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($departments as $department)
                    <tr>
                        <td>
                            <span class="font-weight-bolder text-primary">{{ $department->name }}</span>
                        </td>
                        <td>
                            <span class="font-weight-bolder text-danger">{{ $department->university_name }}</span> / <span class="font-weight-bolder text-success">{{ $department->faculty_name }}</span>
                        </td>
                        <td>
                            {{ $department->professors_cnt }}
                        </td>
                        <td>
                            {{ $department->students_cnt }}
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-icon btn-primary btn_edit" department_id="{{ $department->id }}" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></button>
                            <button type="button" class="btn btn-sm btn-icon btn-danger btn_delete" department_id="{{ $department->id }}" data-toggle="tooltip" title="Delete"><i class="far fa-trash-alt"></i></button>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <!--end: Datatable-->
    </div>
</div>

<div class="modal fade" id="departmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeLg" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Department Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{ route('management.department.save') }}" method="POST" enctype="multipart/form-data" id="department_form">
                    @csrf
                    <input type="hidden" name="department_id" id="department_id">
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Department Name <span class="text-danger">*</span></label>
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
                            <label class="col-xl-3 col-lg-3 col-form-label">Faculty <span class="text-danger">*</span></label>
                            <div class="col-lg-9 col-xl-6">
                                <select class="form-control" name="faculty" id="faculty" style="width: 100%">
                                    <option value=""></option>
                                    @foreach($faculties as $faculty)
                                        <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                                    @endforeach
                                </select>
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
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Courses name & content <span class="text-danger">*</span></label>
                            <div class="col-lg-3">
                                <input class="form-control" id="course_name" name="course_name" type="text">
                            </div>
                            <div class="col-lg-5">
                                <textarea class="form-control" id="course_content" name="course_content" rows="1"></textarea>
                            </div>
                            <div class="col-lg-1">
                                <button class="btn btn-success btn-icon btn-circle" type="button" id="btn_course_add"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="course_cnt" id="course_cnt">
                            <table class="table" id="course_table">
                                <thead>
                                    <tr>
                                        <th scope="col">Course name</th>
                                        <th scope="col">Content</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody id="course_tbody">
                                </tbody>
                            </table>
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
