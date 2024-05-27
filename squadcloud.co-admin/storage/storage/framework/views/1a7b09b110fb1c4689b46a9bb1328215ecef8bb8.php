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
      <?php echo e($fullName); ?> </b> via Blinkbroadband website.</p>
  <table align="center" border="1" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">

    

    <tr>
      <td style="padding: 20px;"> Full Name</td>
      <td style="padding: 20px;"> <b> <?php echo e($fullName); ?></b></td>
    </tr>
    <tr>
      <td style="padding: 20px;"> Email</td>
      <td style="padding: 20px;"> <b> <?php echo e($email); ?></b></td>
    </tr>
    <tr>
      <td style="padding: 20px;"> Phone#</td>
      <td style="padding: 20px;"> <b> <?php echo e($phone); ?></b></td>
    </tr>
    <tr>
      <td style="padding: 20px;"> Message</td>
      <td style="padding: 20px;"> <b> <?php echo e($message); ?></b></td>
    </tr>

  </table>
</body>

</html><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/EmailTemplates/adminContact.blade.php ENDPATH**/ ?>