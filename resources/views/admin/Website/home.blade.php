@extends('admin.Website.layout.app')

@section('title', 'Admin Home')

@section('main_content')
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Home</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#!"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Home</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-columns"
            style="display: flex; flex-wrap: wrap; justify-content: space-around; align-items: stretch;">
            <div class="card"
                style="width: 300px; margin: 10px; padding: 20px; border: 1px solid #ccc; border-radius: 5px; text-align: center;">
                <img class="img-fluid card-img-top"
                    src="https://psmag.com/.image/ar_1:1%2Cc_fill%2Ccs_srgb%2Cfl_progressive%2Cq_auto:good%2Cw_1200/MTMxODI3Mjk4OTkwMDgyMDU4/shutterstock_125158133jpg.jpg"
                    alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Project Ideas To Stimulate Your Creativity</h5>
                    <p class="card-text">Completing creative projects can help you relax and develop your skills.
                        When you have free time, consider working on creative projects that can benefit you
                        personally and professionally. You can try dozens of projects that are quick and easy to
                        complete.</p>
                </div>
            </div>
            <div class="card"
                style="width: 300px; margin: 10px; padding: 20px; border: 1px solid #ccc; border-radius: 5px; text-align: center;">
                <img class="img-fluid card-img-top"
                    src="https://greenwich.edu.vn/wp-content/uploads/2022/07/2.jpeg"
                    alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Student Commendation Awards</h5>
                    <p class="card-text">

                        Student Voice Commendation
                        Awarded to a student or students who promote student interests through engagement with the
                        University. The student will champion the student voice and promote positive change.</p>
                </div>
            </div>
            <div class="card"
                style="width: 300px; margin: 10px; padding: 20px; border: 1px solid #ccc; border-radius: 5px; text-align: center;">
                <img class="img-fluid card-img-top" src="https://thanhnien.mediacdn.vn/uploaded/dieutrang.qc/2021_04_23/greenwish/greenwich-3_DCDV.jpg?width=500"
                    alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Teacher Appreciation</h5>
                    <p class="card-text">Have you ever thought that teachers have spent their entire lives awarding
                        Certificates of Merit to students? What are the silent contributions of teachers? Where will
                        it be recorded? More than a thank you, FPT Edu wishes to accompany students to create
                        "special gifts" for teachers on November 20.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection