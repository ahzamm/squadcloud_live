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
  <h5 class="modal-title" id="exampleModalLabel">FrontPage Slider</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <p class="text-center">Slide Image</p>
  <img src="{{asset('homeslider/'.$homeslider->image)}}" alt="" srcset="" class="img-fluid" height="200">
  <dl class="mt-2">
    <dt>Slide Title :</dt>
    <dd>{{$homeslider->title}}</dd>
    <dt>Slide Slogan :</dt>
    <dd>{{$homeslider->slogan}}</dd>
  </dl>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
</div>
<!-- Code Finalize -->