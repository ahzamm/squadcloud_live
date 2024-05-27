<div class="container">
    @foreach ($whyUs as $key => $item)
    <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-md-6 vc_col-lg-4 mb-10px">
        <div class="vc_column-inner">
            <div class="wpb_wrapper">
                <div class="mgt-promo-block-container wpb_content_element wpb_animate_when_almost_visible wpb_fadeInRight fadeInRight">
                    <!-- <div class="mgt-promo-block-wrapper mgt-promo-block-shadow mgt-promo-block-hover" style="border: 4px solid #22a638; border-radius: 20px;">
                        <div class="mgt-promo-block white-text cover-image darken mgt-promo-block-12111848" data-style="background-color: #ffffff;background-image: url({{url('whychoose-us/'.$item->image)}}); background-repeat: no-repeat;height: 300px;">
                            <div class="mgt-promo-block-content va-middle">
                                <div    
                                class="mgt-promo-block-content-inside vc_custom_1501258614002">
                                    <h2 style="text-align: center;"><strong>{{$item->title}}</strong></h2>
                                    <p style="text-align: center;">
                                        <span style="color: #e1e1e1;">
                                        {{$item->description}}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div id="box_one">
                        <div class="dropped one" style="--color: #22a638; background-image:url('{{url('whychoose-us/'.$item->image)}}');background-repeat: no-repeat;background-position:center;background-size:cover">
                            <div class="drop-overlay one"></div>
                            <div class="content">
                                <!-- <h2>{{++$key}}</h2> -->
                                <h2>{!!$item->title!!}</h2>
                                <!-- <p class="para-text one">{{$item->title}}</p> -->
                                <a href="javascript:void(0)" class="readMore" onclick="showServiceModal('{{$item->title}}', '{{$item->description}}')">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="modal" id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="serviceModalTitle" style="margin-top:0"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute;right: 0;top: 0;padding: 10px;font-size: 40px;font-weight: 100;opacity: 1">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
    <p id="modalDescription"></p>
</div>
</div>
</div>
</div>