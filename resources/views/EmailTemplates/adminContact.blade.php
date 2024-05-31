<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
</head>

<body style="font-family: Arial, sans-serif;">
  <p>Dear <span style="font-weight: 900;">Admin</span>,</p>
  <p>A contact message was sent by <b>
      {{ $fullName }} </b> via {{ $general_configuration->brand_name }} website.</p>
  <table align="center" border="1" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">



    <tr>
      <td style="padding: 20px;"> Full Name</td>
      <td style="padding: 20px;"> <b> {{ $fullName }}</b></td>
    </tr>
    <tr>
      <td style="padding: 20px;"> Email</td>
      <td style="padding: 20px;"> <b> {{ $email }}</b></td>
    </tr>
    <tr>
      <td style="padding: 20px;"> Phone#</td>
      <td style="padding: 20px;"> <b> {{ $phone }}</b></td>
    </tr>
    <tr>
      <td style="padding: 20px;"> Message</td>
      <td style="padding: 20px;"> <b> {{ $message }}</b></td>
    </tr>

  </table>
</body>

</html>
