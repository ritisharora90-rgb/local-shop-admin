<!DOCTYPE html>
<html>

<head>

<title>Register</title>

<link
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
rel="stylesheet"
/>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Segoe UI;
}

body{

height:100vh;

display:flex;

justify-content:center;

align-items:center;

overflow:hidden;

background:
linear-gradient(
135deg,
#0f172a,
#1e3a8a,
#6d28d9
);

}

.bg{

position:absolute;

width:300px;

height:300px;

border-radius:50%;

filter:blur(80px);

animation:
move 8s infinite alternate;

}

.b1{

background:#6366f1;

top:-100px;

left:-100px;

}

.b2{

background:#9333ea;

bottom:-120px;

right:-80px;

}

@keyframes move{

to{

transform:
translateY(60px)
translateX(50px);

}

}

.card{

width:420px;

padding:40px;

border-radius:25px;

background:
rgba(255,255,255,.08);

backdrop-filter:
blur(18px);

border:
1px solid
rgba(255,255,255,.15);

box-shadow:
0 20px 50px
rgba(0,0,0,.3);

color:white;

}

.card h2{

text-align:center;

margin-bottom:30px;

}

.input{

position:relative;

margin-bottom:22px;

}

.input input{

width:100%;

padding:16px 45px;

border:none;

outline:none;

border-radius:12px;

background:
rgba(255,255,255,.08);

color:white;

}

.input label{

position:absolute;

left:45px;

top:15px;

transition:.3s;

color:#ddd;

pointer-events:none;

}

.input input:focus + label,
.input input:valid + label{

top:-10px;

left:15px;

font-size:12px;

padding:4px 10px;

border-radius:10px;

background:#4f46e5;

}

.icon{

position:absolute;

left:15px;

top:18px;

}

.eye{

position:absolute;

right:15px;

top:18px;

cursor:pointer;

}

button{

width:100%;

padding:15px;

border:none;

border-radius:12px;

font-size:16px;

font-weight:bold;

cursor:pointer;

background:
linear-gradient(
90deg,
#6366f1,
#9333ea
);

color:white;

transition:.3s;

}

button:hover{

transform:
translateY(-3px);

box-shadow:
0 15px 40px
rgba(99,102,241,.5);

}

</style>

</head>

<body>

<div class="bg b1"></div>
<div class="bg b2"></div>

<div class="card">

<h2>Create Account</h2>

<form method="POST">

@csrf

<div class="input">

<i class="fa fa-user icon"></i>

<input
name="name"
required>

<label>Name</label>

</div>

<div class="input">

<i class="fa fa-envelope icon"></i>

<input
name="email"
type="email"
required>

<label>Email</label>

</div>

<div class="input">

<i class="fa fa-lock icon"></i>

<input
id="password"
name="password"
type="password"
required>

<label>Password</label>

<i
class="fa fa-eye eye"
onclick="togglePass()">
</i>

</div>

<button>

Create Account

</button>

</form>

</div>

<script>

function togglePass(){

let p =
document.getElementById("password");

p.type =
p.type==="password"
?
"text"
:
"password";

}

</script>

</body>

</html>