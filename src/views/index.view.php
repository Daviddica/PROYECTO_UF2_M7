<?php require('partials/head.php'); ?>
<br><br>


<style>
        *{
            margin:0;
            padding:0;
        }

        .boton-el{
            text-decoration: none;
            padding: 10px;
            font-weight: 600;
            font-size: 12px;
            color: #ffffff;
            background-color: #10D7B6;
            border-radius: 6px;
            border: 2px solid #49eed2;
        }

        .title{
            background-color: #16C2A5;
            width:100%;
            color:white;
            display:flex;
            justify-content:center;
            padding: 50px 0px 40px 0px;
            font-size: 35px;
        }
        .aside{
            display: flex;
            width:100%;
            flex-direction:row;
            justify-content: space-around;
            align-self: center;
            background-color: #10D7B6;
            font-weight:bold; 
            padding:10px;
        }

        .aside2{
            display: flex;
            justify-content: space-around;
            background-color: #10D7B6;
            font-weight:bold; 
        }

        a{
            text-decoration:none;
            color:white;
            padding: 80px 0px 0px 0px;
        }
    </style>

<header>
   <b><h1 class="title">SCHOOL</h1></b>

    </header>

<aside class="aside">

<form action="<?= root();?>login/log" method="POST"> 
<br> <br> <br>

  Usuario: <input type="text" name="username" required/> <br><br>
  Contraseña: <input type="password" name="password" required /> <br><br>
  <input type="checkbox" name="remember1"/> Recordar contraseña<br>
  <br>
  <input class="boton-el" type="submit" value="Iniciar sesión"/>   <a href="<?= root();?>register">Registrarse</a></li>
 <br> <br><br><br>
  </aside>
  
</form>

<br><br>
<?php require('partials/footer.php'); ?>
