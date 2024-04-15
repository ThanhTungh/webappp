@extends('admin.Website.layout.app')

@section('title', 'Admin add event')

@section('main_content')
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">List contributions</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#!"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">List contributions</a></li>
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
                    <a href="#!">
                        <button class="btn btn-primary">Back to Faculity</button></a>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <form>

                                <b>
                                    <p style="font-size: 150%">Faculty :
                                        {{ $single_faculty->name }}</p>
                                </b>

                                <div class="form-group">
                                    <label>Description:</label>
                                    <p>{{ $single_faculty->description }}</p>
                                    <li><b>Deadline <i class="feather mr-2 icon-calendar"></i></b>: {{
                                        $single_faculty->date_start }} -
                                        {{ $single_faculty->date_end }}</li>
                                </div>

                            </form>
                        </div>
                        <div class="col-md-6">
                            <form>
                                <img alt="No image"
                                    src="https://wallpapers-clan.com/wp-content/uploads/2023/02/anime-boy-black-pfp-28.jpg"
                                    class="img-radius" style="max-width: 50px; max-height: 50px">
                                <span>User X</span>
                                <p>
                                    <i class="feather mr-2 icon-calendar"></i>
                                    Created on <b>March-26-2024 - 04-38-00 p.m</b>
                                </p>
                                <p>
                                    Encouraging employee participation in quality improvement intiatives through
                                    incentives and recognition
                                </p>
                                <!-- Download File !-->
                                <div class=" download" style="margin-left: 220px">
                                    <a href="#!">
                                        <button class="btn btn-primary event-btn m-2" type="button">
                                            <span class="spinner-border spinner-border-sm" role="status"></span>
                                            <span class="load-text">Loading...</span>
                                            <span class="btn-text"><i class="feather mr-2 icon-download"></i>Download
                                                file (as . zip)</span>
                                        </button>
                                    </a>
                                </div>
                                <img src="https://media.istockphoto.com/id/1410046653/vector/cute-school-kids-around-chalkboard-happy-children-with-empty-blackboard-banner-with-adorable.jpg?s=1024x1024&w=is&k=20&c=Tt-ykpYpAv-JrCfyeNIrV0cpR7ife87gdhF838M9wRY="
                                    style="max-width: 257px; max-height: 257px; margin-left: 220px"
                                    class="profile-picture" alt="User-Image">
                                <!-- Comment !-->
                                <p><a class="btn mb-1 btn-primary" data-toggle="collapse" href="#multiCollapseExample1">
                                        <i class="feather mr-2 icon-message-square"></i>Comment</a>
                                <div class="collapse multi-collapse mt-2" id="multiCollapseExample1">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Comment</label>
                                                <textarea id="text" class="form-control" rows="4" cols="50"
                                                    placeholder="Enter Comment"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection