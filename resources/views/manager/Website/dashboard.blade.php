@extends('manager.Website.layout.app')

@section('title', 'Manager Dashboard')

@section('main_content')
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Dashboard</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#!"><i class="feather icon-bar-chart"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Dashboard</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- table card-1 start -->
            <div class="col-md-12 col-xl-4">
                <div class="card flat-card">
                    <div class="row-table">
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="icon feather icon-eye text-c-green mb-1 d-block"></i>
                                </div>
                                <div class="col-sm-4 text-md-center">
                                    <h5>{{ $num_students }}</h5>
                                    <span>Students</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-table">
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="icon feather icon-file-text text-c-blue mb-1 d-block"></i>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                    <h5>{{ $num_ideas }}+</h5>
                                    <span>Files uploaded</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="icon feather icon-mail text-c-yellow mb-1 d-block"></i>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                    <h5>{{ $num_faculties }}</h5>
                                    <span>Total Faculties</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- table card-1 end -->
            <!-- table card-2 start -->
            <div class="col-md-12 col-xl-4">
                <div class="card flat-card">
                    <div class="row-table">
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="icon feather icon-share-2 text-c-blue mb-1 d-block"></i>
                                </div>
                                <div class="col-sm-5 text-md-center">
                                    <h5>{{ $num_managers }}</h5>
                                    <span>Marketing Managers</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-table">
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="icon feather icon-file-text text-c-blue mb-1 d-block"></i>
                                </div>
                                <div class="col-sm-4 text-md-center" style="text-align: center">
                                    <h5>{{ $num_ideasStatus }}</h5>
                                    <span>Contributions Approved</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- table card-2 end -->
            <div class="col-md-12 col-xl-4">
                <div class="card flat-card">
                    <div class="row-table">
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="icon feather icon-eye text-c-green mb-1 d-block"></i>
                                </div>
                                <div class="col-sm-4 text-md-center">
                                    <h5>{{ $num_coordinators }}</h5>
                                    <span>Coordinator</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-table">
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="icon feather icon-file-text text-c-blue mb-1 d-block"></i>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                    <h5>{{ $num_comments }} +</h5>
                                    <span>Files Comment</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="icon feather icon-file-text text-c-red mb-1 d-block"></i>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                    <h5>0</h5>
                                    <span>Missing Comments</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- prject ,team member start -->
            <div class="col-xl-6 col-md-12">
                <div class="card table-card">
                    <div class="card-header">
                        <h5>Recent Faculties</h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item full-card"><a href="#!"><span><i
                                                    class="feather icon-maximize"></i> maximize</span><span
                                                style="display:none"><i class="feather icon-minimize"></i>
                                                Restore</span></a></li>
                                    <li class="dropdown-item minimize-card"><a href="#!"><span><i
                                                    class="feather icon-minus"></i> collapse</span><span
                                                style="display:none"><i class="feather icon-plus"></i> expand</span></a>
                                    </li>
                                    <li class="dropdown-item reload-card"><a href="#!"><i
                                                class="feather icon-refresh-cw"></i> reload</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Faculty</th>
                                        <th>Coordinator Assigned</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($faculties as $faculty)
                                    <tr>
                                        
                                        <td>
                                            <div class="d-inline-block align-middle">
                                                <div class="d-inline-block">
                                                    <h6>{{ $faculty->name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $faculty->coordinator->name }}</td>
                                        <td>{{ $faculty->created_at }}</td>
                                        <td>{{ $faculty->updated_at }}</td>
                                       
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-12">
                <div class="card latest-update-card">
                    <div class="card-header">
                        <h5>Lastest Updates</h5>
                    </div>
                    <div class="card-body">
                        <div class="latest-update-box">
                            <div class="row p-t-30 p-b-30">
                            </div>
                            <div class="row p-b-30">
                                <div class="col-auto text-right update-meta">
                                    <p class="text-muted m-b-0 d-inline-flex">...</p>
                                    <i class="feather icon-briefcase bg-c-red update-icon"></i>
                                </div>
                                <div class="col">
                                    <a href="#!">
                                        <h6>+ {{ $num_ideas }} Contributions were added</h6>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
@endsection