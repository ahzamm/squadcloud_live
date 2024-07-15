@extends('layouts/backend')
@section('page_title', 'Services Detail')
@section('Services Detail_select', 'active')
@section('content')



 <!-- MAIN CONTENT-->
 <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">Manage Services Detail</div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            @if($id>0)
                                            <h3 class="text-center title-2">Update Services Detail</h3>
                                            @else
                                            <h3 class="text-center title-2">Add Services Detail</h3>
                                            @endif     
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-3"></div>
                                            <div class="col-lg-6">
                                            <form action="{{ route('setting.manage_service_detail_process') }}" method="post" enctype="multipart/form-data">
                                            @csrf


                                                <div class="form-group">
                                                    <label for="title" class="control-label mb-1">Title</label>
                                                    <input id="title" value="{{$title}}" name="title" placeholder="Enter Title" class="form-control" >         
                                                    @error('title')
                                                    <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                
                                            <div class="form-group">
                                                <label for="services" class="control-label mb-1">services</label>
                                                <select name="services_id" id="services_id" class="form-control">
                                                    <option value="" disabled>Select Services</option>
                                                    @foreach($Services as $item)
                                                        <option value="{{ $item->id }}" @if($item->id == $id) selected @endif>{{ $item->heading }}</option>
                                                    @endforeach
                                                </select>
                                                @error('services')
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
                                                    <label for="description" class="control-label mb-1">Description</label>
                                                    <textarea maxlength="100" id="editor" name="description" placeholder="Enter Description" class="form-control" >{{ $description }}</textarea>         
                                                    @error('description')
                                                    <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>


                                                <div class="form-group">
                                                    <label for="text_field" class="control-label mb-1">Text Field</label>
                                                    <textarea id="editor3" value="" name="text_field" placeholder="Enter Text Field" type="text" class="form-control">{{ $text_field }}</textarea>     
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
                                                <a href="{{ url('admin/service_detail') }}">
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