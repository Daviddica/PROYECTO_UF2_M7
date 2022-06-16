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
    <h1 class="title3">Administrar cursos</h1>

</header>
<!-- Crear curso -->

<b><h1 class="title2">Crear curso</h1></b>

<aside class="aside">
<form action="<?= root();?>cursos/curso" method="POST"> 
  Nombre curso <input type="text" name="nametask" required /> <br><br>
  
  <input class="boton-el"  type="submit" value="Crear curso"/>  <br>
      </aside>
</form>

<br>
<!-- Editar curso -->

<b><h1 class="title2">Editar curso</h1></b>

<aside class="aside">
<form action="<?= root();?>cursos/updateCurso" method="POST"> 

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
  Nombre curso <input type="text" name="nametask" required /> <br><br>
  
  <input class="boton-el"  type="submit" value="Modificar curso"/>  <br>
      </aside>
</form>

<br>

<!-- Eliminar curso -->

<b><h1 class="title2">Eliminar curso</h1></b>

<aside class="aside">
<form action="<?= root();?>cursos/deleteCurso" method="POST"> 

<select name="codigo_curso2">
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
  
  <input class="boton-el" type="submit" value="Eliminar curso"/>  <br>
      </aside>
</form>


<br><br><br>
<?php require('partials/footer.php'); ?>
