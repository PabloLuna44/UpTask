<?php    


namespace Controllers;
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