@extends('layouts/backend')
@section('page_title', 'Portfolio')
@section('portfolio_select', 'active')
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
                                    <div class="card-header">Manage Portfolio</div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            @if($id>0)
                                            <h3 class="text-center title-2">Update Portfolio</h3>
                                            @else
                                            <h3 class="text-center title-2">Add Portfolio</h3>
                                            @endif     
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-3"></div>
                                            <div class="col-lg-6">
                                            <form action="{{ route('portfolio.manage_portfolio_process') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            
                                                <div class="form-group">
                                                    <label for="heading" class="control-label mb-1">Heading</label>
                                                    <input id="heading" value="{{ $heading }}" name="heading" placeholder="Enter Heading" type="text" class="form-control" >     
                                                    @error('heading')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="description" class="control-label mb-1">Portfolio Description</label>
                                                    <textarea maxlength="100" id="editor" name="description" placeholder="Enter Portfolio Description" class="form-control">{{ $description }}</textarea>
                                                    @error('description')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>
                                              
                                                
                                                <div class="form-group">
                                                    <label for="slug" class="control-label mb-1">Portfolio Slug</label>
                                                    <input id="slug" value="{{ $slug }}" name="slug" placeholder="Enter Portfolio Slug" type="text" class="form-control">                                            
                                                    @error('slug')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="keyword" class="control-label mb-1">Portfolio Keyword</label>
                                                    <input id="keyword" value="{{ $keyword }}" name="keyword" placeholder="Enter Portfolio Keyword" type="text" class="form-control" >                                            
                                                    @error('keyword')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>
                                               
                                                <div class="form-group">
                                                    <label for="link" class="control-label mb-1">Portfolio Link</label>
                                                    <input type="url" id="link" name="link" placeholder="Enter Portfolio Link" value="{{ $link }}" class="form-control" />
                                                    @error('link')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>
                                               
                                                <div class="form-group">
                                                    <label for="image" class="control-label mb-1"> Portfolio Image</label>
                                                    <input id="image" name="image" type="file" class="form-control" {{ $image_required }}>
                                                    <small>dimensions:max_width=285,max_height=175"</small>
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
                                                    <a href="{{ url('admin/portfolio') }}">
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