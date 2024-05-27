@extends('layouts/backend')
@section('page_title', 'About')
@section('about_select', 'active')
@section('content')

@if($id>0){
    {{ $image_required="" }}
}
@else
{
    {{ $image_required="required" }}
}
@endif

 <!-- MAIN CONTENT-->
 <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">Manage About</div>
                                    <div class="card-body">
                                        <div class="card-main_heading">
                                            @if($id>0)
                                            <h3 class="text-center main_heading-2">Update About</h3>
                                            @else
                                            <h3 class="text-center main_heading-2">Add About</h3>
                                            @endif     
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-3"></div>
                                            <div class="col-lg-6">
                                            <form action="{{ route('about.manage_about_process') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                                <div class="form-group">
                                                    <label for="icon_1" class="control-label mb-1">Icon 1</label>
                                                    <input id="icon_1" value="{{ $icon_1 }}" name="icon_1" type="file" class="form-control" >                                            
                                                    @error('icon_1')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="title_1" class="control-label mb-1">Title 1</label>
                                                    <input id="title_1" value="{{ $title_1 }}" placeholder="Enter Title 1" name="title_1" type="text" class="form-control" >                                            
                                                    @error('title_1')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="description_1" class="control-label mb-1">Description 1</label>
                                                    <textarea maxlength="80" id="editor" name="description_1" placeholder="Enter Description 1" class="form-control">{{ $description_1 }}</textarea>                                            
                                                    @error('description_1')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="icon_2" class="control-label mb-1">Icon 2</label>
                                                    <input id="icon_2" value="{{ $icon_2 }}" name="icon_2" type="file" class="form-control">
                                                    @error('icon_2')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="title_2" class="control-label mb-1">Title 2</label>
                                                    <input id="title_2" value="{{ $title_2 }}" placeholder="Enter Title 2" name="title_2" type="text" class="form-control" >                                            
                                                    @error('title_2')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="description_2" class="control-label mb-1">Description 2</label>
                                                    <textarea maxlength="120" id="editor2" name="description_2" placeholder="Enter Description 2" class="form-control">{{ $description_2 }}</textarea>                                            
                                                    @error('description_2')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="icon_3" class="control-label mb-1">Icon 3</label>
                                                    <input id="icon_3" value="{{ $icon_3 }}" name="icon_3" type="file" class="form-control">
                                                    @error('icon_3')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="title_3" class="control-label mb-1">Title 3</label>
                                                    <input id="title_3" value="{{ $title_3 }}" placeholder="Enter Title 3" name="title_3" type="text" class="form-control" >                                            
                                                    @error('title_3')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="description_3" class="control-label mb-1">Description</label>
                                                    <textarea maxlength="120" id="editor3" name="description_3" placeholder="Enter Description" class="form-control">{{ $description_3 }}</textarea>                                             
                                                    @error('description_3')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="slug" class="control-label mb-1">Slug</label>
                                                    <input id="slug" value="{{ $slug }}" placeholder="Enter Slug" name="slug" type="text" class="form-control">
                                                    @error('slug')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="video_url" class="control-label mb-1">Video</label>
                                                    <input id="video_url" value="{{ $video_url }}" placeholder="Enter Video" name="video_url" type="url" class="form-control" >                                            
                                                    @error('video_url')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="main_description" class="control-label mb-1">Main Description</label>
                                                    <textarea maxlength="180" id="editor4" name="main_description" placeholder="Enter Main Description" class="form-control">{{ $main_description }}</textarea>                                           
                                                    @error('main_description')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>
                                               
                                                <div class="form-group">
                                                    <input id="id" value="{{ $id }}" name="id" type="hidden">                                            
                                                </div>
                                                <div>
                                                @if($id>0)
                                                    <button type="submit" class="btn btn-outline-success">Update</button>
                                                @else
                                                    <button type="submit" class="btn btn-outline-success">Add</button>
                                                @endif
                                                <a href="{{ url('admin/about') }}">
                                                    <button type="button" class="btn btn-outline-secondary">Back</button>
                                                </a>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-lg-3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection()