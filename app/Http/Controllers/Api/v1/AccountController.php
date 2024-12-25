<?php

namespace App\Http\Controllers\Api\v1;

use App\Formatters\Formatter;
use App\Formatters\Response\StatusMessage;
use App\Http\Controllers\Controller;
use App\Services\AccountService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function createAccount(Request $request): JsonResponse
    {
        $validations = $this->checkRequest($request);
        if ($validations) {
            $description = implode(',', $validations);
            return $this->formatter->formatResponse(['status' => StatusMessage::CODE_PARAMETER_ERROR, 'description' => $description]);
        }
        return $this->formatter->formatResponse([]);
    }

    private function checkRequest(Request $request): array
    {
        $description = [];
        $validation = Validator::make($request->all(), [
            'data.account' => 'required',
            'data.password' => 'required',
        ],
        [
            'data.account.required' => 'account:帳號為必填',
            'data.password.required' => 'password:密碼為必填',
        ]);
        if ($validation->fails()) {
            $errors = $validation->errors();
            foreach ($errors->all() as $message) {
                $description[] = $message;
            }
        }
        return $description;
    }
}
