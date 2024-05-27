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
 <div class="">
    <div class="contractor-slider">
        @foreach ($resellers as $key => $item)
        <div class="card contractor">
            <div style="padding: 40px 30px 0;">
                <div class="image-header">
                    <img src="{{asset('reseller-images/'.$item->image)}}" alt="" srcset="" class="img-fluid">
                </div>
                <p class="para_download text-white">{{$item->email}}</p>
                <p class="para_mb text-white">{{$item->username}}</p>
                <p style="text-align:center" class=" text-white">{{$item->area}}</p>
                <div class="image-footer">
                    <p>{{$item->city}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- Code Finalize -->