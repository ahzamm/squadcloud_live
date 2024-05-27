<div class="container">
    <div class="vc_row wpb_row vc_row-fluid vc_custom_1501251473476 vc_row-o-equal-height vc_row-flex">
        <div class="wpb_animate_when_almost_visible wpb_fadeInLeft fadeInLeft wpb_column vc_column_container " style="max-width:992px;margin:auto">
            <div class="vc_column-inner">
                <div class="wpb_wrapper about__wrapper">
                    @php
                    $images = explode('","', $about_us->images);
                    $images = array_map(function ($image) {
                    return trim(str_replace(['\'', '"', ',', ';', '<', '>' , '[' , ']' , ' ' ], '' , $image)); }, $images); @endphp <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            @foreach($images as $key => $image)
                            <li data-target="#myCarousel" data-slide-to="{{$key}}" @if($key===0) class="active" @endif></li>
                            @endforeach
                        </ol>
                        <!-- Wrapper for slides -->
                        <div class="custom-outline">
                            <div class="carousel-inner" role="listbox">
                                @foreach($images as $key => $image)
                                <div class="item @if($key === 0) active @endif">
                                    <img src="{{url('about-us/'.$image)}}" alt="No Image Found"  />
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <p style="text-align: justify;">{!!@$about_us->description!!}</p>
                    </div>
                    <script>
                        $(document).ready(function() {
                            $('#myCarousel').carousel({
                            interval: 3000, // milliseconds
                            pause: 'hover', // pause on hover
                            wrap: true // wrap around the carousel
                        });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
</div>