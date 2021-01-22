<?php

abstract class Controller
{
    public static string $APP_TITLE = "Charity";

    public function __construct()
    {
        session_start();

        require_once "../model/Model.php";
        require_once "../view/View.php";

        foreach (glob("../util/*.php") as $filename) {
            require_once $filename;
        }

        foreach (glob("../model/*.php") as $filename) {
            require_once $filename;
        }

        foreach (glob("../view/*.php") as $filename) {
            require_once $filename;
        }
        foreach (glob("../view/user/*.php") as $filename) {
            require_once $filename;
        }
    }

    public final function resolveHttpRequest()
    {
        if (!isset($_GET['action'])) {
            $_GET['action'] = "default";
        }

        $action = $_GET['action'];
        unset($_GET['action']);

        $method = $_SERVER['REQUEST_METHOD'];
        switch ($method) {
            case "GET":
                $this->executeAction($action, $_GET);
                break;
            case "POST":
                $params = array_merge($_GET, $_POST);
                $this->executeAction($action, $params);
                break;
            default:
                throw new RuntimeException("Unsupported request method: " . $method);
        }
    }

    private final function executeAction(string $methodName, $args)
    {
        try {
            if (method_exists($this, $methodName)) {
                // need to guard function against bad arguments
                $this->{$methodName}($args);
            } else {

                // catching Throwable method doesn't exist
                echo 'Method "' . $methodName . '" does not exist';

            }
        } catch (Exception $e) {
            echo $e->getTraceAsString() . "\n" . $e->getMessage();
        }

    }
}