<?php
require_once "Controller.php";

class UserController extends Controller
{
    protected function default()
    {
        echo 'Homepage<br>';
        echo '<a href="UserController.php?action=getProfile&id=1">Profile id 1</a> <br>';
        echo '<a href="UserController.php?action=getRegister">Register</a>';
    }

    protected function getProfile(array $args)
    {
        $id = $args['id'];
        $user = User::getById($id);
        echo "User ID: " . $user->getId() . ' - Name: ' . $user->getFirstName() . ' ' . $user->getLastName();
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
            echo "Done";
        }
    }
}

$controller = new UserController();
$controller->resolveHttpRequest();