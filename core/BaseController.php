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
        catch (Throwable $t)
        {
            echo $t->getTraceAsString()."\n".$t->getMessage();
        }

    }
}