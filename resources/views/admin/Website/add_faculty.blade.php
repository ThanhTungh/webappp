@extends('admin.Website.layout.app')

@section('title', 'Admin add Faculty')

@section('main_content')
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Add a faculty</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#!"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Add a faculty</a></li>
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
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5>Add a faculty</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('admin_add_faculty_submit') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Faculity Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Name" name="name">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea id="text" class="form-control" rows="4" cols="50"
                                        placeholder="Enter Description" name="description">
                                    </textarea>
                                </div>
                                <button type="submit" class="btn  btn-primary">Submit</button>
                        </div>
                        <div class="col-md-6">
                            <label>Select Date</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Date Start</label>
                                    <input type="date" name="date_start">
                                </div>
                                <div style="margin-left: 5%">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">Date End</label>
                                        <input type="date" name="date_end">
                                    </div>
                                </div>
                            </div>
                            @error('date_start')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror

                            @error('date_end')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <label>Select a Marketing Coordinator</label>
                            <div class="input-group mb-3">
                                <select class="custom-select" id="inputGroupSelect01" name="coordinator">
                                    <option selected>...</option>
                                    @foreach ($coordinators as $coordinator)
                                    <option selected>{{ $coordinator->name }}</option>
                                    @endforeach
                                </select>
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