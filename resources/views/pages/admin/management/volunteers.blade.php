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

<script src="{{ asset('js/admin/management/volunteers.js') }}"></script>

<div class="alert alert-custom alert-white alert-shadow fade show gutter-b" role="alert">
    <div class="alert-icon">
        <i class="icon-2x text-dark-50 flaticon-users"></i>
    </div>
    <div class="alert-text">
    Volunteer list can be managed by admin. Link <a href="{{ route('management.volunteers') }}" class="font-weight-bold">management/volunteers</a>
    </div>
</div>
<div class="card card-custom">
    <div class="card-header flex-wrap py-5">
        <div class="card-title">
            <h3 class="card-label">Volunteer Management
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
        <table class="table table-separate table-head-custom table-checkable" id="volunteer_table">
            <thead>
                <tr>
                    <th width="20%"><i class="icon-xl la la-user"></i> Volunteer</th>
                    <th width="40%"><i class="fa fa-map-marker-alt"></i> volunteer/Faculty/Department</th>
                    <th width="15%"><i class="fas fa-tags"></i> Major</th>
                    <th width="15%"><i class="icon-xl la la-calendar-alt"></i> Birthday</th>
                    <th width="15%">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($volunteers as $volunteer)
                @php
                    // die(print_r($volunteer[0]['volunteer']->id));
                @endphp
                    <tr>
                        <td>
                            @if (isset($volunteer->photo) && $volunteer->photo != '')
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-50 flex-shrink-0">
                                    <img src="{{ asset($volunteer->photo) }}" alt="photo">
                                </div>
                                <div class="ml-3">
                                    <span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2">{{ $volunteer->fullname }}</span>
                                    <a href="#" class="text-muted text-hover-primary">{{ $volunteer->email }}</a><br>
                                    <a href="#" class="text-muted text-hover-primary">{{ $volunteer->phone }}</a>
                                </div>
                            </div>
                            @else
                            <div class="d-flex align-items-center">
                                @php
                                    $color_array = array('success', 'danger', 'success', 'warning', 'dark', 'primary', 'info');
                                    $color = array_rand($color_array, 1);
                                @endphp
                                <div class="symbol symbol-50 symbol-light-{{ $color_array[$color] }}" flex-shrink-0>
                                    <div class="symbol-label font-size-h5">{{ ucwords($volunteer->fullname[0]) }}</div>
                                </div>
                                <div class="ml-3">
                                    <span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2">{{ $volunteer->fullname }}</span>

                                </div>
                            </div>
                            @endif
                        </td>
                        <td>
                            <span class="font-weight-bolder text-danger">{{ $volunteer->university_name }}</span>/<span class="font-weight-bolder text-success">{{ $volunteer->faculty_name }}</span>/<span class="font-weight-bolder text-primary">{{ $volunteer->department_name }}</span>
                        </td>
                        <td>
                            {{ $volunteer->majors }}
                        </td>
                        <td>
                            {{ $volunteer->birthday }}
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary btn_edit" volunteer_id="{{ $volunteer->id }}" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></button>
                            <button type="button" class="btn btn-sm btn-danger btn_delete" volunteer_id="{{ $volunteer->id }}" data-toggle="tooltip" title="Delete"><i class="far fa-trash-alt"></i></button>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <!--end: Datatable-->
    </div>
</div>

<div class="modal fade" id="volunteerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeLg" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Volunteer Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{ route('management.volunteer.save') }}" method="POST" enctype="multipart/form-data" id="volunteer_form">
                    @csrf
                    <input type="hidden" name="volunteer_id" id="volunteer_id">
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Volunteer Image <span class="text-danger">*</span></label>
                            <div class="col-lg-9 col-xl-6">
                                <div class="image-input image-input-outline" id="kt_volunteer_image" style="background-image: url({{ asset('assets/media/users/blank.png') }})">

                                    <div class="image-input-wrapper"></div>
                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="volunteer_image" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="volunteer_image_remove" />
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
                            <label class="col-xl-3 col-lg-3 col-form-label">Volunteer Name <span class="text-danger">*</span></label>
                            <div class="col-lg-9 col-xl-6">
                                <input class="form-control" type="text" id="name" name="name" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Email <span class="text-danger">*</span></label>
                            <div class="col-lg-9 col-xl-6">
                                <input class="form-control" type="email" id="email" name="email" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Phone <span class="text-danger">*</span></label>
                            <div class="col-lg-9 col-xl-6">
                                <input class="form-control" type="text" id="phone" name="phone" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Website <span class="text-danger">*</span></label>
                            <div class="col-lg-9 col-xl-6">
                                <input class="form-control" type="text" id="website" name="website" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Birthday <span class="text-danger">*</span></label>
                            <div class="col-lg-9 col-xl-6">
                                <div class="input-group date">
                                    <input type="text" class="form-control" id="birthday" data-date-format="yyyy-mm-dd" name="birthday" readonly="readonly" placeholder="Select date" />
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-calendar-check-o"></i>
                                        </span>
                                    </div>
                                </div>
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
                            <label class="col-xl-3 col-lg-3 col-form-label">Department <span class="text-danger">*</span></label>
                            <div class="col-lg-9 col-xl-6">
                                <select class="form-control" name="department" id="department" style="width: 100%">
                                    <option value=""></option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Major <span class="text-danger">*</span></label>
                            <div class="col-lg-9 col-xl-6">
                                <input class="form-control" type="text" id="major" name="major" />
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
