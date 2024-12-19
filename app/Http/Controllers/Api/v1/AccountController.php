<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    /**
     * @return array
     */
    public function getList(): array
    {
        return [
            'status' => 200,
            'message' => 'request allow',
        ];
    }
}
