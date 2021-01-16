<?php

abstract class Controller
{
    public function __construct()
    {
        foreach (glob("../../core/*.php") as $filename) {
            require_once $filename;
        }

        foreach (glob("../../util/*.php") as $filename) {
            require_once $filename;
        }

        foreach (glob("../../model/*.php") as $filename) {
            require_once $filename;
        }

        foreach (glob("../../view/*.php") as $filename) {
            require_once $filename;
        }
    }

    public final function resolveHttpRequest()
    {
        if (!isset($_GET['action'])) {
            $_GET['action'] = "default";
        }

        $method = $_SERVER['REQUEST_METHOD'];
        $action = $_GET['action'];

        unset($_GET['action']);

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