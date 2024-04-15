@extends('student.Website.layout.app')

@section('title', 'Edit Student Profile')

@section('main_content')
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Profile</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#!"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Home</a></li>
                            <li class="breadcrumb-item"><a href="#!">Edit Profile</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Edit {{ Auth::guard('student')->user()->name }}'s account</h5>
                        <hr>
                        <form action="{{ route('student_edit_profile_submit', Auth::guard('student')->user()->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter Name"
                                            value="{{ Auth::guard('student')->user()->name }}">
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="role" class="form-control" placeholder="Enter Name" name="email"
                                            value="{{ Auth::guard('student')->user()->email }}">
                                        @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                        <label class="floating-label" for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Enter password">
                                        @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div> --}}
                                    {{-- <button type="submit" class="btn btn-primary">Update</button>
                                    <button type="submit" class="btn btn-secondary">Back to Profile</button> --}}
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Role</label>
                                        <input type="role" class="form-control" value="Student" readonly>
                                    </div>
                                    <label>Photo</label>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputGroupFile01"
                                                name="photo">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose
                                                file</label>
                                        </div>
                                    </div>
                                    <label>Current Image</label>
                                    <div class="input-group mb-3">
                                        <img src="{{ asset('/storage/uploads/' . Auth::guard('student')->user()->photo) }}"
                                            style="max-width: 257px; max-height: 257px;" class="profile-picture"
                                            alt="User-Image">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" style="margin-left: 10px;">Update</button>
                                <a href="">
                                    <button class="btn btn-secondary" style="margin-left: 10px;">Back to
                                        Profile</button>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection