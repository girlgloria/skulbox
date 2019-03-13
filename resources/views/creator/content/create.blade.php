@extends('layouts.backend')
@section('content')
    <div class="wrapper">
        @include('partial.admin.nav-header')
        @include('partial.admin.sidebar')
        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <div class="page-header">
                        <h4 class="page-title">Resources</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-10 offset-1">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Upload</h4>
                                </div>
                                <div class="card-body">
                                    <div class="card-body">
                                        <form action="{{ route('resource.store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <input type="hidden" id="file" name="file">
                                                <input type="hidden" id="type" name="type">
                                                    <div class="form-group col-sm-6">
                                                        <label for="fileupload">Upload File {Choose The File To Upload}</label>
                                                        <input id="fileupload" type="file" class="form-control" name="file" data-url="{{ route('resources.upload') }}" style="display: inline;">
                                                        <ul id="file-upload-list" class="list-unstyled text-center">
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6" id="hideme2" style="visibility: hidden">
                                                        <div class="form-group">
                                                            <label for="image">Background Image {Less Than 1MB}</label>
                                                            <input type="file" name="image" id="image" accept="image/*" class="form-control">
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="row" id="hideme1" style="visibility: hidden">
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="title">Title</label>
                                                        <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="content_type">Resource Type</label>
                                                        <select name="content_type" id="content_type" class="form-control">
                                                            <option value="public">Public - Everyone Can See & Download</option>
                                                            <option value="private">Private - Only You Can See</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="description">Description</label>
                                                        <input type="text" name="description" class="form-control" id="description" placeholder="Description">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="cost"><b>Price {If Free Leave Blank or Enter 0 }</b></label>
                                                        <input type="number" min="0" name="cost" class="form-control" id="cost" placeholder="Price">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-lg-12">
                                                    <div class="col-md-6">
                                                        <b>Resource Categories</b>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="selectgroup selectgroup-pills">
                                                            @foreach($cats as $cat)
                                                                <label class="selectgroup-item">
                                                                    <input type="checkbox" name="categories[]" value="{{ $cat->id }}" class="selectgroup-input">
                                                                    <span class="selectgroup-button">{{ ucwords($cat->name) }}</span>
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <button class="btn btn-primary pull-right">Upload</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('partial.admin.footer')
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.fileupload.js') }}"></script>
    <script>
        var $ = window.$; // use the global jQuery instance

        var $uploadList = $("#file-upload-list");
        var $fileUpload = $('#fileupload');
        var url = $fileUpload.attr('data-url');
        console.log(url);
        if ($uploadList.length > 0 && $fileUpload.length > 0) {

            var idSequence = 0;

            // A quick way setup - url is taken from the html tag
            $fileUpload.fileupload({
                maxChunkSize: 1000000,
                method: "POST",
                // Not supported
                sequentialUploads: false,
                formData: function (form) {
                    // Append token to the request - required for web routes
                    return [{name: '_token', value: $('input[name=_token]').val()}];
                },
                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $("#" + data.theId).text('Uploading ' + progress + '%');
                    $('#fileupload').attr('disabled',true);
                },
                add: function (e, data) {
                    data._progress.theId = 'id_' + idSequence;
                    idSequence++;
                    $uploadList.empty().append($('<li id="' + data.theId + '"></li>').text('Uploading'));

                    data.submit();
                },
                done: function (e, data) {
                    console.log('hello');
                    document.getElementById("hideme1").style.visibility = 'visible';
                    document.getElementById("hideme2").style.visibility = 'visible';
                    $('#file').val(data.result.path+data.result.name);
                    $('#type').val(data.result.type);
                    // $uploadList.append($('<li></li>').text('Uploaded: ' + data.result.path + ' ' + data.result.name));
                }
            });
        }
    </script>
@endsection
