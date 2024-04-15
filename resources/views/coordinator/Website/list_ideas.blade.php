@extends('coordinator.Website.layout.app')

@section('title', 'List Faculity')

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
                        </div>
                        <div class="col-md-6">
                            @foreach ($single_faculty->ideas as $item)
                            {{-- <form> --}}
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
                                    <th><a href="{{ route('coordinator_download_file', $item->file) }}"><i
                                                class="feather mr-2 icon-file"></i>Download file "{{ $item->file }}"</a>
                                        <br>
                                    </th>
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
                                <!-- Comment !-->
                                @if ($item->status == 0)
                                <a href="{{ route('coordinator_choose_typical_idea', $item->id) }}">
                                    <button type="submit" class="btn btn-primary">
                                        Choose this typical contribution
                                    </button>
                                </a> 
                                @else
                                <a href="{{ route('coordinator_remove_typical_idea', $item->id) }}">
                                    <button type="submit" class="btn btn-primary" style="background-color: red">
                                        Remove this idea from the list of typical contributions!
                                    </button>
                                </a> 
                                @endif
                                
                                
                                <br><br>

                                <p><a class="btn mb-1 btn-primary" data-toggle="collapse" href="#multiCollapseExample1">
                                        <i class="feather mr-2 icon-message-square"></i>Comment</a>
                                <div class="collapse multi-collapse mt-2" id="multiCollapseExample1">
                                    <div class="card">
                                        <form action="{{ route('coordinator_comment_submit', $item->id) }}"
                                            method="POST">
                                            @csrf
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label>Comment</label>
                                                    <textarea id="text" class="form-control" rows="4" cols="50"
                                                        placeholder="Enter Comment" name="content">
                                                    @isset($item->comment->content)
                                                    {{ $item->comment->content }}
                                                    @endisset
                                                    </textarea>
                                                </div>
                                                
                                                @isset($item->comment->content)
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                @else
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                @endisset
                            
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                </p>
                            {{-- </form> --}}

                            <br>

                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection