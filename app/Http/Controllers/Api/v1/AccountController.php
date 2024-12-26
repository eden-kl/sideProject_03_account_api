<?php

namespace App\Http\Controllers\Api\v1;

use App\Exceptions\AccountException;
use App\Exceptions\HttpRequestCustomException;
use App\Formatters\Formatter;
use App\Http\Controllers\Controller;
use App\Services\AccountService;
use App\Validations\HttpRequestValidation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    protected Formatter $formatter;
    protected AccountService $accountService;

    /**
     * @param Formatter $formatter
     * @param AccountService $accountService
     */
    public function __construct(Formatter $formatter, AccountService $accountService)
    {
        $this->formatter = $formatter;
        $this->accountService = $accountService;
    }

    /**
     * @return JsonResponse
     */
    public function getList(): JsonResponse
    {
        $response = $this->accountService->getAll();
        return $this->formatter->formatResponse($response);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws AccountException
     * @throws HttpRequestCustomException
     */
    public function createAccount(Request $request): JsonResponse
    {
        HttpRequestValidation::checkRequest($request, config('validation_rules.account'));
        $requestBody = [
            'account' => $request->input('data.account'),
            'password' => $request->input('data.password'),
        ];
        $response = $this->accountService->createAccount($requestBody);
        return $this->formatter->formatResponse($response);
    }
}
