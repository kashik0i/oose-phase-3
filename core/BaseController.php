<?php

abstract class BaseController
{

    public function getAction(string $methodName,$args)
    {
        try
        {
            if(method_exists($this,$methodName))
            {
                // need to guard function against bad arguments
                $this->{$methodName}($args);
            }
            else
            {
                // catching Throwable method doesn't exist
            }
        }
        catch (Exception $e)
        {
            echo $e->getTraceAsString()."\n".$e->getMessage();
        }

    }
}