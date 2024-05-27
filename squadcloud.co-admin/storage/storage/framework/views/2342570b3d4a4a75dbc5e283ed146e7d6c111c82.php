<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html data-editor-version="2" class="sg-campaigns" xmlns="http://www.w3.org/1999/xhtml"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <!--[if !mso]><!-->
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <style>
        *{
            font-family: 'Calibri';
            font-size: 16px;
        }
        .wrapper{
            width:100%;
            margin:0px 10px;
            padding:20px;
            box-sizing: border-box;
        }
        .mail-detail
        {
            line-height: 24px;
        }
        .detail-table
        {
            border-collapse: collapse;
            width: 100%;
        }
        .detail-table td,.detail-table th
        {
            padding:3px;
            padding-left: 15px;
        }
        .detail-table th
        {
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2 style="font-size: 24px;">Dear Management:</h2>
        <p class="mail-detail">New <?php echo e($request_type); ?> request from Blink Broadband website has been added. Details mentioned below</p>
        <table border="1" class="detail-table">
         <tbody>
             <tr>
                 <th>User Name</th>
                 <td><?php echo e($fullName); ?></td>
             </tr>
             <tr>
                <th>Email</th>
                <td><?php echo e($email); ?></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><?php echo e($address); ?></td>
            </tr>
            <tr>
                <th>Nearest Landmark</th>
                <td><?php echo e($nearest_landmark); ?></td>
            </tr>
            <tr>
                <th>Phone</th>
                <td><?php echo e($mobile_no); ?></td>
            </tr>
            <?php if($request_type == 'partner'): ?>
            <tr>
                <th>No.of Users</th>
                <td><?php echo e($no_of_users); ?></td>
            </tr>
            <?php endif; ?>
            <tr>
                <th>City</th>
                <td><?php echo e($city_id); ?></td>
            </tr>
            <tr>
                <th>Core Area</th>
                <td><?php echo e($core_area_id); ?></td>
            </tr>
            <tr>
                <th>Zone Area</th>
                <td><?php echo e($zone_area_id); ?></td>
            </tr>
        </tbody>
    </table>
</div>
</body>
</html><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/email/coverage_request.blade.php ENDPATH**/ ?>