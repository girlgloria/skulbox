@extends('layouts.main')
@section('content')
    <section id="login-register">
        <div class="container">
            <div class="login-register-wrapper">
                <div class="section-title">
                    <h2 class="title">Upload Personal Resource</h2>
                </div>
                <div class="login-form-inner">
                    <form action="{{ route('upload.content.store') }}" method="POST" enctype="multipart/form-data" class="login-form">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="title" class="col-form-label text-md-right color-black">{{ __('Resource Title') }}</label>
                                <span style="color: red">{{ $errors->has('title') ? 'Error:'.$errors->first('Resource Title') : '' }}</span>
                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus>
                            </div>
                        </div>
                        <input type="hidden" name="content_type" id="content_type" value="private">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="description" class="col-form-label text-md-right color-black">{{ __('Description') }}</label>
                                <span style="color: red">{{ $errors->has('description') ? 'Error:'.$errors->first('Description') : '' }}</span>
                                <textarea required name="description" id="description" cols="30" rows="1" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="file" id="file">
                            <input type="hidden" name="type" id="type">
                            <div class="col-md-12">
                                <label for="" class="col-form-label text-md-right color-black">{{ __('Upload File') }}</label>
                                <input type="file" required name="file" data-url="{{ route('resources.upload') }}" id="fileupload" class="form-control" style="display: inline;">
                                <ul id="file-upload-list" class="list-unstyled text-center">
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image" class="col-form-label text-md-right color-black">Background Image {Less Than 1MB}(Optional)</label>
                            <input type="file" name="image" id="image" accept="image/*" class="form-control">
                        </div>
                        <div class="form-group row">
                           <div class="col-md-12">
                               <label for="category" style="color: black">Choose Categories</label>
                               <select name="category" required id="category" class="form-control">
                                   <option value="">Choose Category</option>
                                   @foreach(\App\Category::where('is_deleted', false)->get() as $cat)
                                       <option value="{{ $cat->id }}">{{ ucwords($cat->name) }}</option>
                                   @endforeach
                               </select>
                           </div>
                        </div>
                        <input type="submit" class="submit-btn" value="Upload Content">
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop
