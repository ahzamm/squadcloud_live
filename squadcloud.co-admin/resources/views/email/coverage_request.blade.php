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
        <p class="mail-detail">New {{$request_type}} request from Blink Broadband website has been added. Details mentioned below</p>
        <table border="1" class="detail-table">
         <tbody>
             <tr>
                 <th>User Name</th>
                 <td>{{$fullName}}</td>
             </tr>
             <tr>
                <th>Email</th>
                <td>{{$email}}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{$address}}</td>
            </tr>
            <tr>
                <th>Nearest Landmark</th>
                <td>{{$nearest_landmark}}</td>
            </tr>
            <tr>
                <th>Phone</th>
                <td>{{$mobile_no}}</td>
            </tr>
            @if ($request_type == 'partner')
            <tr>
                <th>No.of Users</th>
                <td>{{$no_of_users}}</td>
            </tr>
            @endif
            <tr>
                <th>City</th>
                <td>{{$city_id}}</td>
            </tr>
            <tr>
                <th>Core Area</th>
                <td>{{$core_area_id}}</td>
            </tr>
            <tr>
                <th>Zone Area</th>
                <td>{{$zone_area_id}}</td>
            </tr>
        </tbody>
    </table>
</div>
</body>
</html>