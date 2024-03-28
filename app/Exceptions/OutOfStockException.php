<?php

namespace App\Exceptions;

use Exception;

class OutOfStockException extends Exception
{
    public function render()
    {
        $response['message'] = $this->getMessage();

        return errorResponse($response, 404);
    }
}
