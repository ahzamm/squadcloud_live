<div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid vc_custom_1488988810300" >
    <div class="wpb_column vc_column_container vc_col-sm-6 vc_col-lg-3 vc_col-md-3">
        <div class="vc_column-inner">
            <div class="wpb_wrapper">
                <div class="mgt-promo-block-container wpb_content_element">
                    <div class="mgt-promo-block-wrapper mgt-promo-block-shadow mgt-promo-block-hover" >
                        <div
                            class="mgt-promo-block-top-image"
                            data-style="background-image: url(site/upload/karachi.jpg);height: 180px;background-size: cover;"
                        ></div>
                        <div class="mgt-promo-block black-text no-darken mgt-promo-block-1307105" data-style="background-color: #ffffff;height: auto;">
                            <div class="mgt-promo-block-content va-top">
                                <div class="mgt-promo-block-content-inside custom-packages">
                                    <h3 style="text-align: center">Sindh</h3>
                                </div>
                                <ul class="list-group packages-list" style="margin-bottom:0 ">
                                    @for ($i = 0; $i < $max_count; $i++)
                                        @if (isset($sindh[$i]))
                                        <li class="list-group-item">{{ucwords($sindh[$i]->name)}} <span class="package-count"><span>{{$sindh[$i]->limit}}</span>/Mbps</span></li>    
                                        @else
                                        <li class="list-group-item">-</li> 
                                        @endif
                                    @endfor
                                    <li class="list-group-item text-center" style="background: #2aaae2;border-color: #2aaae2;">
                                        <button class="btn img-rounded cityClick" data-value="sindh" style="border-radius: 25px;background: #2aaae2;">Apply Now</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wpb_column vc_column_container vc_col-sm-6 vc_col-lg-3 vc_col-md-3">
        <div class="vc_column-inner">
            <div class="wpb_wrapper">
                <div class="mgt-promo-block-container wpb_content_element">
                    <div class="mgt-promo-block-wrapper mgt-promo-block-shadow mgt-promo-block-hover">
                        <div
                            class="mgt-promo-block-top-image"
                            data-style="background-image: url(site/upload/lahore.jpg);height: 180px;background-size: cover;"
                        ></div>
                        <div class="mgt-promo-block black-text no-darken mgt-promo-block-47466006" data-style="background-color: #ffffff;height: auto;">
                            <div class="mgt-promo-block-content va-top">
                                <div class="mgt-promo-block-content-inside custom-packages">
                                    <h3 style="text-align: center">Punjab</h3>
                                </div>
                                <ul class="list-group packages-list" style="margin-bottom:0 ">
                                    @for ($i = 0; $i < $max_count; $i++)
                                        @if (isset($punjab[$i]))
                                        <li class="list-group-item">{{ucwords($punjab[$i]->name)}} <span class="package-count"><span>{{$punjab[$i]->limit}}</span>/Mbps</span></li>    
                                        @else
                                        <li class="list-group-item">-</li> 
                                        @endif
                                    @endfor
                                    <li class="list-group-item text-center" style="background: #2aaae2;border-color: #2aaae2;">
                                        <button class="btn img-rounded cityClick" data-value="punjab" style="border-radius: 25px;background: #2aaae2;">Apply Now</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wpb_column vc_column_container vc_col-sm-6 vc_col-lg-3 vc_col-md-3">
        <div class="vc_column-inner">
            <div class="wpb_wrapper">
                <div class="mgt-promo-block-container wpb_content_element">
                    <div class="mgt-promo-block-wrapper mgt-promo-block-shadow mgt-promo-block-hover">
                        <div
                            class="mgt-promo-block-top-image"
                            data-style="background-image: url(site/upload/balochistan.jpg);height: 180px;background-size: cover;"
                        ></div>
                        <div class="mgt-promo-block black-text no-darken mgt-promo-block-21080636" data-style="background-color: #ffffff;height: auto;">
                            <div class="mgt-promo-block-content va-top">
                                <div class="mgt-promo-block-content-inside custom-packages">
                                    <h3 style="text-align: center">Balochistan</h3>
                                </div>
                                <ul class="list-group packages-list" style="margin-bottom:0 ">
                                    @for ($i = 0; $i < $max_count; $i++)
                                        @if (isset($balochistan[$i]))
                                        <li class="list-group-item">{{ucwords($balochistan[$i]->name)}} <span class="package-count"><span>{{$balochistan[$i]->limit}}</span>/Mbps</span></li>    
                                        @else
                                        <li class="list-group-item">-</li> 
                                        @endif
                                    @endfor
                                    <li class="list-group-item text-center" style="background: #2aaae2;border-color: #2aaae2;">
                                        <button class="btn img-rounded cityClick" data-value="balochistan" style="border-radius: 25px;background: #2aaae2;">Apply Now</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wpb_column vc_column_container vc_col-sm-6 vc_col-lg-3 vc_col-md-3">
        <div class="vc_column-inner">
            <div class="wpb_wrapper">
                <div class="mgt-promo-block-container wpb_content_element">
                    <div class="mgt-promo-block-wrapper mgt-promo-block-shadow mgt-promo-block-hover">
                        <div
                            class="mgt-promo-block-top-image"
                            data-style="background-image: url(site/upload/kpk.jpg);height: 180px;background-size: cover;"
                        ></div>
                        <div class="mgt-promo-block black-text no-darken mgt-promo-block-37729541" data-style="background-color: #ffffff;height: auto;">
                            <div class="mgt-promo-block-content va-top">
                                <div class="mgt-promo-block-content-inside custom-packages">
                                    <h3 style="text-align: center">KPK</h3>
                                </div>
                                <ul class="list-group packages-list" style="margin-bottom:0 ">
                                    @for ($i = 0; $i < $max_count; $i++)
                                        @if (isset($kpk[$i]))
                                        <li class="list-group-item">{{ucwords($kpk[$i]->name)}} <span class="package-count"><span>{{$kpk[$i]->limit}}</span>/Mbps</span></li>    
                                        @else
                                        <li class="list-group-item">-</li> 
                                        @endif
                                    @endfor
                                    <li class="list-group-item text-center" style="background: #2aaae2;border-color: #2aaae2;">
                                        <button class="btn btn-primary img-rounded cityClick" data-value="kpk" style="border-radius: 25px;background: #2aaae2;">Apply Now</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>