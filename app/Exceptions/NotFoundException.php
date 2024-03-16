<?php

namespace App\Exceptions;

use Exception;

class NotFoundException extends Exception
{
    public function render()
    {
        $response['message'] = $this->getMessage();

        return errorResponse($response, 404);
    }
}
