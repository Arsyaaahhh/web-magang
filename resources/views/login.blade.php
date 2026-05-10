<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login Admin</title>

<!-- 🔥 CSRF TOKEN WAJIB -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:'Segoe UI', sans-serif;
}

body{
  height:100vh;
  display:flex;
  justify-content:center;
  align-items:center;
  background:linear-gradient(135deg,#fdfdfd,#ffffff);
}

/* CARD */
.login-box{
  background:rgba(255,255,255,0.95);
  backdrop-filter:blur(10px);
  padding:35px 30px;
  border-radius:20px;
  width:330px;
  text-align:center;
  box-shadow:0 10px 30px rgba(0,0,0,0.1);
  animation:fadeIn 0.8s ease;
}

/* LOGO */
.logo{
  width:85px;
  display:block;
  margin:0 auto 10px;
}

/* TITLE */
h2{
  margin-bottom:20px;
  color:#000;
  font-weight:600;
}

/* INPUT */
.input-group{
  position:relative;
  margin-bottom:12px;
}

.input-group input{
  width:100%;
  padding:12px;
  border-radius:12px;
  border:1px solid #ddd;
  transition:0.3s;
}

.input-group input:focus{
  border-color:#0d6efd;
  outline:none;
  box-shadow:0 0 5px rgba(13,110,253,0.3);
}

/* ICON EYE */
.toggle-password{
  position:absolute;
  right:12px;
  top:50%;
  transform:translateY(-50%);
  cursor:pointer;
  font-size:14px;
  color:#555;
}

/* BUTTON */
button{
  width:100%;
  padding:12px;
  background:#0d6efd;
  color:white;
  border:none;
  border-radius:12px;
  cursor:pointer;
  font-size:15px;
  transition:0.3s;
}

button:hover{
  background:#0b5ed7;
  transform:scale(1.03);
}

/* MESSAGE */
.message{
  font-size:13px;
  margin-top:10px;
}

.error{ color:red; }
.success{ color:green; }

/* ANIMATION */
@keyframes fadeIn{
  from{
    opacity:0;
    transform:translateY(20px);
  }
  to{
    opacity:1;
    transform:translateY(0);
  }
}
</style>
</head>

<body>

<div class="login-box">

  <!-- LOGO -->
  <img src="{{ asset('images/logo.jpg') }}" class="logo">

  <h2>Login Admin</h2>

  <div class="input-group">
    <input type="text" id="username" placeholder="Username">
  </div>

  <div class="input-group">
    <input type="password" id="password" placeholder="Password">
    <span class="toggle-password" onclick="togglePassword()">👁️</span>
  </div>

  <button onclick="login()">Masuk</button>

  <div id="message" class="message"></div>

</div>

<script>

// toggle password
function togglePassword(){
  const pass = document.getElementById("password");
  pass.type = pass.type === "password" ? "text" : "password";
}

// login function (FIX FINAL)
function login(){

  const user = document.getElementById("username").value;
  const pass = document.getElementById("password").value;
  const message = document.getElementById("message");

  const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  fetch('/login-process', {
    method:'POST',
    credentials: 'include', // 🔥 WAJIB BANGET
    headers:{
      'Content-Type':'application/json',
      'X-CSRF-TOKEN': token
    },
    body:JSON.stringify({
      username:user,
      password:pass
    })
  })
  .then(res=>res.json())
  .then(res=>{
    if(res.status === 'success'){
      message.innerHTML = "<span class='success'>Login berhasil...</span>";

      // Set localStorage for client-side check
      localStorage.setItem("login", "true");

      setTimeout(()=>{
        if(res.role === 'admin'){
          window.location.href="/admin/admin_sekre";
        }else{
          window.location.href="/dashboard";
        }
      },500);

    }else{
      message.innerHTML = "<span class='error'>Login gagal</span>";
    }
  })
  .catch(()=>{
    message.innerHTML = "<span class='error'>Terjadi error</span>";
  });
}

</script>

</body>
</html>