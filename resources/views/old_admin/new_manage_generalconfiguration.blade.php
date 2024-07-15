@extends('layouts/backend')
@section('page_title', 'general configuration')
@section('generalconfiguration_select', 'active')
@section('content')


<div class="row">
    <main class="main users chart-page" id="skip-target">
        <div class="container">
            <!-- <h1 align="center" class="main-title">Form</h1> -->

            <div class="bb-design">
                <form action="{{ route('general_configuration.manage_general_configuration_process') }}" method="post" enctype="multipart/form-data">

                    @csrf

                    <div class="col-md-6">
                         <label for="default_language" class="form-label">Default Language</label>
                          <select id="default_language" name="default_language" class="form-select">
                                <option value="aar"> Afar </option>
                                <option value="abk"> Abkhazian </option>
                                <option value="afr"> Afrikaans </option>
                                <option value="alt"> Southern Altai </option>
                                <option value="amh"> Amharic </option>
                                <option value="ang"> English </option>
                                <option value="apa"> Apache languages </option>
                                <option value="ara"> Arabic </option>
                                <option value="arc"> Official Aramaic (700-300 BCE) Imperial Aramaic (700-300 BCE) </option>
                                <option value="arg"> Aragonese </option>
                                <option value="arm"> Armenian </option>
                                <option value="arn"> Mapudungun Mapuche </option>
                                <option value="arp"> Arapaho </option>
                                <option value="art"> Artificial languages </option>
                                <option value="aus"> Australian languages </option>
                                <option value="aze"> Azerbaijani </option>
                                <option value="ban"> Balinese </option>
                                <option value="baq"> Basque </option>
                                <option value="bas"> Basa </option>
                                <option value="bej"> Beja Bedawiyet </option>
                                <option value="ben"> Bengali </option>
                                <option value="bho"> Bhojpuri </option>
                                <option value="bih"> Bihari languages </option>
                                <option value="bla"> Siksika </option>
                                <option value="bnt"> Bantu (Other) </option>
                                <option value="bos"> Bosnian </option>
                                <option value="cai"> Central American Indian languages </option>
                                <option value="chi"> Chinese </option>
                                <option value="chm"> Mari </option>
                                <option value="chn"> Chinook jargon </option>
                                <option value="chv"> Chuvash </option>
                                <option value="csb"> Kashubian </option>
                                <option value="cus"> Cushitic languages </option>
                                <option value="cze"> Czech </option>
                                <option value="dak"> Dakota </option>
                                <option value="dan"> Danish </option>
                                <option value="dar"> Dargwa </option>
                                <option value="doi"> Dogri </option>
                                <option value="egy"> Egyptian (Ancient) </option>
                                <option value="eng"> English </option>
                                <option value="enm"> English </option>
                                <option value="epo"> Esperanto </option>
                                <option value="est"> Estonian </option>
                                <option value="fre"> French </option>
                                <option value="frm"> French </option>
                                <option value="fro"> French </option>
                                <option value="frr"> Northern Frisian </option>
                                <option value="gem"> Germanic languages </option>
                                <option value="geo"> Georgian </option>
                                <option value="ger"> German </option>
                                <option value="gla"> Gaelic Scottish Gaelic </option>
                                <option value="gle"> Irish </option>
                                <option value="gmh"> German </option>
                                <option value="grc"> Greek </option>
                                <option value="gre"> Greek </option>
                                <option value="grn"> Guarani </option>
                                <option value="guj"> Gujarati </option>
                                <option value="hil"> Hiligaynon </option>
                                <option value="him"> Himachali languages Western Pahari languages </option>
                                <option value="hin"> Hindi </option>
                                <option value="ido"> Ido </option>
                                <option value="inc"> Indic languages </option>
                                <option value="ind"> Indonesian </option>
                                <option value="ira"> Iranian languages </option>
                                <option value="ita"> Italian </option>
                                <option value="jpn"> Japanese </option>
                                <option value="jpr"> Judeo-Persian </option>
                                <option value="jrb"> Judeo-Arabic </option>
                                <option value="kan"> Kannada </option>
                                <option value="kas"> Kashmiri </option>
                                <option value="kor"> Korean </option>
                                <option value="lao"> Lao </option>
                                <option value="lat"> Latin </option>
                                <option value="mal"> Malayalam </option>
                                <option value="mga"> Irish </option>
                                <option value="mis"> Uncoded languages </option>
                                <option value="mul"> Multiple languages </option>
                                <option value="mus"> Creek </option>
                                <option value="nep"> Nepali </option>
                                <option value="ota"> Turkish </option>
                                <option value="peo"> Persian </option>
                                <option value="per"> Persian </option>
                                <option value="phi"> Philippine languages </option>
                                <option value="raj"> Rajasthani </option>
                                <option value="roa"> Romance languages </option>
                                <option value="rus"> Russian </option>
                                <option value="sai"> South American Indian (Other) </option>
                                <option value="sal"> Salishan languages </option>
                                <option value="san"> Sanskrit </option>
                                <option value="scn"> Sicilian </option>
                                <option value="sgn"> Sign Languages </option>
                                <option value="snd"> Sindhi </option>
                                <option value="sog"> Sogdian </option>
                                <option value="som"> Somali </option>
                                <option value="son"> Songhai languages </option>
                                <option value="spa"> Spanish Castilian </option>
                                <option value="swe"> Swedish </option>
                                <option value="syr"> Syriac </option>
                                <option value="tah"> Tahitian </option>
                                <option value="tai"> Tai languages </option>
                                <option value="tam"> Tamil </option>
                                <option value="tel"> Telugu </option>
                                <option value="tha"> Thai </option>
                                <option value="tir"> Tigrinya </option>
                                <option value="tur"> Turkish </option>
                                <option value="tut"> Altaic languages </option>
                                <option value="ukr"> Ukrainian </option>
                                <option value="urd"> Urdu </option>
                                <option value="uzb"> Uzbek </option>
                                <option value="yao"> Yao </option>
                                <option value="yap"> Yapese </option>
                                <option value="yid"> Yiddish </option>
                                <option value="yor"> Yoruba </option>
                                <option value="ypk"> Yupik languages </option>
                                <option value="zap"> Zapotec </option>
                            </select>
                            @error('default_language')
                            <p class="text-danger text-center">{{$message}}</p>
                            @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input id="phone_number" placeholder="Enter phone Number" value="{{ $phone_number }}" name="phone_number" type="number" class="form-control">     
                        @error('phone_number')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                   
                    <div class="col-md-6">
                        <label for="keyword" class="form-label">Key Word</label>
                        <input id="keyword" placeholder="Enter keyword" value="{{ $keyword }}" name="keyword" type="text" class="form-control">     
                        @error('keyword')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="col-md-6">
                    <label for="site_logo" class="form-label">Site Logo</label>
                        <input id="site_logo" name="site_logo" type="file" class="form-control">
                        <small>dimensions:min_width=220,min_height=80</small>
                        @error('site_logo')
                        <p class="text-danger text-center">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="col-md-6">
                    <label for="slug" class="form-label">Slug</label>
                    <input id="slug" placeholder="Enter Slug" value="{{ $slug }}" name="slug" type="text" class="form-control">     
                    @error('slug')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                    </div>

                    <div class="col-md-6">
                    <label for="fav_icon" class="form-label">Fav Icon</label>
                    <input id="fav_icon" name="fav_icon" type="file" class="form-control">
                    <small>dimensions:min_width=48,min_height=48</small>
                    @error('fav_icon')
                    <p class="text-danger text-center">{{$message}}</p>
                    @enderror
                    </div>

                    <!-- <div class="col-md-6">
                    <label for="chatbox" class="form-label">chat box</label>

                     
                    @if($chat_box == 1)
                        <input type="checkbox" class="form-check-input" id="chat_box" name="chat_box" checked value="0">
                        <label for="checkbox" class="custom-control-label form-check-label">Show Chat Box</label><br>

                    @elseif($chat_box == 0)

                        <input type="checkbox" class="form-check-input" id="chat_box" name="chat_box" value="1">
                        <label for="checkbox" class="custom-control-label form-check-label">Show Chat Box</label><br>

                    @else

                        <p>status not set</p>

                    @endif
                            
                    @error('chat_box')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                    </div> -->

                    

                    <div class="col-md-6">
                    <label for="whatsapp_url" class="form-label">Whatapp Url</label>
                        <input id="whatsapp_url" placeholder="Enter Whatapp url" value="{{ $whatsapp_url }}" name="whatsapp_url" type="url" class="form-control">     
                        @error('whatsapp_url')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="skype_url" class="form-label">Skype Url</label>
                        <input id="skype_url" placeholder="Enter Skype url" value="{{ $skype_url }}" name="skype_url" type="url" class="form-control" >     
                        @error('skype_url')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>


                    <div class="col-md-6">
                        <label for="message_url" class="form-label">Message Url</label>
                        <input id="message_url" placeholder="Enter Message Url" value="{{ $message_url }}" name="message_url" type="url" class="form-control" >     
                        @error('message_url')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>


                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone Url</label>
                        <input id="phone" placeholder="Enter Phone Url" value="{{ $phone_url }}" name="phone_url" type="url" class="form-control" >     
                        @error('phone_url')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="facebook_url" class="form-label">Facebook Url</label>
                        <input id="facebook_url" placeholder="Enter Facebook Url" value="{{ $facebook_url }}" name="facebook_url" type="url" class="form-control" >     
                        @error('facebook_url')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>


                    <div class="col-md-6">
                        <label for="linkedin_url" class="form-label">LinkedIn Url</label>
                        <input id="linkedin_url" placeholder="Enter LinkedIn Url" value="{{ $linkedin_url }}" name="linkedin_url" type="url" class="form-control" >     
                        @error('linkedin_url')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>


                    <div class="col-md-6">
                        <label for="twitter_url" class="form-label">Twitter Url</label>
                        <input id="twitter_url" placeholder="Enter Twitter Url" value="{{ $twitter_url }}" name="twitter_url" type="url" class="form-control">     
                        @error('twitter_url')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" placeholder="Enter Email Address" value="{{ $email }}" name="email" type="email" class="form-control">     
                        @error('email')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>


                    <div class="col-md-6">
                        <label for="address" class="form-label">Address</label>
                        <textarea id="Address" placeholder="Address" name="address" class="form-control" >{{ $address }}</textarea>         
                        @error('address')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                        

        
                    <div class="col-md-6">
                        <label for="office_timing" class="form-label">Office Timing</label>
                        <textarea id="editor4" placeholder="Enter Office Timing" name="office_timing" class="form-control" >{{ $office_timing }}</textarea>         
                        @error('office_timing')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="service_icon_red" class="form-label">Service Icon Red</label>
                        <input id="service_icon_red" placeholder="Service Icon Red" value="{{ $service_icon_red }}" name="service_icon_red" type="file" class="form-control">     
                        <small>dimensions:min_width=220,min_height=80</small>
                        @error('service_icon_red')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="service_icon_black" class="form-label">Service Icon Black</label>
                        <input id="service_icon_black" placeholder="Service Icon Black" value="{{ $service_icon_black }}" name="service_icon_black" type="file" class="form-control">     
                        <small>dimensions:min_width=220,min_height=80</small>
                        @error('service_icon_black')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

            
                    <div class="col-md-6">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea maxlength="180" id="editor" placeholder="Enter meta description" name="meta_description" class="form-control" >{{ $meta_description }}</textarea>         
                        @error('meta_description')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>


                     <div class="col-md-6">
                        <label for="footer_text" class="form-label">Footer Text</label>
                        <textarea id="editor2" placeholder="Enter footertext" name="footer_text" class="form-control" >{{ $footer_text }}</textarea>         
                        @error('footer_text')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input id="id" value="{{ $id }}" name="id" type="hidden">
                    </div>

                    <div>
                        @if($id>0)
                        <div class="red-btn">
                            <input type="Submit" value="update">

                        </div>
                        @else
                        <div class="red-btn">
                            <input type="Submit" value="Add">
                        </div>
                        @endif
                        <a href="{{ url('admin/general_configuration') }}">
                            <div class="red-btn">
                                <input type="button" value="Back">
                            </div>
                        </a>
                    </div>

                </form>
            </div>

        </div>
    </main>
</div>

@endsection()