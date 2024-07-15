@extends('layouts/backend')
@section('page_title', 'Service Page')
@section('servicepage_select', 'active')
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
                                    <div class="card-header">Manage Service Page</div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            @if($id>0)
                                            <h3 class="text-center title-2">Update Service Page</h3>
                                            @else
                                            <h3 class="text-center title-2">Add Service Page</h3>
                                            @endif     
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-3"></div>
                                            <div class="col-lg-6">
                                            <form action="{{ route('servicepage.manage_servicepage_process') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                                <div class="form-group">
                                                    <label for="heading" class="control-label mb-1">Service Page Heading</label>
                                                    <input id="heading" value="{{ $heading }}" name="heading" placeholder="Enter Service Page Heading" type="text" class="form-control" required>                                            
                                                    @error('heading')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="slug" class="control-label mb-1">Service Page Slug</label>
                                                    <input id="slug" value="{{ $slug }}" name="slug" placeholder="Enter Service Page Slug" type="text" class="form-control" required>                                            
                                                    @error('slug')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="description" class="control-label mb-1">Service Page Description</label>
                                                    <textarea maxlength="20" id="description" name="description" placeholder="Enter Service Page Description" class="form-control" required>{{ $description }}</textarea>
                                                    @error('description')
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
                                                <a href="{{ url('admin/servicepage') }}">
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