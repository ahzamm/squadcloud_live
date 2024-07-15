<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/45fa0ed931.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500&display=swap" rel="stylesheet">
    <title>Login</title>
    <style>
        body{
            background: hsla(0, 0%, 0%, 1);

            background: linear-gradient(45deg, hsla(0, 0%, 0%, 1) 55%, hsla(354, 100%, 39%, 1) 56%);

            background: -moz-linear-gradient(45deg, hsla(0, 0%, 0%, 1) 60%, hsla(354, 100%, 39%, 1) 56%);

            background: -webkit-linear-gradient(45deg, hsla(0, 0%, 0%, 1) 60%, hsla(354, 100%, 39%, 1) 56%);

            filter: progid: DXImageTransform.Microsoft.gradient( startColorstr="#000000", endColorstr="#C90015", GradientType=1 );
            margin: 0;
        }
        .container{
            width: 80%;
            margin: auto;
            height: 100vh;
            justify-content: center;
            display: flex;
            align-items: center;
        }
        .form-section{
            display: flex;
            justify-content: center;
        }
        .Welcome-page{
            background-color: #c90015;
            display:flex;
            flex-direction: column;
            justify-content: center;
            width: 300px;
            height: 400px;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }
        .Welcome-page h3{
            margin: 0 20px;
            font-family: 'Poppins', sans-serif;
            font-size: 25px;
            color: white;
        }
        .Welcome-page h4{
            margin: 10px 70px;
            font-family: 'Poppins', sans-serif;
            color: white;
            font-size: 16px;
        }
        .bord{
            border-bottom: 2px solid #000;
            width: 200px;
            margin: 10px 50px;
            border-radius: 5px;
            /* margin-left: 20px; */
        }
        .forms{
            width: 300px;
            background-color: white;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
            height: 400px;
        }
        .forms img{
            margin-left: 30px;
            margin-top: 50px;
        }
        .input{
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }
        .input input{
        margin: 10px 0px;
        height: 30px;
        width:200px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        background-color: #c90015;
        color: white;
        padding-left: 10px;
        font-family: 'Poppins', sans-serif;
        outline: none;
        }
        .input input::placeholder{
            color: white;
        }
        .input input:focus::placeholder{
            color: black;
        }
        .input input:focus{
            background-color: #E8F0FE;
            color: black;
        }
        .input button{
            width: 100px;
            height: 40px;
            font-size: 16px;
            font-family: 'Poppins', sans-serif;
            background-color: transparent;
            color: black;
            border: 2px solid #c90015;
            margin: 30px 0px;
        }
        .input button:hover{
            background-color: #c90015;
            border: none;
            cursor: pointer;
            transition: all .1s;
        }
        .input a{
            color: black;
            margin-right: 70px;
            font-size: 14px;
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
        }
        .input a:hover{
            color: #c90015;
            transition: all 0.1s;
        }
        .input .invalid{
            margin: 0;
            font-family: 'Poppins', sans-serif;
            color: #c90015;
            font-size: 14px;
        }
        @media only screen and (max-width:768px){
            .Welcome-page{
                display: none;  
            }
        }
    </style>

</head>
<body>
   <section class="home-section">
    <div class="container">
        <div class="form-section">
            <div class="Welcome-page">
                <h3>Welcome To SquadCloud Admin Panel</h3>
                <div class="bord"></div>
                <h4>Sign in to continue</h4>
            </div>
           
            <div class="forms">
                <form action="{{ route('admin.auth') }}" method="post">
                @csrf
                    <img src="{{ Config::get('constants.SITE_LOGO') }}">
                <div class="input">
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <!-- <a href="#">Forgot Password?</a> -->
                    <p class="invalid">{{ session('error') }}</p>
                    <p class="invalid">{{ session('msg') }}</p>         
                    <button type="submit">Login </button>
                </div>    
                </form>
            </div>
        </div>
    </div>
   </section>
</body>
</html>