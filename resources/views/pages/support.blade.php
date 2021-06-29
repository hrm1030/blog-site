@extends('layout.app')

@section('page-content')

@isset($alert)
    <script>
        var alert = "{!! $alert !!}";
    </script>
@else
<script>
    var alert = "";
</script>
@endisset
<script src="{{ asset('js/support.js') }}"></script>
<div class="alert alert-custom alert-white alert-shadow fade show gutter-b" role="alert">
    <div class="alert-icon">
        <i class="fas fa-university"></i>
    </div>
    <div class="alert-text">
    Support. In this page, you can support for your issues.
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h5 class="card-label">Send us your enquiries</h5>
                </div>
            </div>
            <!--begin::Form-->
            <form class="form" action="{{ url('/support/save') }}" method="POST" id="support_form">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3"></div>
                        <div class="col-xl-6">
                            <!--begin::Input-->
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" id="name" name="name" placeholder="Enter your name" />
                            </div>
                            <!--end::Input-->
                            <!--begin::Input-->
                            <div class="form-group">
                                <label>Email address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Enter email" />
                            </div>
                            <!--end::Input-->
                            <!--begin::Input-->
                            <div class="form-group">
                                <label for="content">Your Message <span class="text-danger">*</span></label>
                                <textarea class="form-control form-control-lg" name="content" id="content" rows="3"></textarea>

                            </div>
                            <!--end::Input-->
                        </div>
                        <div class="col-xl-3"></div>
                    </div>
                </div>
                <!--begin::Actions-->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-xl-3"></div>
                        <div class="col-xl-6">
                            <button type="button" id="btn_send" class="btn btn-primary font-weight-bold mr-2">Submit</button>
                            <button type="reset" class="btn btn-clean font-weight-bold">Cancel</button>
                        </div>
                        <div class="col-xl-3"></div>
                    </div>
                </div>
                <!--end::Actions-->
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
@endsection
