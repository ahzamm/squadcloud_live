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
 <div class="panel-group" id="accordion-faq" role="tablist" aria-multiselectable="true">
  @foreach ($faqs as $key => $item)
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading{{$key}}">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion-faq" href="#collapse{{$key}}" aria-expanded="false" aria-controls="collapse{{$key}}">
          {!!$item->question!!}
        </a>
      </h4>
    </div>
    <div id="collapse{{$key}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$key}}">
      <div class="panel-body">
        {!!$item->answer!!}
      </div>
    </div>
  </div>
  @endforeach
</div>
<!-- Code Finalize -->