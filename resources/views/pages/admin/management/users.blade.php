@extends('layout.app')

@section('page-content')
<script src="{{ asset('js/admin/management/users.js') }}"></script>

<div class="alert alert-custom alert-white alert-shadow fade show gutter-b" role="alert">
    <div class="alert-icon">
        <i class="icon-2x text-dark-50 flaticon-users"></i>
    </div>
    <div class="alert-text">
    User list can be managed by admin. Link <a href="{{ route('management.users') }}" class="font-weight-bold">management/users</a>
    </div>
</div>
<div class="card card-custom">
    <div class="card-header flex-wrap py-5">
        <div class="card-title">
            <h3 class="card-label">User Management
            <div class="text-muted pt-2 font-size-sm">custom colu rendering</div></h3>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="user_table">
            <thead>
                <tr>
                    <th width="18%"><i class="fas fa-user-alt"></i> User</th>
                    <th width="18%"><i class="fas fa-envelope"></i> Email</th>
                    <th width="13%"><i class="fas fa-phone"></i> Phone</th>
                    <th width="13%"><i class="far fa-calendar-check"></i> Created Date</th>
                    <th width="10%">Status</th>
                    <th width="13%">Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr user_id="{{ $user->id }}">
                    <td>
                        @if (isset($user->photo))
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-50 flex-shrink-0">
                                <img src="{{ asset($user->photo) }}" alt="photo">
                            </div>
                            <div class="ml-3">
                                <span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2"><i class="fas fa-at text-dark-75"></i>{{ $user->username }}</span>
                                <a href="#" class="text-muted text-hover-primary">{{ $user->firstname }} {{ $user->lastname }}</a>
                            </div>
                        </div>
                        @else
                        <div class="d-flex align-items-center">
                            @php
                                $color_array = array('success', 'danger', 'warning', 'dark', 'primary', 'info');
                                $color = array_rand($color_array, 1);
                            @endphp
                            <div class="symbol symbol-50 symbol-light-{{ $color_array[$color] }}" flex-shrink-0>
                                <div class="symbol-label font-size-h5">{{ ucwords($user->username[0]) }}</div>
                            </div>
                            <div class="ml-3">
                                <span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2"><i class="fas fa-at text-dark-75"></i>{{ $user->username }}</span>
                                <a href="#" class="text-muted text-hover-primary">{{ $user->firstname }} {{ $user->lastname }}</a>
                            </div>
                        </div>
                        @endif
                    </td>
                    <td><a class="text-dark-50 text-hover-primary" href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                    <td>{{ $user->phone }}</td>
                    <td>
                        @php
                            $date = date_parse($user->created_at);
                        @endphp
                        {{ $date['day'] }}/{{ $date['month'] }}/{{ $date['year'] }}
                    </td>
                    <td id="state_td_{{ $user->id }}">
                        @if($user->state == 1)
                        <span class="label label-lg font-weight-bold label-light-success label-inline">Actived</span>
                        @else
                        <span class="label label-lg font-weight-bold label-light-danger label-inline">Disabled</span>
                        @endif
                    </td>
                    <td id="permission_td">
                        @if($user->permission == 1)
                        <span class="label label-lg font-weight-bold label-success label-inline">Administrator</span>
                        @else
                        <span class="label label-lg font-weight-bold label-info label-inline">Common User</span>
                        @endif
                    </td>
                    <td>
                        <div class="row">
                            @if($user->state == 1)
                            <select class="form-control col-md-7 state">
                                <option value="1" selected>Enable</option>
                                <option value="0" >Disable</option>
                            </select>
                            @else
                            <select class="form-control col-md-7 state">
                                <option value="1" >Enable</option>
                                <option value="0" selected>Disable</option>
                            </select>
                            @endif

                            <button type="button" class="btn btn-icon btn-danger btn-sm mr-2 btn_delete" data-toggle="tooltip" title="Delete"><i class="fas fa-trash-alt"></i></button>
                        </div>

                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        <!--end: Datatable-->
    </div>
</div>
@endsection
