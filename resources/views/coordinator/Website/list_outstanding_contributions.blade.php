@extends('coordinator.Website.layout.app')

@section('title', 'List Outstanding Contributions')

@section('main_content')
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">List Outstanding Contributions</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#!"><i class="feather icon-home"></i> Back</a></li>
                            {{-- <li class="breadcrumb-item"><a href="#!">List Outstanding Ideas</a></li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5>Typical Contributions</h5>
                </div>
                <div class="card-body table-border-style d-flex justify-content-between align-items-center">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Topic</th>
                                    <th>Tag</th>
                                    <th>File</th>
                                    {{-- <th>Image</th> --}}
                                    <th>Faculity</th>
                                    <th>Student</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contributions as $contribution)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $contribution->topic }}</td>
                                    <td>{{ $contribution->tag }}</td>
                                    <td>
                                        <a href="{{ route('coordinator_download_file', $contribution->file) }}">
                                            <i class="feather mr-2 icon-file"></i>
                                            {{ $contribution->file }}
                                        </a>
                                    </td>
                                    {{-- <td>
                                        <img src=""
                                            style="max-width: 257px; max-height: 257px;" class="profile-picture"
                                            alt="User-Image">
                                    </td> --}}
                                    <td>{{ $contribution->faculty->name }}</td>
                                    <td>{{ $contribution->student->name }}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

</section>
@endsection