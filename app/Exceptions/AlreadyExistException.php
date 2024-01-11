<?php

namespace App\Exceptions;

use Exception;

class AlreadyExistException extends Exception
{
    public function render()
    {

        $response['message'] = $this->getMessage();

        return errorResponse($response, 400);
    }
}
