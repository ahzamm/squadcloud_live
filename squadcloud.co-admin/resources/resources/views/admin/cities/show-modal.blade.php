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
 <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Page Details</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
    @if ($frontPage->banner_image)
    <p class="text-center">Banner Image</p>
    <img src="{{asset('pagesbanner/'.$frontPage->banner_image)}}" alt="" srcset="" class="img-fluid" height="200">
    @endif
    <dl class="mt-2">
        <dt>Page Heading</dt>
        <dd>{{$frontPage->name}}</dd>
        <dt>Meta Tag</dt>
        <dd>{{$frontPage->meta_tag}}</dd>
        <dt>Meta Description</dt>
        <dd>{{$frontPage->meta_description}}</dd>
        <dt>Page Title</dt>
        <dd>{{$frontPage->page_title}}</dd>
        <dt>Slogan</dt>
        <dd>{{$frontPage->slogan}}</dd>
    </dl>
    <h3 class="text-center ">Page Content</h3>
    <div>
        {!! $frontPage->content !!}
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
</div>
<!-- Code Finalize -->