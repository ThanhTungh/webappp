@extends('manager.Website.layout.app')

@section('title', 'List Contributions')

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
                                    <b>Deadline <i class="feather mr-2 icon-calendar"></i></b>: {{
                                        $single_faculty->date_start }} -
                                        {{ $single_faculty->date_end }}
                                </div>

                            </form>
                            
                            <div class=" download" style="margin-left: 220px">
                                <a href="{{ route('manager_download_file', $single_faculty->id) }}">
                                    <button class="btn btn-primary event-btn m-2" type="button">
                                        <span class="spinner-border spinner-border-sm" role="status"></span>
                                        <span class="load-text">Loading...</span>
                                        <span class="btn-text"><i class="feather mr-2 icon-download"></i>Download all student files (as . zip)</span>
                                    </button>
                                </a>
                            </div>

                        </div>
                        <div class="col-md-6">
                            @foreach ($single_faculty->ideas as $item)
                                <img alt="No image" src="{{ asset('/storage/uploads/'.$item->student->photo) }}"
                                    class="img-radius" style="max-width: 50px; max-height: 50px">
                                <span>{{ $item->student->name }}</span>

                                <p>
                                    <i class="feather mr-2 icon-calendar"></i>
                                    Created at <b>{{ $item->created_at }}</b>
                                </p>
                                <p>
                                    Topic: {{ $item->topic }} <br>
                                    Tag#: {{ $item->tag }}
                                </p>
                                <tr>
                                    <td class="table-active">File submissions: {{ $item->file }}</td>
                                    <br>
                                    {{-- <th><a href="{{ route('coordinator_download_file', $item->file) }}"><i
                                                class="feather mr-2 icon-file"></i>Download file "{{ $item->file }}"</a>
                                        <br>
                                    </th> --}}
                                </tr>
                                <!-- Download File !-->
                                {{-- <div class=" download" style="margin-left: 220px">
                                    <a href="#!">
                                        <button class="btn btn-primary event-btn m-2" type="button">
                                            <span class="spinner-border spinner-border-sm" role="status"></span>
                                            <span class="load-text">Loading...</span>
                                            <span class="btn-text"><i class="feather mr-2 icon-download"></i>Download
                                                file (as . zip)</span>
                                        </button>
                                    </a>
                                </div> --}}
                                <img src="https://media.istockphoto.com/id/1410046653/vector/cute-school-kids-around-chalkboard-happy-children-with-empty-blackboard-banner-with-adorable.jpg?s=1024x1024&w=is&k=20&c=Tt-ykpYpAv-JrCfyeNIrV0cpR7ife87gdhF838M9wRY="
                                    style="max-width: 257px; max-height: 257px; margin-left: 220px"
                                    class="profile-picture" alt="User-Image">

                            <br> <br>

                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection