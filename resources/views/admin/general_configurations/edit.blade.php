@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-info">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0"><span><i class="fa-solid fa-box-open"></i></span> Update Contact</h3>
                            <div class="ml-auto">
                                {{-- <a class="btn btn-success btn-sm float-right" href="{{route('contacts.message_request')}}">  Message Requests  </a> --}}
                            </div>
                        </div>
                        <form action="{{ route('general-configurations.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            <!-- /.card-header -->
                            <div class="card-body pad">
                                @csrf
                                <div class="row">



                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Brand Logo <span style="color: red">*</span></label>
                                            @isset($general_configuration->brand_logo)
                                                <img src="{{ asset('frontend_assets/images/' . $general_configuration->brand_logo) }}"
                                                    height="60" width="120" alt="" srcset="">
                                            @endisset
                                            <br><br>
                                            <input type="file" value="{{ $general_configuration->brand_logo }}" name="brand_logo">
                                            @error('brand_logo')
                                                <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Brand Name <span style="color: red">*</span></label>
                                        @isset($general_configuration->brand_name)
                                            <input type="text" class="form-control" name="brand_name"
                                                value="{{ old('brand_name') == null ? $general_configuration->brand_name : old('brand_name') }}">
                                        @endisset
                                        @error('brand_name')
                                            <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Site Footer <span style="color: red">*</span></label>
                                        @isset($general_configuration->site_footer)
                                            <input type="text" class="form-control" name="site_footer"
                                                value="{{ old('site_footer') == null ? $general_configuration->site_footer : old('site_footer') }}">
                                        @endisset

                                        @error('site_footer')
                                            <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-primary float-right">Update</button>
                    </div>
                    </form>
                </div>
            </div>
            <!-- /.col-->
    </div>
    <!-- ./row -->
    </section>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#pageContent').summernote({
                height: 300
            });
        });
    </script>
@endpush
