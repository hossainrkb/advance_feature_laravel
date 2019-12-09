<?php

namespace App\Exceptions;

use Exception;

class FileExistException extends Exception
{
    protected $message = "File not found";
}
