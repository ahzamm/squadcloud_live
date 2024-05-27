@extends('layouts/backend')
@section('page_title', 'Header')
@section('header_select', 'active')
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
                                    <div class="card-header">Manage Header</div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            @if($id>0)
                                            <h3 class="text-center title-2">Update Header</h3>
                                            @else
                                            <h3 class="text-center title-2">Add Header</h3>
                                            @endif     
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-3"></div>
                                            <div class="col-lg-6">
                                            <form action="{{ route('setting.manage_header_process') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            
                                            <div class="form-group">
                                                <label for="title" class="control-label mb-1">Title</label>
                                                <input id="title"  maxlength="10"  value="{{ $title }}" name="title" placeholder="Enter Title" type="text" class="form-control">     
                                                @error('title')
                                                <p class="text-danger text-center">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="slug" class="control-label mb-1">Slug</label>
                                                <input id="slug" value="{{ $slug }}" name="slug" placeholder="Enter Slug" type="text" class="form-control" >     
                                                @error('slug')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="sub_title" class="control-label mb-1">Sub Title</label>
                                                <input id="sub_title" value="{{ $sub_title }}" name="sub_title" placeholder="Enter Sub Title" type="text" class="form-control" >     
                                                @error('sub_title')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="description" class="control-label mb-1">Description</label>
                                                <textarea id="description" name="description" placeholder="Enter Description" class="form-control" >{{ $description }}</textarea>                                           
                                                @error('description')
                                                <p class="text-danger text-center">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="image" class="control-label mb-1">Header Image 1</label>
                                                <input id="img_1" name="img_1" type="file" class="form-control" {{ $image_required }}>
                                                <small>dimensions:min_width=550,min_height=420</small>
                                                @error('img_1')
                                                <p class="text-danger text-center">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="image" class="control-label mb-1">Header Image 2</label>
                                                <input id="img_2" name="img_2" type="file" class="form-control" {{ $image_required }}>
                                                <small>dimensions:min_width=400,min_height=300</small>
                                                @error('img_2')
                                                <p class="text-danger text-center">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="image" class="control-label mb-1">Header Image 3</label>
                                                <input id="img_3" name="img_3" type="file" class="form-control" {{ $image_required }}>
                                                <small>dimensions:min_width=400,min_height=300</small>
                                                @error('img_3')
                                                <p class="text-danger text-center">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="image" class="control-label mb-1">Header Image 4</label>
                                                <input id="img_4" name="img_4" type="file" class="form-control" {{ $image_required }}>
                                                <small>dimensions:min_width=400,min_height=300</small>
                                                @error('img_4')
                                                <p class="text-danger text-center">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="display_order" class="control-label mb-1">Display Order</label>
                                                <input id="display_order" value="{{ $display_order }}" name="display_order" placeholder="Enter Display Order" type="number" class="form-control" >                                            
                                                @error('display_order')
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
                                                <a href="{{ url('admin/header') }}">
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