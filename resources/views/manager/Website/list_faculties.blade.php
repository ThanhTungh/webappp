@extends('manager.Website.layout.app')

@section('title', 'Manager Events')

@section('main_content')
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Faculties</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#!"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">List Faculties</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Management Faculties</h5>
                    </div>
                    <div class="card-body table-border-style d-flex justify-content-between align-items-center">
                        <div class="table-responsive">
                            <a href="{{ route('admin_add_faculty') }}" <button type="button" class="btn btn-success"
                                style="float:right" ;><i class="feather mr-2 icon-plus-circle"></i>Add a
                                Faculity</button></a>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Faculty</th>
                                        <th>Time Start</th>
                                        <th>Time End</th>
                                        <th>Coordinator</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($faculties as $faculty)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="{{ route('manager_ideas', $faculty->id) }}">{{ $faculty->name }}</a>
                                        </td>
                                        <td>{{ $faculty->date_start }}</td>
                                        <td>{{ $faculty->date_end }}</td>
                                        <td>
                                            @isset($faculty->coordinator->name)
                                            {{ $faculty->coordinator->name }}
                                            @else
                                            @php
                                                $faculty->coordinator_id = 0;
                                                $faculty->update();
                                            @endphp
                                            No Coordinator
                                            @endisset
                                        </td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection