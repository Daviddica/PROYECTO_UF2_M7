<?php

    namespace App\Controllers;

    use App\Controller;
    use App\Registry;
    use App\Request;
    use App\Session;
    use App\Database\Connection;

class TaskController extends Controller {

    public function __construct(Request $request,Session $session){
        parent::__construct($request,$session);
    } 
    
    public function index()
    {
        return view('task');
    }


    public function createTask(){
        $nametask= filter_input(INPUT_POST,'nametask');
        $descriptiontask= filter_input(INPUT_POST,'descriptiontask');
        $id_user=$_SESSION["username"];
        $id_list=filter_input(INPUT_POST,'id_list');
        if (empty($nametask)==false || empty($descriptiontask)==false){
            $sql="INSERT INTO tareas(nametask,descriptiontask,id_list,id_user) VALUES(?,?,?,?)";
            $bbdd=Registry::get('database');
            $stmt = $bbdd->query($sql);
            $stmt->execute([$nametask,$descriptiontask,$id_list,$id_user]);
            echo "Tarea añadida correctamente."; 
        } else {
            echo "Falta rellenar el campo."; 

        }
    }

    public function deleteTask()
    {
        $task= filter_input(INPUT_POST, "id_tarea");
        
        $db = Registry::get('database');

        $sql_curs="DELETE FROM tareas WHERE id = ?";
        
        $stmt_curs = $db->query($sql_curs);
        $stmt_curs->execute([$task]);

        $this->redirectTo('dashboard');
    }
}