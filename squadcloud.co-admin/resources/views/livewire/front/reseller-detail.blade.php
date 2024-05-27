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