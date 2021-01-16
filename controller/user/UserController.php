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

        $id = $args['id'];

        $user = User::getById($id);
        echo $user->getFirstName();
    }
}

$controller = new UserController();
$controller->resolveHttpRequest();