<!--
 * This file is part of the SQUADCLOUD project.
 *
 * (c) SQUADCLOUD TEAM
 *
 * This file contains the configuration settings for the application.
 * It includes database connection details, API keys, and other sensitive information.
 *
 * IMPORTANT: DO NOT MODIFY THIS FILE UNLESS YOU ARE AN AUTHORIZED DEVELOPER.
 * Changes made to this file may cause unexpected behavior in the application.
 *
 * WARNING: DO NOT SHARE THIS FILE WITH ANYONE OR UPLOAD IT TO A PUBLIC REPOSITORY.
 *
 * Website: https://squadcloud.co
 * Created: January, 2024
 * Last Updated: 15th May, 2024
 * Author: Talha Fahim <info@squadcloud.co>
 *-->
 <!-- Code Onset -->
 <div class="container">
    <div data-vc-full-width="true" data-vc-full-width-init="false" data-vc-stretch-content="true" class="vc_row wpb_row vc_row-fluid vc_row-no-padding">
        <div class="wpb_column vc_column_container vc_col-sm-12">
            <div class="vc_column-inner">
                <div class="wpb_wrapper">
                    <div class="mgt-promo-block-container wpb_content_element">
                        <div class="mgt-promo-block-wrapper">
                            <div
                            data-vc-parallax="1.5"
                            data-vc-parallax-image="{{url('message/'.$message_data->image)}}"
                            class="vc_general vc_parallax vc_parallax-fixed js-vc_parallax-o-fixed mgt-promo-block white-text cover-image darken mgt-promo-block-18379234"
                            data-style="background-color: #f5f5f5;height: 600px;"
                            >
                            <div class="mgt-promo-block-content va-middle">
                                <div class="mgt-promo-block-content-inside">
                                    <h1 style="text-align: center;">
                                        <strong><p>{{$message_data->message}}</p></strong>
                                    </h1>
                                    <div
                                    class="mgt-button-wrapper mgt-button-wrapper-align-center mgt-button-wrapper-display-newline mgt-button-top-margin-true mgt-button-right-margin-false mgt-button-round-edges-full"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Code Finalize -->