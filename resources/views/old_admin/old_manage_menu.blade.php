@extends('layouts/backend')
@section('page_title', 'Menu')
@section('menu_select', 'active')
@section('content')

 <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">Manage menu</div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            @if($id>0)
                                            <h3 class="text-center title-2">Update menu</h3>
                                            @else
                                            <h3 class="text-center title-2">Add menu</h3>
                                            @endif     
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-3"></div>
                                            <div class="col-lg-6">
                                            <form action="{{ route('menu.manage_menu_process') }}" method="post">
                                            @csrf
                                                <div class="form-group">
                                                    <label for="menu_name" class="control-label mb-1">Menu Name</label>
                                                    <input id="menu_name" value="{{ $menu_name }}" name="menu_name" placeholder="Enter Menu Name" type="text" class="form-control" required>                                            
                                                </div>
                                                    @error('menu_name')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                <div>
                                                <div class="form-group">
                                                    <label for="menu_slug" class="control-label mb-1">Menu Slug</label>
                                                    <input id="menu_slug" value="{{ $menu_slug }}" name="menu_slug" placeholder="Enter Menu Slug" type="text" class="form-control" required>                                            
                                                </div>
                                                    @error('menu_slug')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                <div>
                                                <div class="form-group">
                                                    <label for="link" class="control-label mb-1">Menu Link</label>
                                                    <input id="link" value="{{ $link }}" name="link" placeholder="Enter Menu Link" type="text" class="form-control" required>                                            
                                                </div>
                                                    @error('link')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                    @enderror
                                                <div>

                                                <div class="form-group">
                                                    <input id="id" value="{{ $id }}" name="id" type="hidden">                                            
                                                </div>
                                                <div>
                                                @if($id>0)
                                                    <button type="submit" class="btn btn-outline-success">Update</button>
                                                @else
                                                    <button type="submit" class="btn btn-outline-success">Add</button>
                                                @endif
                                                <a href="{{ url('admin/menu') }}">
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