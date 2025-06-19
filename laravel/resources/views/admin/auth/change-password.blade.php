@extends('admin.layouts.master')
@section('title', 'Change Password')

@section('breadcrumb-title')
Change Password
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Change Password</li>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-4 col-md-4"></div>
    <div class="col-lg-4 col-md-4">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="header-title mt-0 m-b-20">Change Password</h4>
                <form action="{{route('save-change-password')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="for_cp" class="col-form-label">Current Password</label>
                                <input name="currentpassword" value="{{ old('currentpassword') }}" class="form-control" placeholder="Enter Current Password" type="password" id="for_cp" required />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="for_np" class="col-form-label">New Password</label>
                                <input name="newpassword"class="form-control" placeholder="Enter New Password" type="password" id="for_np" required />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="for_ncp" class="col-form-label">Confirm Password</label>
                                <input name="newpasswordagain" class="form-control" placeholder="Enter Confirm Password" type="password" id="for_ncp" required />
                            </div>
                        </div>
                        @include('admin.auth.flash-message')
                        <div class="col-md-12">
                            <button class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-check"></i> Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
@endsection
