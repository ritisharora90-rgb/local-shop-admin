<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial, sans-serif;
}

body{
height:100vh;
display:flex;
justify-content:center;
align-items:center;

background:
linear-gradient(
135deg,
#667eea,
#764ba2
);
}

.login-box{

background:white;

padding:40px;

width:380px;

border-radius:20px;

box-shadow:
0 15px 40px
rgba(0,0,0,.2);

animation:
fade .6s ease;
}

@keyframes fade{
from{
opacity:0;
transform:
translateY(20px);
}
to{
opacity:1;
transform:
translateY(0);
}
}

.login-box h2{

text-align:center;

margin-bottom:25px;

color:#333;
}

.input-group{

margin-bottom:18px;
}

.input-group input{

width:100%;

padding:14px;

border:1px solid #ddd;

border-radius:10px;

outline:none;

transition:.3s;
}

.input-group input:focus{

border-color:#667eea;

box-shadow:
0 0 10px
rgba(102,126,234,.4);
}

button{

width:100%;

padding:14px;

border:none;

border-radius:10px;

background:
linear-gradient(
90deg,
#667eea,
#764ba2
);

color:white;

font-size:16px;

cursor:pointer;

transition:.3s;
}

button:hover{

transform:
translateY(-2px);

opacity:.95;
}

.alert{

padding:12px;

margin-bottom:20px;

border-radius:10px;

text-align:center;
}

.success{

background:#d4edda;

color:#155724;
}

.error{

background:#f8d7da;

color:#721c24;
}
.register{
    margin-top: 10px ;
}

</style>

</head>

<body>

<div class="login-box">

@if(session('success'))
<div class="alert success">
{{ session('success') }}
</div>
@endif

@if($errors->any())
<div class="alert error">
{{ $errors->first() }}
</div>
@endif


<h2>Admin Login</h2>

<form method="POST" action="/admin/login">

@csrf

<div class="input-group">

<input
type="email"
name="email"
placeholder="Enter Email"
required>

</div>


<div class="input-group">

<input
type="password"
name="password"
placeholder="Enter Password"
required>

</div>

<button type="submit">

Login

</button>
<div class='register'>
 <p className="text-center mb-0 mt-2" >
          Do not have an account?
          <a href="http://127.0.0.1:8000/admin/register" className="text-primary">Register here</a>
        </p>
</div>

</form>

</div>

</body>
</html>