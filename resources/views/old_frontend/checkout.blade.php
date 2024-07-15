@extends('layouts/frontend')
@section('page_title', 'SquadCloud | Digital Company')
@section('home_select', 'active')
@section('content')

<style>
   header#main-header {
      background: rgb(100 5 15) !important;
   }
   section#our-portfolio {
      padding-top: 150px;
   }
  
</style>

      <!-- Main-Content -->
   <div class="background-og">
      <section class="checkout">
         <div class="container fluid">
            <h1><span style="color: #B21828;">Make Your </span>Checkout Here</h1>
            <p>Please register in order to checkout more quickly</p>
            <form action="/submitcheckout" method="post">
               @csrf
            <div class="main">
               <div class="box-1">
                  <div class="field-1">
                     <div class="fields">
                        <label for="name" class="formlable"></label>
                        <input type="text" class="formcontrol-1" name="first_name" placeholder="First Name">
                        @error('first_name')
                         <p class="text-danger">{{$message}}</p>
                        @enderror
                     </div>

                       
                     <div class="fields">
                        <label for="lastname" class="formlabel"></label>
                        <input type="text" class="formcontrol-2" name="last_name" placeholder="Last Name">
                        @error('last_name')
                         <p class="text-danger">{{$message}}</p>
                        @enderror
                     </div>
                  </div>

                  <div class="field-1">
                     <div class="fields">
                        <label for="email" class="formlable"></label>
                        <input type="email" class="formcontrol-3" name="email" placeholder="Email">
                        @error('email')
                         <p class="text-danger">{{$message}}</p>
                        @enderror
                     </div>

                     <div class="fields">
                        <label for="phone" class="formlabel"></label>
                        <input type="text" class="formcontrol-4" name="phone"  placeholder="Phone">
                        @error('phone')
                         <p class="text-danger">{{$message}}</p>
                        @enderror
                     </div>
                  </div>

                  <div class="field-1">
                     <div class="fields">
                        <label class="formlabel"></label>
                        <select name="country" class="formselect-1">
                           <option value="" selected>--Select Country--</option>
                           <option value="1">Pakistan</option>
                           <option value="2">USA</option>
                           <option value="3">Iran</option>
                        </select>
                        @error('country')
                         <p class="text-danger">{{$message}}</p>
                        @enderror
                     </div>

                     <div class="fields">
                        <label class="formlabel"></label>
                        <select name="state" class="formselect-2">
                           <option value="" selected>--Select State--</option>
                           <option value="1">Sindh</option>
                           <option value="2">Washington-Dc</option>
                           <option value="3">Punjab</option>
                        </select>
                        @error('state')
                         <p class="text-danger">{{$message}}</p>
                        @enderror
                     </div>
                  </div>

                  <div class="field-1">
                     <div class="fields">
                        <label for="text" class="formlable"></label>
                        <input type="" class="formcontrol-5" name="address_line_1" placeholder="Address Line 1">
                        @error('address_line_1')
                         <p class="text-danger">{{$message}}</p>
                        @enderror
                     </div>

                     <div class="fields">
                        <label for="text" class="formlabel"></label>
                        <input type="text" class="formcontrol-6" name="address_line_2" placeholder="Address Line 2">
                        @error('address_line_2')
                         <p class="text-danger">{{$message}}</p>
                        @enderror
                     </div>
                  </div>

                  <div class="field-1">
                     <div class="fields">
                        <label for="Postal Code" class="formlable"></label>
                        <input type="number" class="formcontrol-7" name="postal_code" placeholder="Postal Code">
                        @error('postal_code')
                         <p class="text-danger">{{$message}}</p>
                        @enderror
                     </div>

                     <div class="fields">
                        <label class="formlabel"></label>
                        <select name="company" class="formselect-3">
                           <option value="" selected>--Select Company--</option>
                           <option value="1">Squad Cloud</option>
                           <option value="2">Logon</option>
                           <option value="3">Folio</option>
                        </select>
                        @error('company')
                         <p class="text-danger">{{$message}}</p>
                        @enderror
                     </div>
                  </div>

                  <div class="formcheck">
                     <input class="formcheck" type="checkbox" value="" id="flexCheckChecked" checked>
                     <label class="formcheck" for="flexCheckChecked">
                        <b>Create An Account</b>
                     </label>
                  </div>
               </div>


               <div class="box-2">
                  <h4 style="font-weight: 700;"><span style="color: #B21828;">CART </span>TOTALS</h4>
             
                  <div class="innerbox-2">
                  <p style="font-weight: 700;">Total</p>
                  <p style="font-weight: 600;">${{ $price->price }}</p>
                  </div>

                  <!-- <h3 style="color: #B21828;">PAYMENT</h3>

                    <div class="form-check">
                        <input class="formradio" type="radio" name="flexRadioDefault">
                        <label class="formradio">
                          Check Payment
                        </label>
                      </div>

                      <div class="form-check">
                        <input class="formradio" type="radio" name="flexRadioDefault">
                        <label class="formradio">
                          Cash on Delivery
                        </label>
                      </div>

                      <div class="form-check">
                        <input class="formradio" type="radio" name="flexRadioDefault">
                        <label class="formradio">
                          Paypal
                        </label>
                      </div> -->



                  <div class="bank">
                     <!-- <div class="line"></div>
                        <h5>Banks</h5> -->

                     <div class="bankinner">
                        <img src="frontend_assets/images/checkout/Maestro_logo.png" alt="">
                        <img src="frontend_assets/images/checkout/196578.png" alt="">
                        <img src="frontend_assets/images/checkout/paypal-784403__340.webp" alt="">
                        <img
                           src="frontend_assets/images/checkout/hd-payoneer-payment-official-logo-png-21635324705hhosuwxwnz.png"
                           alt="">
                     </div>
                  </div>
                  <div class="buttonbtn">
                     <button type="submit">PROCEED TO CHECKOUT</button>
                  </div>

               </div>

            </div>
          </form>
         </div>
      </section>

      <div class="products">
         <div class="product-main">
            <div class="product-1">
               <img src="frontend_assets/images/checkout/photo-1546868871-7041f2a55e12.jfif" alt="">
            </div>
            <div class="product-details">
               <li>watch ultra 15</li>
               <li>watch ultra 15</li>
               <li>watch ultra 15</li>
            </div>
       </div>
      </div>

      <section>
         <div class="services">
            <div class="serve">
               <div class="container">
                  <div class="main-2">
                     <div class="flexflex">
                        <div class="flex-1">
                           <i class="fa-solid fa-lock" style="color: #B21828;"></i>
                        </div>
                        <div class="flex-2">
                           <p><b>SHIPPING</b></p>
                           <p>FREE SHIPPING</p>
                        </div>
                     </div>
                     <div class="flexflex">
                        <div class="flex-1">
                           <i class="fa-solid fa-lock" style="color: #B21828;"></i>
                        </div>
                        <div class="flex-2">
                           <p><b>SHIPPING</b></p>
                           <p>FREE SHIPPING</p>
                        </div>
                     </div>
                     <div class="flexflex">
                        <div class="flex-1">
                           <i class="fa-solid fa-lock" style="color: #B21828;"></i>
                        </div>
                        <div class="flex-2">
                           <p><b>SHIPPING</b></p>
                           <p>FREE SHIPPING</p>
                        </div>
                     </div>
                     <div class="flexflex">
                        <div class="flex-1">
                           <i class="fa-solid fa-lock" style="color: #B21828;"></i>
                        </div>
                        <div class="flex-2">
                           <p><b>SHIPPING</b> </p>
                           <p>FREE SHIPPING</p>
                        </div>

                     </div>
                  </div>

               </div>
            </div>
         </div>
      </section>
   </div>

   @endsection()
