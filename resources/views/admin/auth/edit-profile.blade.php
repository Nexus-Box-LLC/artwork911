@extends('admin.layouts.master')
@section('title', 'Update Profile')

@section('breadcrumb-title')
Update Profile
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Update Profile</li>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-4 col-md-4"></div>
    <div class="col-lg-4 col-md-4">

        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="header-title mt-0 m-b-20">Update Profile</h4>

                <form action="{{ route('save-update-profile') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="for_usrname" class="col-form-label">Company Name</label>
                                <input class="form-control"  name="company_name" placeholder="Enter Company Name" type="text" id="for_usrname" value="{{$data['company_name']}}" required />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="for_last_name" class="col-form-label">Username</label>
                                <input class="form-control" name="username" placeholder="Enter Username" type="text" id="for_last_name" value="{{$data['username']}}" required />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="for_email" class="col-form-label">Email Address</label>
                                <input class="form-control" placeholder="Enter Email Address" type="email" id="for_email" value="{{$data['email']}}" name="email" required  />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-form-label">Profile image *</label>
                                <input class="form-control" type="file" name="profile_image">
                            </div>
                        </div>
                        @if (!empty($data->profile_image))
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="card-profile">
                                    <img class="rounded-circle" src='{{asset("Admi/admin_profile_image/$data->profile_image")}}' style="width: 50px;">
                                </div>
                            </div>
                        </div>
                        @endif
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

