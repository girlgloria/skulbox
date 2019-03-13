@extends('layouts.main')
@section('content')
    <section id="login-register">
        <div class="container">
            <div class="login-register-wrapper">
                <div class="section-title">
                    <h2 class="title">Order Content</h2>
                </div>
                <div class="login-form-inner">
                    <form action="{{ route('order.request') }}" method="POST" class="login-form">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="title" class="col-form-label text-md-right color-black">{{ __('Project Title') }}</label>
                                <span style="color: red">{{ $errors->has('title') ? 'Error:'.$errors->first('Project Title') : '' }}</span>
                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="description" class="col-form-label text-md-right color-black">{{ __('Instructions') }}</label>
                                <span style="color: red">{{ $errors->has('description') ? 'Error:'.$errors->first('Instructions') : '' }}</span>
                                <textarea required name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="file" id="file">
                            <div class="col-md-12">
                                <label for="" class="col-form-label text-md-right color-black">{{ __('Project Document/File (Optional)') }}</label>
                                <input type="file" name="file" data-url="{{ route('resources.upload') }}" id="fileupload" class="form-control" style="display: inline;">
                                <ul id="file-upload-list" class="list-unstyled text-center">
                                </ul>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="type" class="col-form-label text-md-right color-black">{{ __('Choose Project Type') }}</label>
                                <select name="type" required id="type" class="form-control">
                                    <option value="">Choose Project Type</option>
                                    <option value="assignment">Assignment/Homework</option>
                                    <option value="article">Article</option>
                                    <option value="code">Programming/Code</option>
                                    <option value="book">Book</option>
                                </select>
                            </div>
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
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="start_date" class="col-form-label text-md-right color-black">{{ __('Start Date') }}</label>
                                <input type="text" required name="start_date" id="start_date" class="form-control datepicker" placeholder="Start Date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="due_date" class="col-form-label text-md-right color-black">{{ __('Due Date)') }}</label>
                                <input type="text" required name="due_date" id="due_date" class="form-control datepicker" placeholder="Due Date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="cost" class="col-form-label text-md-right color-black"><b>{{ __('Amount you are willing to pay. {Min Amount: KES 150}') }}</b></label>
                                <input type="number" required min="150" name="cost" id="cost" class="form-control" placeholder="Min Amount 150">
                            </div>
                        </div>
                        <input type="submit" class="submit-btn" value="Confirm Order">
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop
