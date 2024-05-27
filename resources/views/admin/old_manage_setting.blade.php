@extends('layouts/backend')
@section('page_title', 'Setting')
@section('setting_select', 'active')
@section('content')


 <!-- MAIN CONTENT-->
 <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">Manage Setting</div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            @if($id>0)
                                            <h3 class="text-center title-2">Update Setting</h3>
                                            @else
                                            <h3 class="text-center title-2">Add Setting</h3>
                                            @endif     
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-3"></div>
                                            <div class="col-lg-6">
                                            <form action="{{ route('setting.manage_setting_process') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                                
                                            <div class="form-group">
                                                    <label for="title" class="control-label mb-1">Title</label>
                                                    <input id="title" value="{{ $title }}" name="title" type="text" class="form-control" >                                            
                                                    @error('title')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="slug" class="control-label mb-1">Slug</label>
                                                    <input id="slug" value="{{ $slug }}" name="slug" type="text" class="form-control" >                                            
                                                    @error('slug')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="value" class="control-label mb-1">Value</label>
                                                    <textarea id="editor" name="value" class="form-control" >{{ $value }}</textarea>         
                                                    @error('value')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="link" class="control-label mb-1">Button Link</label>
                                                    <input id="link" value="{{ $link }}" name="link" type="link" class="form-control" >                                            
                                                    @error('link')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="text" class="control-label mb-1">Key</label>
                                                    <input id="key" value="{{ $key }}" name="key" type="text" class="form-control" >                                            
                                                    @error('key')
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
                                                <a href="{{ url('admin/setting') }}">
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