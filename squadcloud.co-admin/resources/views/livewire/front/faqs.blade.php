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