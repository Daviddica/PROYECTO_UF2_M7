<?php

    namespace App\Controllers;

    use App\Controller;
    use App\Registry;
    use App\Request;
    use App\Session;
    use App\Database\Connection;

class CursosController extends Controller {

    public function __construct(Request $request,Session $session){
        parent::__construct($request,$session);
    } 
    
    public function index()
    {
        return view('cursos');
    }
   
    public function curso()
    {
        $db = Registry::get('database');

        $nombrecurso = filter_input(INPUT_POST, "nametask");

        $sql_curs = "INSERT INTO cursos (nombre_curso) VALUES ('".$nombrecurso."');";
        $stmt_curs = $db->query($sql_curs);
        $stmt_curs->execute();

        $this->redirectTo('cursos');
    }

    public function updateCurso()
    {
        $db = Registry::get('database');

        $nombrecurso = filter_input(INPUT_POST, "nametask");
        $curso = filter_input(INPUT_POST, "codigo_curso");

        $sql_curs = "UPDATE cursos SET nombre_curso = '$nombrecurso' WHERE codigo_curso = '$curso'";
        $stmt_curs = $db->query($sql_curs);
        $stmt_curs->execute();

        $this->redirectTo('cursos');
    }


    public function deleteCurso()
    {

        $curso = filter_input(INPUT_POST, "codigo_curso2");

        $db = Registry::get('database');

        $sql_curs = "DELETE FROM cursos WHERE codigo_curso = $curso";
        $stmt_curs = $db->query($sql_curs);
        $stmt_curs->execute();

        $this->redirectTo('cursos');
    }
}