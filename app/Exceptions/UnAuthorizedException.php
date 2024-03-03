<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;

class UnAuthorizedException extends Exception
{
    public function render()
    {
        $response['message'] = $this->getMessage();

        return errorResponse($response, 403);
    }
}
