@extends('layout.app')

@section('page-content')
<script src="{{ asset('js/admin/management/menu.js') }}"></script>

<div class="alert alert-custom alert-white alert-shadow fade show gutter-b" role="alert">
    <div class="alert-icon">
        <span class="svg-icon svg-icon-primary svg-icon-xl">
            <!--begin::Svg Icon | path:assets/media/svg/icons/Tools/Compass.svg-->
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24" />
                    <path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3" />
                    <path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero" />
                </g>
            </svg>
            <!--end::Svg Icon-->
        </span>
    </div>
    <div class="alert-text">Menu management is made by jstree.
    <br />Homepage menu can be managed by admin. Link <a href="{{ route('management.menu') }}" class="font-weight-bold">management/menu</a>
    </div>
</div>

<div class="row">

    <div class="col-md-6">
        <div class="card card-custom example example-compact gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">Menu Tree</h3>
                </div>
                <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        <a href="#" class="btn btn-sm btn-success font-weight-bold">
                            <i class="fa fa-plus"></i> New Add
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="tree_card" class="tree-demo"></div>

            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-custom" data-card="true" id="edit_card">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">Card Tools</h3>
                </div>
                <div class="card-toolbar">
                    <a href="#" class="btn btn-icon btn-circle btn-sm btn-light-primary mr-1" data-card-tool="toggle">
                        <i class="ki ki-arrow-down icon-nm"></i>
                    </a>
                    <a href="#" class="btn btn-icon btn-circle btn-sm btn-light-success mr-1" data-card-tool="reload">
                        <i class="ki ki-reload icon-nm"></i>
                    </a>
                </div>
            </div>
            <form>
                <div class="card-body">
                    <div class="form-group mb-8">
                        <div class="alert alert-custom alert-default" role="alert">
                            <div class="alert-icon">
                                <span class="svg-icon svg-icon-primary svg-icon-xl">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Tools/Compass.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3" />
                                            <path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </div>
                            <div class="alert-text">Please edit menu.</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Name (URL) <span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input class="form-control" type="text" id="name" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Title <span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input class="form-control" type="text" id="title" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Description <span class="text-danger">*</span></label>
                        <div class="col-9">
                            <textarea id="description" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Order Number <span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input class="form-control" type="number" id="order_num" />
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-success mr-2" id="btn_save">Save</button>
                            <button type="reset" class="btn btn-secondary" id="btn_reset">Reset</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
