<?php    


namespace Controllers;

use Model\Project;
use MVC\Router;

class DashboardController
{
    public static function index(Router $router)
    {

        session_start();

        isAuth();

        return $router->render('dashboard/index', [
            'title' => 'Projects',
        ]);
    }


    public static function create(Router $router)
    {
        session_start();
        isAuth();
        $alerts=[];


        if($_SERVER['REQUEST_METHOD']==='POST'){

            $project=new Project($_POST);

            $alerts=$project->validate();


            if(empty($alerts)){
                $project->user_id=$_SESSION['id'];
                $project->generateURL();


                $project->guardar();

                header('Location:/dashboard?url='.$project->url);
            }
            



        }



        return $router->render('dashboard/create-project', [
            'title' => 'New Project',
            'alerts'=>$alerts
        ]);

    }


    public static function profile(Router $router){
        session_start();
        isAuth();

        return $router->render('dashboard/profile', [
            'title' => 'Profile'
        ]);
    }
        
    
}




?>