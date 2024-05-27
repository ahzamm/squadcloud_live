@extends('layouts/backend')
@section('page_title', 'Blog')
@section('blog_select', 'active')
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
                                    <div class="card-header">Manage Blog</div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            @if($id>0)
                                            <h3 class="text-center title-2">Update Blog</h3>
                                            @else
                                            <h3 class="text-center title-2">Add Blog</h3>
                                            @endif     
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-3"></div>
                                            <div class="col-lg-6">
                                            <form action="{{ route('blog.manage_blog_process') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                               
                                                     <div class="form-group">
                                                    <label for="title" class="control-label mb-1">Blog Title</label>
                                                    <input id="title" value="{{ $title }}" name="title" placeholder="Enter Blog Title" type="text" class="form-control" >                                            
                                                    @error('title')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="description" class="control-label mb-1">Blog Description</label>
                                                    <textarea id="editor" name="description" placeholder="Enter Blog Description" class="form-control">{{ $description }}</textarea>
                                                    @error('description')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>
                                              
                                                <div class="form-group">
                                                    <label for="writer" class="control-label mb-1">Blog Writer</label>
                                                    <input id="writer" value="{{ $writer }}" name="writer" placeholder="Enter Blog Writer" type="text" class="form-control" > 
                                                    @error('writer')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>
                                               
                                                <div class="form-group">
                                                    <label for="keyword" class="control-label mb-1">Blog Keyword</label>
                                                    <input id="keyword" value="{{ $keyword }}" name="keyword" placeholder="Enter Blog Keyword" type="text" class="form-control" >
                                                    @error('keyword')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="image" class="control-label mb-1">Blog Image</label>
                                                    <input id="image" name="image" type="file" class="form-control" {{ $image_required }}>
                                                    @error('image')
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
                                                <a href="{{ url('admin/blog') }}">
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