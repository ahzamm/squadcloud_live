<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body style="  font-family: Arial, sans-serif;
margin: 0;
padding: 0;
display: flex;
justify-content: center;
align-items: center;">
  <div class="container" style="max-width: 600px;
background-color: #1716161c;
padding: 20px;
border-radius: 8px;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    <div class="header" style="  text-align: center;">

      @php
        $general_configuration = DB::table('general_configurations')->first();
        $contact = DB::table('contacts')->first();
      @endphp

      <img src="https://squadcloud.co/frontend_assets/images/logo.png" alt="">
    </div>
    <center>
      <h2>Thanks for Contacting Us!</h2>
    </center>
    <div class="content" style=" line-height: 1.6;
color: #333;">
      <p>Dear {{ $fullName }},</p>
      <p>Thank you for reaching out to us. We have received your message and will get back to you as soon as possible.
      </p>
      <p>If you have any urgent matters, please feel free to contact our team at {{ $contact->email }}
        {{ $contact->phone }}.</p>
      <p>Best regards,<br>{{ $general_configuration->brand_name }}</p>
    </div>
    <div class="footer" style="margin-top: 20px;
text-align: center;
color: #777;
font-size: 0.7rem;">
      <p>This is an automated email. Please do not reply to this email.</p>
    </div>
  </div>
</body>

</html>
