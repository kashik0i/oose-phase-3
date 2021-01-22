<?php
require_once "Controller.php";

class UserController extends Controller
{
    protected function default()
    {
        $view = new HomeView();
        $view->display();
    }

    protected function getProfile(array $args)
    {
        $id = $args['id'];
        $user = User::getById($id);

        if (isset($user)) {

            $view = new ProfileView($user);
            $view->display();

        } else {

            echo "User not found";

        }
    }

    protected function getLogin()
    {
        $view = new LoginView();
        $view->display();
    }

    protected function postLogin(array $args)
    {
        $errors = Model::validateExistence($args, ['email', 'password']);
        if (sizeof($errors) > 0) {

            var_dump($errors);

        } else {

            $email = $args['email'];
            $password = $args['password'];

            $user = User::get("email", $email);
            if (isset($user)) {

                if ($user->getPassword() === $password) {

                    $_SESSION['user'] = serialize($user);
                    header('Location: UserController.php');

                } else {

                    echo "Incorrect password";

                }

            } else {

                echo "E-Mail not found";

            }
        }
    }

    protected function getLogout()
    {
        session_destroy();
        session_start();
        header('Location: UserController.php');
    }

    protected function getRegister()
    {
        $view = new RegisterView();
        $view->display();
    }

    protected function postRegister(array $args)
    {
        $errors = User::validate($args);
        if (sizeof($errors) > 0) {

            var_dump($errors);

        } else {

            unset($args['confirm_password']);
            $user = User::create($args);

            var_dump($user);
        }
    }
}

$controller = new UserController();
$controller->resolveHttpRequest();