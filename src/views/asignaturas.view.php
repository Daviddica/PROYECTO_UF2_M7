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
            padding: 0px 0px 0px 0px;
            
        }      
</style>
<aside class="aside2">
<ul>
        <li><a href="<?= root();?>/">Cerrar sesión</a></li>
        <li><a href="<?= root();?>usuarios">Usuarios</a></li>
        <li><a href="<?= root();?>asignaturas">Asignaturas</a></li>
        <li><a href="<?= root();?>cursos">Cursos</a></li>

</ul>
</aside>

<br>
<?php
    if(!isset($_SESSION)){session_start();} 
?>

<header>
    <h1 class="title3">Administrar asignaturas</h1>

</header>

<!-- Crear asignatura -->
<b><h1 class="title2">Crear asignatura</h1></b>

<aside class="aside">

<form action="<?= root();?>asignaturas/asignatura" method="POST"> 
  Nombre asignatura <input type="text" name="nombre_asignatura" required /> <br><br>
    
  <select name="codigo_curso">
    <option selected disabled>Seleccionar curso</option>
    <?php
        //Vamos a preparar la sentencia para que salgan en el seleccionador los cursos creados.
        $db=Registry::get('database');
        $sql ="SELECT * FROM cursos";
        $stmt = $db->query($sql);
        $stmt->execute();
        $request = $stmt->fetchAll();
        foreach($request as $valores){
          
            echo "<option name='codigo_curso' value=".$valores['codigo_curso'].">".$valores['nombre_curso']."</option>";
          
        } 
    ?>
  </select>

  <select name="id_profesor">
    <option selected disabled>Seleccionar profesor</option>
    <?php
        //Vamos a preparar la sentencia para que salgan en el seleccionador los profesores creados.
        $db=Registry::get('database');
        $sql ="SELECT * FROM profesores";
        $stmt = $db->query($sql);
        $stmt->execute();
        $request = $stmt->fetchAll();
        foreach($request as $valores){
          
            echo "<option name='id_profesor' value=".$valores['id_profesor'].">".$valores['id_profesor']."</option>";
          
        } 
    ?>
  </select><br><br>
  <input class="boton-el" type="submit" value="Crear asignatura"/>  <br>
      </aside>
</form>
<br>

<!-- editar asignatura -->
<b><h1 class="title2">Editar asignatura</h1></b>

<aside class="aside">

<form action="<?= root();?>asignaturas/updateAsignatura" method="POST"> 

<select name="codigo_asignatura">
    <option selected disabled>Seleccionar asignatura</option>
    <?php
        //Vamos a preparar la sentencia para que salgan en el seleccionador las asignaturas creadas.
        $db=Registry::get('database');
        $sql ="SELECT * FROM asignaturas";
        $stmt = $db->query($sql);
        $stmt->execute();
        $request = $stmt->fetchAll();
        foreach($request as $valores){
          
            echo "<option name='codigo_asignatura' value=".$valores['codigo_asignatura'].">".$valores['nombre_asignatura']."</option>";
          
        } 
    ?>
  </select>
<br><br>
  Nombre asignatura <input type="text" name="nombre_asignatura" required/> <br><br>

  <input class="boton-el" type="submit" value="Modificar asignatura"/>  <br>
      </aside>
</form>

<br>

<!-- eliminar asignatura -->
<b><h1 class="title2">Eliminar asignatura</h1></b>

<aside class="aside">

<form action="<?= root();?>asignaturas/deleteAsignatura" method="POST"> 

<select name="codigo_asignatura2">
    <option selected disabled>Seleccionar asignatura</option>
    <?php
        //Vamos a preparar la sentencia para que salgan en el seleccionador las asignaturas creadas.
        $db=Registry::get('database');
        $sql ="SELECT * FROM asignaturas";
        $stmt = $db->query($sql);
        $stmt->execute();
        $request = $stmt->fetchAll();
        foreach($request as $valores){
          
            echo "<option name='codigo_asignatura' value=".$valores['codigo_asignatura'].">".$valores['nombre_asignatura']."</option>";
          
        } 
    ?>
  </select>
<br><br>

  <input class="boton-el" type="submit" value="Eliminar asignatura"/>  <br>
      </aside>
</form>


<br><br><br>
<?php require('partials/footer.php'); ?>
