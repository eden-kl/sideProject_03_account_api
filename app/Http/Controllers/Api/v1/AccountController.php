<?php

namespace App\Http\Controllers\Api\v1;

use App\Formatters\Formatter;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class AccountController extends Controller
{
    protected Formatter $formatter;
    public function __construct(Formatter $formatter)
    {
        $this->formatter = $formatter;
    }

    /**
     * @return JsonResponse
     */
    public function getList(): JsonResponse
    {
        return $this->formatter->formatResponse([
            'status' => '0000',
            'description' => 'allow',
        ]);
    }
}
