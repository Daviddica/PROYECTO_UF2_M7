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
    <h1 class="title3">Administrar usuarios</h1>

</header>
<!-- Crear usuario -->

<b><h1 class="title2">Crear usuario</h1></b>

<aside class="aside">
<form action="<?= root();?>usuarios/reg" method="POST"> 
  Nombre: <input type="text" name="name" required/> <br><br>
  Usuario: <input type="text" name="username" required/> <br><br>
  Correo: <input type="email" name="email" required/> <br><br>
  Contraseña: <input type="password" name="password" required/> <br><br>
  Repite la contraseña: <input type="password" name="password2" required/> <br><br>
  <select class="input_login" name="role" required>
     <option selected disabled>Seleccionar rol</option>
      <option value="Profesor">Profesor</option>
      <option value="Alumno">Alumno</option>
  </select><br><br>
  <input class="boton-el" type="submit" value="Registrarse"/>  <br>
  </aside>
</form>


<br>
<!-- Editar usuario -->
<!-- 
<b><h1 class="title2">Editar usuario</h1></b>

<aside class="aside">
<form action="<?= root();?>panel/updateCurso" method="POST"> 

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
<br><br>
  Nombre curso <input type="text" name="nametask" /> <br><br>
  
  <input type="submit" value="Modificar curso"/>  <br>
      </aside>
</form>

<br> -->

<!-- Eliminar usuario -->

<b><h1 class="title2">Eliminar usuario</h1></b>

<aside class="aside">
<form action="<?= root();?>usuarios/deleteUsuario" method="POST"> 

<select name="codigo_usuario">
    <option selected disabled>Seleccionar usuario</option>
    <?php
        //Vamos a preparar la sentencia para que salgan en el seleccionador los usuarios creados.
        $db=Registry::get('database');
        $sql ="SELECT * FROM usuarios";
        $stmt = $db->query($sql);
        $stmt->execute();
        $request = $stmt->fetchAll();
        foreach($request as $valores){
          
            echo "<option name='codigo_usuario' value=".$valores['username'].">".$valores['name']."</option>";
          
        } 
    ?>
  </select>
<br><br>
  
  <input class="boton-el" type="submit" value="Eliminar usuario"/>  <br>
      </aside>
</form>

<br>

<!-- Asignar alumno a curso -->

<b><h1 class="title2">Asignar alumno a curso</h1></b>

<aside class="aside">
<form action="<?= root();?>usuarios/asignarAlumno" method="POST"> 

<select name="codigo_alumno">
    <option selected disabled>Seleccionar alumno</option>
    <?php
        //Vamos a preparar la sentencia para que salgan en el seleccionador los alumnos creados.
        $db=Registry::get('database');
        $sql ="SELECT * FROM estudiantes";
        $stmt = $db->query($sql);
        $stmt->execute();
        $request = $stmt->fetchAll();
        foreach($request as $valores){
          
            echo "<option name='codigo_alumno' value='".$valores['id_estudiante']."'>".$valores['id_estudiante']."</option>";
          
        } 
    ?>
  </select>


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
          
            echo "<option name='codigo_curso' value='".$valores['codigo_curso']."'>".$valores['nombre_curso']."</option>";
          
        } 
    ?>
  </select>
<br><br>
  
  <input class="boton-el" type="submit" value="Asignar"/>  <br>
      </aside>
</form>

<br>

<!-- Asignar profesor a asignatura -->

<b><h1 class="title2">Asignar profesor a asignatura</h1></b>

<aside class="aside">
<form action="<?= root();?>usuarios/asignarProfe" method="POST"> 

<select name="codigo_profesor">
    <option selected disabled>Seleccionar profesor</option>
    <?php
        //Vamos a preparar la sentencia para que salgan en el seleccionador los profesores creados.
        $db=Registry::get('database');
        $sql ="SELECT * FROM profesores";
        $stmt = $db->query($sql);
        $stmt->execute();
        $request = $stmt->fetchAll();
        foreach($request as $valores){
          
            echo "<option name='codigo_profesor' value=".$valores['id_profesor'].">".$valores['id_usuario']."</option>";
          
        } 
    ?>
  </select>


<select name="codigo_materia">
    <option selected disabled>Seleccionar asignatura</option>
    <?php
        //Vamos a preparar la sentencia para que salgan en el seleccionador los asignaturas creados.
        $db=Registry::get('database');
        $sql ="SELECT * FROM asignaturas";
        $stmt = $db->query($sql);
        $stmt->execute();
        $request = $stmt->fetchAll();
        foreach($request as $valores){
          
            echo "<option name='codigo_materia' value=".$valores['nombre_asignatura'].">".$valores['nombre_asignatura']."</option>";
          
        } 
    ?>
  </select>
<br><br>
  
  <input class="boton-el" type="submit" value="Asignar"/>  <br>
      </aside>
</form>


<br><br><br>
<?php require('partials/footer.php'); ?>
