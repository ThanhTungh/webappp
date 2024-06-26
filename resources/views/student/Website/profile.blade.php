@extends('student.Website.layout.app')

@section('title', 'Student Profile')

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
                            <li class="breadcrumb-item"><a href="#!">Profile</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="profile-header">
                <div class="profile-info-wrapper">
                    <img src="{{ asset('/storage/uploads/' . Auth::guard('student')->user()->photo) }}"
                        style="max-width: 257px; max-height: 257px;" class="profile-picture" alt="User-Image">
                    <div class="profile-info">
                        <h2>{{ Auth::guard('student')->user()->name }}</h2>
                        <span class="profile-info-label">Email : {{ Auth::guard('student')->user()->email }}</span>
                        <span class="profile-info-label">Role : {{ Auth::guard('student')->user()->role }}</span>
                        <span class="profile-info-label">Joined : {{ Auth::guard('student')->user()->created_at }}
                        </span>
                    </div>
                </div>
            </div>

        </div>

        <div style="margin-left: 35%;margin-top: 2%;">
            <a href="{{ route('student_edit_profile', Auth::guard('student')->user()->id) }}">
                <button type="button"
                    class="btn btn-info"><i class="feather mr-2 icon-edit"></i>Edit
                </button>
            </a>
            <a href="#!">
                <button type="button" class="btn btn-secondary"><i class="feather mr-2 icon-home"></i>Back to Homepage
                </button>
            </a>
        </div>
    </div>
</div>

</div>

@endsection