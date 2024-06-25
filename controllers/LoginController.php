<?php


namespace Controllers;

use Classes\Email;
use Model\User;
use MVC\Router;

class LoginController
{

    //method to login page
    public static function login(Router $router)
    {
        $alerts = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $auth = new User($_POST);
            $auth->validationLogin();
            $alerts = $auth->getAlertas();

            if (empty($alertas)) {
                $user = User::where('email', $auth->email);
                if ($user and $user->confirm) {
                    if (password_verify($auth->password, $user->password)) {
                        $auth = $user;
                        session_start();
                        $_SESSION['id'] = $auth->id;
                        $_SESSION['user'] = $auth->email;
                        $_SESSION['name'] = $auth->name;
                        $_SESSION['login'] = true;

                        header('Location:/dashboard');
                        
                    } else {
                        User::setAlerta('error', 'Password Incorrect or Email Incorrect');
                        $alerts = User::getAlertas();
                    }
                } else {
                    User::setAlerta('error', 'User not found or User not confirmed');
                    $alerts = User::getAlertas();
                }
            }
        }
        //Render View
        $alerts = User::getAlertas();
        return $router->render('auth/login', [
            'title' => 'Login',
            'alerts' => $alerts
        ]);
    }


    //method to logout page 
    public static function logout(Router $router)
    {
        
        session_start();
        $_SESSION = [];
        
        header('Location:/');
    }

    //method to create account
    public static function create(Router $router)
    {

        $user = new User;


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user->sincronizar($_POST);
            $alerts = $user->validationNewAccount();



            if (empty($alertas)) {
                $validateUser = User::where('email', $user->email);

                if ($validateUser) {
                    User::setAlerta('error', 'User already has been registered');
                    $alerts = User::getAlertas();
                } else {
                    $user->hashPassword();
                    unset($user->verifyPassword);

                    $user->generateToken();

                    //Enviar el Email
                    $email = new Email($user->email, $user->name, $user->token);
                    $email->SendConfirmation();

                    $result = $user->guardar();
                    if ($result) {
                        header('Location:/message');
                    }
                }
            }
        }

        //Render View
        return $router->render('auth/create', [
            'title' => 'Create',
            'user' => 'user',
            'alerts' => $alerts
        ]);
    }

    //Method to recover password if a user forgot password
    public static function forgot(Router $router)
    {
        $alerts = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $user = new User($_POST);
            $alerts = $user->validationEmail();

            if (empty($alerts)) {
                $user = User::where('email', $user->email);

                if ($user and $user->confirm) {

                    $user->generateToken();
                    $user->guardar();

                    //Enviar el Email
                    $email = new Email($user->email, $user->name, $user->token);
                    $email->recoverPassword();



                    User::setAlerta('sucess', 'Email sent successfully');
                } else {
                    User::setAlerta('error', 'User not found or User not confirmed');
                }
            }
        }
        $alerts = User::getAlertas();
        return $router->render('auth/forgot', [
            'title' => 'Forgot Password',
            'alerts' => $alerts

        ]);
    }

    //Method to recover password
    public static function recover(Router $router)
    {

        $token = $_GET['token'];
        if (!$token) {
            header('Location:/');
        }
        $user = User::where('token', $token);
        $alerts = [];

        if (empty($user)) {
            User::setAlerta('error', 'Token No valido');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $password = new User($_POST);
            $password->validationPassword();
            $alerts = $password->getAlertas();

            if (empty($alerts)) {
                $user->sincronizar($_POST);
                $user->hashPassword();
                $user->token = null;
                $user->guardar();

                header('Location:/');
            }
        }

        $alerts = User::getAlertas();

        return $router->render('auth/recover', [

            'title' => 'Recover Password',
            'alerts' => $alerts
        ]);
    }

    //Method to send a message to verify account
    public static function message(Router $router)
    {

        return $router->render('auth/message', [
            'title' => 'Message Recover'
        ]);
    }

    //Method to verify account
    public static function verify(Router $router)
    {

        $token = $_GET['token'];

        if (!$token) {
            header('Location:/');
        }

        $user = User::where('token', $token);

        if (empty($user)) {
            //Mostrar mensaje de errore
            User::setAlerta('error', ' Not Valid Token');
        } else {

            $user->confirm = '1';
            $user->token = null;
            unset($user->verifyPassword);
            $user->guardar();

            User::setAlerta('sucess', 'Account COnfirm Successfully');
        }



        return $router->render('auth/verify', [

            'title' => 'Verify Account',
            'alerts' => User::getAlertas()
        ]);
    }
}
