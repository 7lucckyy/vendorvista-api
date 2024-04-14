<?php

namespace App\Exceptions;

use Exception;

class UnAuthorizedException extends Exception
{
    public function render()
    {
        $response['message'] = $this->getMessage();

        return errorResponse($response, 403);
    }
}
