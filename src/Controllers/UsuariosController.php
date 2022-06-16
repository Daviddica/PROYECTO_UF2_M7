<?php

    namespace App\Controllers;

    use App\Controller;
    use App\Registry;
    use App\Request;
    use App\Session;
    use App\Database\Connection;

class UsuariosController extends Controller {

    public function __construct(Request $request,Session $session){
        parent::__construct($request,$session);
    } 
    
    public function index()
    {
        return view('usuarios');
    }
   
    public function reg(){
        try{
            $name= filter_input(INPUT_POST,'name');
            $username= filter_input(INPUT_POST,'username');
            $email= filter_input(INPUT_POST,'email');
            $password= filter_input(INPUT_POST,'password');
            $password2= filter_input(INPUT_POST,'password2');
            $role= filter_input(INPUT_POST,'role');
            
            //si las dos password son iguales
            //encriptar contraseña
            if($password==$password2){
                
                //si hay algún campo vacío que nos redirija a register
                if (empty($name) || empty($username) || empty($email) || empty($password) || empty($password2) || empty($role)){
                    echo "Te faltan campos por rellenar."; 
                } else {

                    $hash = password_hash($password,PASSWORD_BCRYPT);
                    $sql="INSERT INTO usuarios(name, username, email, password, rol) VALUES(?,?,?,?,?)";
                    
                    $bbdd=Registry::get('database');
                    $stmt = $bbdd->query($sql);
                    $stmt->execute([$name,$username,$email,$hash,$role]);
                    
                    
                    if($role=='Alumno'){
                        $sql="INSERT INTO estudiantes(id_estudiante,codigo_curso) VALUES(?,?)";
                        $bbdd=Registry::get('database');
                        $stmt = $bbdd->query($sql);
                        $stmt->execute([$username,null]);
                    }

                    if($role=='Profesor'){
                        $sql="INSERT INTO profesores(id_profesor,id_usuario) VALUES(?,?)";
                        $bbdd=Registry::get('database');
                        $stmt = $bbdd->query($sql);

                        $stmt->execute([$username,$username]);
                    }
                    $this->redirectTo('usuarios');
                   
                }
               
            } else {
                echo "Las contraseñas no coinciden."; 
                
            }


        
       }catch(\Exception $e){
           die($e->getMessage());
       }       
    }

    public function deleteUsuario()
    {

        $usuario= filter_input(INPUT_POST, "codigo_usuario");
        
        $db = Registry::get('database');
        
        $sql_curs="DELETE FROM estudiantes WHERE id_estudiante = '".$usuario."';";
        
        $sql_curs.= "DELETE FROM usuarios WHERE username= '".$usuario."';";
        $stmt_curs = $db->query($sql_curs);
        $stmt_curs->execute();

        $this->redirectTo('usuarios');
    }


    public function asignarAlumno()
    {

        $codigo_curso= filter_input(INPUT_POST, "codigo_curso");
        $codigo_alumno= filter_input(INPUT_POST, "codigo_alumno");

        $db = Registry::get('database');
        
        $sql_curs="UPDATE estudiantes SET codigo_curso='$codigo_curso' WHERE id_estudiante ='$codigo_alumno'";
        
        $stmt_curs = $db->query($sql_curs);
        $stmt_curs->execute();

        $this->redirectTo('usuarios');
    }

    public function asignarProfe()
    {

        $codigo_materia= filter_input(INPUT_POST, "codigo_materia");
        $codigo_profesor= filter_input(INPUT_POST, "codigo_profesor");


        $db = Registry::get('database');
        
        $sql_curs="UPDATE asignaturas SET id_profesor='$codigo_profesor' WHERE nombre_asignatura ='$codigo_materia'";
        
        $stmt_curs = $db->query($sql_curs);
        $stmt_curs->execute();

        $this->redirectTo('usuarios');
    }


}