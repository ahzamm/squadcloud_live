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
  {{ $fullName }} </b> via Blinkbroadband website.</p>
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
<!-- Code Finalize -->