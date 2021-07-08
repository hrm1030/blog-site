@extends('layout.app')

@section('page-content')
<div class="alert alert-custom alert-white alert-shadow fade show gutter-b" role="alert">
    <div class="alert-icon">
        <i class="fas fa-university"></i>
    </div>
    <div class="alert-text">
    Department & Courses. In this page, you can see the description and courses of department.
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label text-primary"> {{ $department->name }} </h3>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-10 mt-5 font-weight-bold">{{ $department->description }}</div>
                <hr>
                <!--begin::Accordion-->
                <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample3">
                    @foreach($courses as $course)
                    <div class="card">
                        <div class="card-header" id="headingOne3">
                            <div class="card-title" data-toggle="collapse" data-target="#collapseOne_{{ $course->id }}">{{ $course->name }}</div>
                        </div>
                        <div id="collapseOne_{{ $course->id }}" class="collapse" data-parent="#accordionExample3">
                            <div class="card-body">{{ $course->content }}</div>
                        </div>
                    </div>
                    @endforeach

                </div>
                <!--end::Accordion-->
            </div>
        </div>
    </div>

</div>
@endsection
