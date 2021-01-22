<?php

class HomeView extends View
{
    protected function getTitle(): string
    {
        return "Home";
    }

    protected function getContent(): string
    {
        return "Homepage";
    }
}