@extends('admin.Website.layout.app')

@section('title', 'Admin edit account Student')

@section('main_content')
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Edit</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#!"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Edit an account</a></li>
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
                        <h5>Edit {{ $single_student->name }}'s account</h5>
                        <hr>
                        <div class="row">

                            <div class="col-md-6">
                                <form action="{{ route('admin_edit_account_student_submit', $single_student->id) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" placeholder="Enter Name" name="name"
                                            value="{{ $single_student->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="floating-label" for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Enter password">
                                        @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
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
                                    <button type="submit" class="btn  btn-primary">Update</button>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Enter email"
                                        value="{{ $single_student->email }}">
                                </div>
                                <div class="form-group">
                                    <label>Current faculty:
                                        {{-- @if($single_student->faculty_id != 0) --}}
                                        @isset($single_student->faculty)
                                        {{ $single_student->faculty->name }}
                                        @else
                                        @php
                                        $single_student->faculty_id = 0;
                                        $single_student->update();
                                        @endphp
                                        No Faculty
                                        @endisset

                                        {{-- @else
                                        No Faculty

                                        @endif --}}
                                    </label>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection