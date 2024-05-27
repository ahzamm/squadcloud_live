@extends('layouts/backend')
@section('page_title', 'Inner Services')
@section('innerservice_select', 'active')
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
                                    <div class="card-header">Manage Inner Service</div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            @if($id>0)
                                            <h3 class="text-center title-2">Update Inner Service</h3>
                                            @else
                                            <h3 class="text-center title-2">Add Inner Service</h3>
                                            @endif     
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-3"></div>
                                            <div class="col-lg-6">
                                            <form action="{{ route('innerservice.manage_innerservice_process') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="service_page" class="control-label mb-1">Service Page</label>
                                                <select name="service_page" id="service_page" class="form-control" required>
                                                    <option value="" disabled>Select Service Page</option>
                                                    @foreach($service_page as $item)
                                                        <option value="{{ $item->id }}" @if($item->id == $id) selected @endif>{{ $item->heading }}</option>
                                                    @endforeach
                                                </select>
                                                @error('service_page')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                @enderror
                                            </div>
                                            
                                                <div class="form-group">
                                                    <label for="heading" class="control-label mb-1">Inner Service Heading</label>
                                                    <input id="heading" value="{{ $heading }}" name="heading" placeholder="Enter Inner Service Heading" type="text" class="form-control" required>                                            
                                                    @error('heading')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="slug" class="control-label mb-1">Inner Service Slug</label>
                                                    <input id="slug" value="{{ $slug }}" name="slug" type="text" placeholder="Enter Inner Service Slug" class="form-control" required>                                            
                                                    @error('slug')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="description" class="control-label mb-1">Inner Service Description</label>
                                                    <textarea maxlength="180" name="description" placeholder="Enter Inner Service Description" id="editor" class="form-control" required>{{ $description }}</textarea>
                                                    @error('description')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="icon" class="control-label mb-1">Inner Service Icon</label>
                                                    <input id="icon" name="icon" type="file" class="form-control" {{ $image_required }}>                                            
                                                    @error('icon')
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
                                                <a href="{{ url('admin/innerservice') }}">
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