<?php require('partials/head.php'); use App\Registry; ?>

<br><br>

<header>
    <b><h1 class="title">SCHOOL</h1></b>

</header>

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

        .profesor{
            
        }

        .title{
            background-color: #16C2A5;
            color:white;
            width:100%;
            display:flex;
            font-size: 30px;
            justify-content:center;
            padding: 0px 0px 40px 0px;
        }

        .texto-menu{
            padding: 0px 20px 0px 20px;
            margin: 10px;
        }
        .aside{
            display: flex;
            width:100%;
            flex-direction:row;
            justify-content: space-around;
            align-self: center;
            background-color: #10D7B6;
            font-weight:bold; 
            padding:10px 0px 10px 0px;
        }
        a{
            text-decoration:none;
            color:white;
        }
        .tareas{
            padding: 10px 0px 10px 15px;
            background-color: #49eed2;
            border: 3px solid black;
            margin:10px;
        }
        .sesion{
            padding: 10px 0px 10px 15px;
            background-color: #49eed2;
            border: 3px solid black;
            margin:10px;
        }

        hr{
            background-color: black;
        }

    </style>

<?php
if ($_SESSION["role_login"] == 'Alumno' || $_SESSION["role_login"] == 'Profesor'){
?>
<aside class="aside">
<ul>    
        <li><a href="<?= root();?>/">Cerrar sesión</a></li>
        <li><a href="<?= root();?>list">Listas</a></li>
        <li><a href="<?= root();?>task">Tareas</a></li>

</ul>
</aside>
<?php
}else if ($_SESSION["role_login"] == 'Admin'){
    if(!isset($_SESSION)){session_start();} 
?>
<aside class="aside">
<ul>
        <li><a href="<?= root();?>/">Cerrar sesión</a></li>
        <li><a href="<?= root();?>usuarios">Usuarios</a></li>
        <li><a href="<?= root();?>asignaturas">Asignaturas</a></li>
        <li><a href="<?= root();?>cursos">Cursos</a></li>

</ul>
</aside>
<?php
}
?>
    <div class="general">
        <div class="sesion">
            <div class="caja2_home">
                <p>Bienvenido, <?php echo $_SESSION["name_login"]; echo "<br><br>";?></p> 
                <p>Usuario: <?php echo $_SESSION["username"];?></p> 
                <p>Email: <?php echo $_SESSION["email_login"];?></p> 
                <p>Rol de usuario: <?php echo $_SESSION["role_login"];?></p> 
            </div>
        </div><br>
        <div class="cajas_home2">
             
            <div class="tareas">
                <p><b>Tareas pendientes de:</b> <?php echo $_SESSION["username"]; echo "<br><br>";?></p>
                <?php 
                    $bbdd=Registry::get('database');
                    
                    $sql ="SELECT * from tareas WHERE id_user = ?;";
                    $stmt = $bbdd->query($sql);
                    $username = $_SESSION["username"];
                    $stmt->execute([$username ]);
                    $request = $stmt->fetchAll();
                    

                    $sql ="SELECT * from listas WHERE user_id = ?;";
                    $stmt = $bbdd->query($sql);
                    $username = $_SESSION["username"];
                    $stmt->execute([$username ]);
                    $request0 = $stmt->fetchAll();

    
                    foreach($request as $valores){
                        $taskname=$valores['nametask'];
                        $taskdescription=$valores['descriptiontask'];
                        $list_task=$valores['id_list'];
                        $idtarea=$valores['id'];
                        foreach($request0 as $valores0){
                            if ($valores0['id']==$list_task){
                                $list_name_task=$valores0['namelist'];
                            }
                        }

                        if (empty($taskname)==false && empty($taskdescription)==false){
                            echo "<p><b>Lista:</b> ".$list_name_task."<br>
                            <b>Tarea:</b> ".$taskname." <br>
                            <b>Descripcion: </b>".$taskdescription."</p><br>";
                        } else if (empty($taskname)==false && empty($taskdescription)==true) {
                            echo "<p><b>Lista:</b> ".$list_name_task."<br>
                            <b>Tarea:</b> ".$taskname."</p><br>";
                        } else {
                            echo "";
                        }
                        ?>
                        <form action="<?php root();?>task/deleteTask" method="POST">   
                        <input name="id_tarea" value= '<?php echo $idtarea ?>' hidden> 
                        <button class="boton-el" type="submit">Eliminar</button>  <br><br>
                        
                        </aside>
                        </form>
                    <?php 
                    }
                ?>

<br>

<!-- mostrar solo si es profesor -->

    <div class="profesor">
    <?php if($_SESSION["role_login"]=='Profesor'){

    echo "<h2> Alumnos:</h2>    <br>
    ";
    $bbdd=Registry::get('database');     
    $sql ="SELECT * from estudiantes;";
    $stmt = $bbdd->query($sql);
    $stmt->execute();
    $request = $stmt->fetchAll();

    foreach($request as $valores){
        $estudiante=$valores['id_estudiante'];
        $id_curso=$valores['codigo_curso'];

        echo "<p><b>Estudiante:</b> ".$estudiante."<br>
        <b>Codigo Curso:</b> ".$id_curso." <br><br>";
    }
} 
?>

<hr>
<br>
<!-- mostrar solo si es alumno -->

    <div class="alumno">
    <?php if($_SESSION["role_login"]=='Alumno'){

    echo "<h2> Profesores:</h2>    <br>
    ";
    $bbdd=Registry::get('database');     
    $sql ="SELECT * from profesores;";
    $stmt = $bbdd->query($sql);
    $stmt->execute();
    $request = $stmt->fetchAll();

    foreach($request as $valores){
        $profesor=$valores['id_profesor'];
        $id_curso=$valores['codigo_curso'];

        echo "<p><b>Profesor:</b> ".$profesor."<br>
        <b>Codigo Curso:</b> ".$id_curso." <br><br>";
    }
} 
?>

            </div>
        </div>
    </div>
    </div>
<br><br>
<?php require('partials/footer.php'); ?>
