<?php require('partials/head.php'); ?>
<?php use App\Registry;?>

<br>

<header>
    <a href="<?= root();?>dashboard"><b><h1 class="title">SCHOOL</h1></b></a>

</header>

<style>
  .aside{
            display: flex;
            width:50%;
            flex-direction:row;
            justify-content: space-around;
            align-self: center;
            background-color: #10D7B6;
            font-weight:bold; 
            padding:10px 0px 10px 0px;
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
        
        .aside2{
            display: flex;
            width:100%;
            flex-direction:row;
            justify-content: space-around;
            align-self: center;
            background-color: #10D7B6;
            font-weight:bold; 
            padding:10px 0px 10px 0px;
        }
        

        .title3{
            background-color: #16C2A5;
            color:white;
            width:100%;
            display:flex;
            font-size: 20px;
            justify-content:center;
            padding: 0px 0px 20px 0px;
        }      
        
        .title{
            background-color: #16C2A5;
            color:white;
            width:100%;
            display:flex;
            font-size: 30px;
            justify-content:center;
            padding: 0px 0px 20px 0px;
        }      

        .title2{
            background-color: #16C2A5;
            color:white;
            width:100%;
            display:flex;
            font-size: 15px;
            padding: 0px 0px 10px 10px;
            
        }      
</style>
<aside class="aside2">
<ul>
        <li><a href="<?= root();?>/">Cerrar sesión</a></li>
        <li><a href="<?= root();?>list">Listas</a></li>
        <li><a href="<?= root();?>task">Tareas</a></li>

</ul>
</aside>
<br>
<?php
    if(!isset($_SESSION)){session_start();} 
?>
<b><h1 class="title2">Crear tareas</h1></b>

<aside class="aside">

<form action="<?= root();?>task/createTask" method="POST"> 
  Nombre de la tarea: <input type="text" name="nametask" /> <br><br>
  Descripcion: <input type="text" name="descriptiontask" /> <br><br>
  
  <select name="id_list"  >
    <option selected disabled>Seleccionar lista</option>
    <?php
        //Vamos a preparar la sentencia para que salgan en el seleccionador las listas creadas.
        $bbdd=Registry::get('database');
        $sql ="SELECT * FROM listas WHERE user_id=?;";
        $stmt = $bbdd->query($sql);
        $stmt->execute([$_SESSION["username"]]);
        $request = $stmt->fetchAll();
        foreach($request as $valores){
          
            echo "<option name='id_list' value=".$valores['id'].">".$valores['namelist']."</option>";
          
        } 
    ?>
  </select><br><br>
  <input class="boton-el" type="submit" value="Añadir tarea"/>  <br>
      </aside>
</form>
<br><br>
<?php require('partials/footer.php'); ?>
