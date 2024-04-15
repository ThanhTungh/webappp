@extends('guest.layout.app')

@section('title', 'Guest Home')

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
        <div class="card-columns">

            <!-- Chạy form từ đây -->
            @foreach ($ideas as $idea)
            <div class="card">
                <img src="https://media.istockphoto.com/id/1410046653/vector/cute-school-kids-around-chalkboard-happy-children-with-empty-blackboard-banner-with-adorable.jpg?s=1024x1024&w=is&k=20&c=Tt-ykpYpAv-JrCfyeNIrV0cpR7ife87gdhF838M9wRY="
                          style="max-width: 257px; max-height: 257px;"class="profile-picture" alt="Banner">
                <div class="card-body">

                    <h5 class="card-title">Topic: {{ $idea->topic }}</h5>
                    <h7 class="card-title">Tag#: {{ $idea->tag }}</h7> <br>
                    <h7 class="card-title">Faculty: {{ $idea->faculty->name }}</h7> <br>
                    <h7 class="card-title">Student: {{ $idea->student->name }}</h7> <br>
                    {{-- <p class="card-text">View this contribution
                        <a href="#!">This Faculity</a>
                    </p> --}}
                    <br>
                    <a href="{{ route('guest_view_contribution', $idea->id) }}">
                        <button class="btn  btn-primary">View this contribution here</button>
                    </a>
                    
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
@endsection