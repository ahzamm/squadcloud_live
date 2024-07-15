@extends('layouts/backend')
@section('page_title', 'Services')
@section('services_select', 'active')
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
                                    <div class="card-header">Manage Service</div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            @if($id>0)
                                            <h3 class="text-center title-2">Update Service</h3>
                                            @else
                                            <h3 class="text-center title-2">Add Service</h3>
                                            @endif     
                                        </div>
                                        <hr>
                                       
                                        <div class="row">
                                            <div class="col-lg-3"></div>
                                            <div class="col-lg-6">
                                            <form action="{{ route('services.manage_services_process') }}" id="updateServiceForm" method="post" enctype="multipart/form-data">
                                            @csrf
                                                <div class="form-group">
                                                    <label for="heading" class="control-label mb-1">Service Heading</label>
                                                    <input id="heading" value="{{ $heading }}" name="heading" placeholder="Enter Service Heading" type="text" class="form-control">                                            
                                                    @error('heading')
                                                    <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="slug" class="control-label mb-1">Service Slug</label>
                                                    <input id="slug" value="{{ $slug }}" name="slug" placeholder="Enter Service Slug" type="text" class="form-control">                                            
                                                    @error('slug')
                                                    <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="description" class="control-label mb-1">Service Description</label>
                                                    <textarea id="spaceId" maxlength="100" name="description" placeholder="Enter Service Description" class="form-control">{{ $description }}</textarea>
                                                    <p>max:100 character</p>
                                                    @error('description')
                                                    <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="icon" class="control-label mb-1">Service Icon</label>
                                                    <input id="icon" name="icon" type="file" class="form-control">
                                                    <small>dimensions:min_width=110,min_height=120,max_width=230,max_height=230</small>                                            
                                                    @error('icon')
                                                    <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="keyword" class="control-label mb-1">Service Keyword</label>
                                                    <input id="keyword" value="{{ $keyword }}" name="keyword" placeholder="Enter Service Keyword" type="text" class="form-control tagsinput" data-a-sign="$" data-role="tagsinput">                                            
                                                    @error('keyword')
                                                    <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>
      
                                                <div class="form-group">
                                                    <label for="text_field" class="control-label mb-1">text_field</label>
                                                    <textarea id="editor2" name="text_field" placeholder="Enter text_field" class="form-control">{{ $text_field }}</textarea>
                                                    @error('text_field')
                                                    <p class="text-danger">{{$message}}</p>
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
                                                <a href="{{ url('admin/services') }}">
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

