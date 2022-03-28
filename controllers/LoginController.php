<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController
{
    public static function login(Router $router)
    {
        $alertas = [];
        $auth = new Usuario();
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $auth = new Usuario($_POST);

            $alertas =   $auth->validarLogin();

            if (empty($alertas)) {
                /* Comprobar que exista el usuario */
                $usuario = Usuario::where('email', $auth->email);
                if ($usuario) {
                    /* Verificar password */
                    if ($usuario->checkPasswordAndVerifycation($auth->password)) {
                        /* Autenticar al usuario */
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        /* Redireccionamiento */


                        if ($usuario->admin === '1') {
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location: /admin');
                        } else {
                            header('Location: /cita');
                        }
                    }
                } else {
                    Usuario::setAlerta('error', 'Usuario no encontrado o contraseña incorrecta');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/login', [
            'alertas' => $alertas,
            'auth' => $auth
        ]);
    }
    public static function logout()
    {
        $_SESSION = '';
        header('Location: /');
    }

    public static function olvide(Router $router)
    {
        $alertas = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $auth = new Usuario($_POST);

            $alertas = $auth->validarEmail();

            if (empty($alertas)) {
                $usuario = Usuario::where('email', $auth->email);

                if ($usuario && $usuario->confirmado === "1") {

                    /* Generar un token */
                    $usuario->crearToken();
                    $usuario->guardar();
                    /* TODO: Enviar el email */
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();
                    /* Alertas de éxito */
                    Usuario::setAlerta('exito', "Revisa tu email");
                } else {
                    Usuario::setAlerta('error', "Usuario no existe o no esta confirmado");
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/olvide-password', ['alertas' => $alertas]);
    }
    public static function recuperar(Router $router)
    {
        $alertas = [];
        $error = false;

        $token = s($_GET['token']);

        /* Buscar usuario por su token */
        $usuario = Usuario::where('token', $token);

        if (empty($usuario)) {
            Usuario::setAlerta('error', "Token no válido");
            $error = true;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            /* Leer el nuevo password y guardarlo */
            $password = new Usuario($_POST);
            $alertas = $password->validarPassword();

            if (empty($alertas)) {
                $usuario->password = null;

                $usuario->password = $password->password;
                $usuario->hashPassword();
                $usuario->token = null;

                $resultado = $usuario->guardar();

                if ($resultado) {
                    header('Location: /');
                }
            }
        }


        $alertas = Usuario::getAlertas();

        $router->render('auth/recuperar-password', ['alertas' => $alertas, 'error' => $error]);
    }
    public static function crear(Router $router)
    {
        $usuario = new Usuario();

        /* Alertas vacias */

        $alertas = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();
            /* Revisar que alertas esté vacío */

            if (empty($alertas)) {
                /* Verificar que el usuario no esté registrado */
                $resultado = $usuario->existeUsuario();
                if ($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                } else {
                    /* No esta registrado */

                    /* Hasheamos password */
                    $usuario->hashPassword();

                    /* Generar un token unico */

                    $usuario->crearToken();

                    /* Enviar el email */
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);

                    $email->enviarConfirmacion();

                    /* Crear el usuario */
                    $resultado = $usuario->guardar();

                    if ($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
        }

        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router)
    {
        $router->render('auth/mensaje');
    }

    public static function confirmar(Router $router)
    {
        $alertas = [];
        $token = s($_GET['token']);
        $usuario = Usuario::where('token', $token);

        if (empty($usuario)) {
            /* mostrar mensaje de error */
            Usuario::setAlerta('error', "El token no es válido");
        } else {
            /* Modificar usuario confirmado */
            $usuario->confirmado = "1";
            $usuario->token = null;
            $usuario->guardar();
            Usuario::setAlerta('exito', "El usuario ha sido confirmado");
        }
        /* Obtener alertas */
        $alertas = Usuario::getAlertas();

        /* Renderizar la vista */
        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);
    }
}
