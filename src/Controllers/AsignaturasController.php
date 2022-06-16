<?php

    namespace App\Controllers;

    use App\Controller;
    use App\Registry;
    use App\Request;
    use App\Session;
    use App\Database\Connection;

class AsignaturasController extends Controller {

    public function __construct(Request $request,Session $session){
        parent::__construct($request,$session);
    } 
    
    public function index()
    {
        return view('asignaturas');
    }
   
    public function asignatura()
    {
        $db = Registry::get('database');

        $nombreasignatura = filter_input(INPUT_POST, "nombre_asignatura");
        $curso = filter_input(INPUT_POST, "codigo_curso");
        $profesor = filter_input(INPUT_POST, "id_profesor");

        $sql_curs = "INSERT INTO asignaturas (nombre_asignatura, codigo_curso, id_profesor) VALUES (?,?,?);";
        $stmt_curs = $db->query($sql_curs);
        $stmt_curs->execute([$nombreasignatura, $curso, $profesor]);

        $this->redirectTo('asignaturas');
    }

    public function updateAsignatura()
    {
        $db = Registry::get('database');

        $nombreasignatura = filter_input(INPUT_POST, "nombre_asignatura");
        $asignatura = filter_input(INPUT_POST, "codigo_asignatura");

        $sql_curs = "UPDATE asignaturas SET nombre_asignatura = '$nombreasignatura' WHERE codigo_asignatura = $asignatura";
        $stmt_curs = $db->query($sql_curs);
        $stmt_curs->execute();

        $this->redirectTo('asignaturas');
    }

    public function deleteAsignatura()
    {

        $asignatura = filter_input(INPUT_POST, "codigo_asignatura2");
        
        $db = Registry::get('database');

        $sql_curs = "DELETE FROM asignaturas WHERE codigo_asignatura = $asignatura";
        $stmt_curs = $db->query($sql_curs);
        $stmt_curs->execute();

        $this->redirectTo('asignaturas');
    }

}