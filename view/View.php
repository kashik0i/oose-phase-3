<?php

abstract class View
{
    protected abstract function getTitle(): string;

    protected abstract function getContent(): string;

    public function display(): void
    {
        echo $this->getHeader();
        echo $this->getContent();
        echo $this->getFooter();
    }

    private function getHeader(): string
    {
        if (isset($_SESSION['user'])) {

            $user = unserialize($_SESSION['user']);

            $navbar_links_right = '<div class="nav-item btn-group">
    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown"
            aria-expanded="false">
        ' . $user->getFirstName() . ' ' . $user->getLastName() . '
    </button>
    <ul class="dropdown-menu dropdown-menu-end">
        <li><a href="UserController.php?action=getProfile&id=' . $user->getId() . '" class="dropdown-item">Profile</a></li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li><a href="UserController.php?action=getLogout" class="dropdown-item">Logout</a></li>
    </ul>
</div>';

        } else {

            $navbar_links_right = '<a href="UserController.php?action=getLogin" class="nav-item btn btn-sm btn-outline-primary me-1" type="submit">Login</a>
                <a href="UserController.php?action=getRegister" class="nav-item btn btn-sm btn-outline-success">Register</a>';

        }

        return '<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>' . Controller::$APP_TITLE . ' | ' . $this->getTitle() . '</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="UserController.php">' . Controller::$APP_TITLE . '</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="UserController.php">Home</a>
                </li>
            </ul>
            <div class="d-flex">
                ' . $navbar_links_right . '
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid">
      ';
    }

    private function getFooter(): string
    {
        return ' <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
    </div>
  </body>
</html>';
    }
}