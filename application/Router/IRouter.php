<?php
namespace App\Router;

use Klein\Klein;

interface IRouter
{

    /**
     * @param Klein $klein
     */
    function create(Klein $klein);

}