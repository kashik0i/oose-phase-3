<?php
require_once "../../core/Controller.php";

class UserController extends Controller
{
    protected function default()
    {
        echo 'Homepage<br>';
        echo '<a href="./UserController.php?action=getProfile&id=1">Profile id 1</a>';
    }

    protected function getProfile(array $args)
    {
        echo "Profile<hr>";

        var_dump(User::getAll("first_name", "mohamed"));

//        $id = $args['id'];

//        $user = User::getById($id);
//        $user = User::get("id", 1);
//        echo "User ID: " . $user->getId() . ' - Name: ' . $user->getFirstName() . ' ' . $user->getLastName();
    }
}

$controller = new UserController();
$controller->resolveHttpRequest();