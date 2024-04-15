@extends('admin.Website.layout.app')

@section('title', 'Admin add account')

@section('main_content')

<section class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Add an account</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#!"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Add an account</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
            </div>
        </div>
        <!-- [ form-element ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5>Add a user</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('admin_add_account_submit') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Name">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        <input type="file" class="custom-file-input" name="photo" id="inputGroupFile01">
                                        @error('photo')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="Enter email">
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <label>Select a Role</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Role</label>
                                </div>
                                <select class="custom-select" id="inputGroupSelect01" name="role">
                                    <option selected>Marketing Manager</option>
                                    <option selected>Marketing Coordinator</option>
                                    <option selected>Student</option>
                                </select>
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