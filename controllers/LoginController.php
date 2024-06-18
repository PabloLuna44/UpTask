<?php    


namespace Controllers;

use Classes\Email;
use Model\User;
use MVC\Router;

class LoginController{

    //method to login page
    public static function login(Router $router){
        
        if($_SERVER['REQUEST_METHOD']==='POST'){

        }


        //Render View
        return $router->render('auth/login',[
            'title' => 'Login'
        ]);
    }

    //method to logout page 
    public static function logout(){

        echo "Desde Login";

    }

    //method to create account
    public static function create(Router $router){
        
        $user=new User;

        
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $user->sincronizar($_POST);
            $alerts= $user->validationNewAccount();
            
            

            if(empty($alertas)){
                $validateUser=User::where('email',$user->email);

                if($validateUser){
                    User::setAlerta('error','User already has been registered');
                    $alerts=User::getAlertas();
                }else{
                    $user->hashPassword();
                    unset($user->verifyPassword);

                    $user->generateToken();

                        //Enviar el Email
                        $email = new Email($user->email, $user->name, $user->token);
                        $email->SendConfirmation();

                    $result=$user->guardar();
                    if($result){
                        header('Location:/message');
                    }
                }
            }
            

        }

         //Render View
         return $router->render('auth/create',[
            'title' => 'Create',
            'user'=>'user',
            'alerts'=>$alerts
        ]);
    }

    //Method to recover password if a user forgot password
    public static function forgot(Router $router){
        

        if($_SERVER['REQUEST_METHOD']==='POST'){

        }

        return $router->render('auth/forgot',[
           'title'=>'Forgot Password'
            
        ]);

    }

    //Method to recover password
    public static function recover(Router $router){
        

        
        if($_SERVER['REQUEST_METHOD']==='POST'){

        }

        return $router->render('auth/recover',[

            'title'=>'Recover Password'
        ]);
    }

    //Method to send a message to verify account
    public static function message(Router $router){

        return $router->render('auth/message',[
            'title'=>'Message Recover'
        ]);
        
    }

    //Method to verify account
    public static function verify(Router $router){


        $user=User::where('token',$_GET['token']);
        if(empty($user)){
                //Mostrar mensaje de errore
                User::setAlerta('error', 'Token No valido');
        }else{
            
        $user->confirm='1';
        $user->token=null;
        $user->guardar();
        User::setAlerta('sucess', 'Cuenta confirmada correctamente');

        }



        return $router->render('auth/verify',[

            'title'=>'Verify Account',
            'alerts'=>User::getAlertas()
        ]);
        
    }
}






?>