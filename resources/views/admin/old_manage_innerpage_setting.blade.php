@extends('layouts/backend')
@section('page_title', 'Client')
@section('client_select', 'active')
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
                                    <div class="card-header">Manage Innerpage Setting</div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            @if($id>0)
                                            <h3 class="text-center title-2">Update InnerPage Setting</h3>
                                            @else
                                            <h3 class="text-center title-2">Add InnerPage Setting</h3>
                                            @endif     
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-3"></div>
                                            <div class="col-lg-6">
                                            <form action="{{ route('setting.manage_innerpage_setting_process') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                           
                                                <div class="form-group">
                                                    <label for="title" class="control-label mb-1">Title</label>
                                                    <input id="title" value="{{ $title }}" name="title" type="text" placeholder="Enter Title" class="form-control" >     
                                                    @error('title')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>
                                             
                                                <div class="form-group">
                                                    <label for="slug" class="control-label mb-1">Slug</label>
                                                    <input id="slug" value="{{ $slug }}" name="slug" type="text" placeholder="Enter Slug" class="form-control">                                            
                                                    @error('slug')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                <label for="title_image" class="control-label mb-1">Title Image</label>
                                                <input id="title_image" name="title_image" type="file" class="form-control" {{ $image_required }}>
                                                <small>dimensions:min_width=1000,min_height=200</small>
                                                @error('title_image')
                                                <p class="text-danger text-center">{{$message}}</p>
                                                @enderror
                                             </div>

                                                <div class="form-group">
                                                    <label for="description" class="control-label mb-1">Description</label>
                                                    <textarea maxlength="180" id="editor" name="description" placeholder="Enter Description" class="form-control" >{{ $description }}</textarea>         
                                                    @error('description')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="setting_key" class="control-label mb-1">key</label>
                                                    <input id="setting_key" value="{{ $setting_key }}" name="setting_key" type="text" placeholder="Enter key" class="form-control">                                            
                                                    @error('setting_key')
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
                                                <a href="{{ url('admin/innerpage_setting') }}">
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