<?php

abstract class Model
{
    public static abstract function getById(int $id): Model;

    public static abstract function getByAttr(string $attr, string $val): Model;
}