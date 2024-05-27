@extends('layouts/backend')
@section('page_title', 'Product')
@section('product_select', 'active')
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
                                    <div class="card-header">Manage Product</div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            @if($id>0)
                                            <h3 class="text-center title-2">Update Product</h3>
                                            @else
                                            <h3 class="text-center title-2">Add Product</h3>
                                            @endif     
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-3"></div>
                                            <div class="col-lg-6">
                                            <form action="{{ route('product.manage_product_process') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="title" class="control-label mb-1">Title 1</label>
                                                <input id="product_name" maxlength="13" value="{{ $product_name }}" name="product_name" placeholder="Enter Title 1" type="text" class="form-control" >     
                                                @error('product_name')
                                                <p class="text-danger text-center">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="title" class="control-label mb-1">Title 2</label>
                                                <input id="product_name_2" maxlength="13" value="{{ $product_name_2 }}" name="product_name_2" placeholder="Enter Title 2" type="text" class="form-control" >     
                                                @error('product_name_2')
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
                                                <label for="description" class="control-label mb-1">Short Description</label>
                                                <textarea maxlength="50" id="editor2" name="short_description" placeholder="Enter Short Description" class="form-control" >{{ $short_description }}</textarea>                                           
                                                @error('short_description')
                                                <p class="text-danger text-center">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="description" class="control-label mb-1">Long Description</label>
                                                <textarea maxlength="100" id="editor3" name="long_description" placeholder="Enter Long Description" class="form-control" >{{ $long_description }}</textarea>                                           
                                                @error('long_description')
                                                <p class="text-danger text-center">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="image" class="control-label mb-1">Product Image 1</label>
                                                <input id="img_1" name="img_1" type="file" class="form-control" {{ $image_required }}>
                                                @error('img_1')
                                                <p class="text-danger text-center">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="image" class="control-label mb-1">Product Screenshot 1</label>
                                                <input id="img_2" name="img_2" type="file" class="form-control" {{ $image_required }}>
                                                @error('img_2')
                                                <p class="text-danger text-center">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="image" class="control-label mb-1">Product Screenshot 2</label>
                                                <input id="img_3" name="img_3" type="file" class="form-control" {{ $image_required }}>
                                                @error('img_3')
                                                <p class="text-danger text-center">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="image" class="control-label mb-1">Product Screenshot 3</label>
                                                <input id="img_4" name="img_4" type="file" class="form-control" {{ $image_required }}>
                                                @error('img_4')
                                                <p class="text-danger text-center">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="image" class="control-label mb-1">Product Image 2</label>
                                                <input id="img_5" name="img_5" type="file" class="form-control" {{ $image_required }}>
                                                @error('img_5')
                                                <p class="text-danger text-center">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="product_class_id" class="control-label mb-1">Product Class</label>
                                                <select name="product_class_id" id="product_class_id" class="form-control">
                                                    <option value="" disabled>Select Product Class</option>
                                                    @foreach($productclass as $item)
                                                        <option value="{{ $item->id }}" @if($item->id == $id) selected @endif>{{ $item->title }}</option>
                                                    @endforeach
                                                </select>
                                                @error('product_class_id')
                                                    <p class="text-danger text-center">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="price" class="control-label mb-1">Price</label>
                                                <input id="price" value="{{ $price }}" name="price" placeholder="Enter Price" type="text" class="form-control" >                                            
                                                @error('price')
                                                <p class="text-danger text-center">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="description" class="control-label mb-1">Price Description</label>
                                                <textarea maxlength="40" id="price_description" name="price_description" placeholder="Enter Price Description" class="form-control" >{{ $price_description }}</textarea>                                           
                                                @error('price_description')
                                                <p class="text-danger text-center">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="features" class="control-label mb-1">Features</label>
                                                <textarea id="editor" name="features" placeholder="Enter Features" class="form-control">{{ $features }}</textarea>
                                                @error('features')
                                                <p class="text-danger text-center">{{$message}}</p>
                                                @enderror
                                            </div>



                                            <div class="form-group">
                                                <label for="link" class="control-label mb-1">Product Link</label>
                                                <input type="url" id="link" name="link" placeholder="Enter Product Link" value="{{ $link }}" class="form-control" />
                                                @error('link')
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
                                                <a href="{{ url('admin/product') }}">
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