<?php

    namespace App\Controllers;

    use App\Controller;
    use App\Registry;
    use App\Request;
    use App\Session;
    use App\Database\Connection;

    if(!isset($_SESSION)){session_start();} 

class ListController extends Controller {

    public function __construct(Request $request,Session $session){
        parent::__construct($request,$session);
    } 
    
    public function index()
    {

        return view('list');
    }


    public function createList(){
        $namelist= filter_input(INPUT_POST,'namelist');
        $user_id=$_SESSION["username"];
        if (empty($namelist)==false){

            $bbdd=Registry::get('database');
            $sql="INSERT INTO listas(namelist,user_id) VALUES(?,?)";
            $stmt = $bbdd->query($sql);
            $stmt->execute([$namelist,$user_id]);

            echo "Lista Creada.";
        } else {
            echo "Falta rellenar el campo.";
        }
        

    }
}