<?php
/**
 * Account Service
 *
 * @version 0.1.0
 * @author eden.chen eden.chen@kkday.com
 * @date 2024/12/25
 * @since 0.1.0 2024/12/25 eden.chen: 新建立AccountService class
 */

namespace App\Services;

use App\Formatters\Response\StatusMessage;
use App\Repositories\AccountRepository;

class AccountService
{
    private AccountRepository $accountRepository;

    /**
     * @param AccountRepository $accountRepository
     */
    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return [
            'status' => StatusMessage::CODE_ALL_SUCCESS,
            'data' => $this->accountRepository->all(),
        ];
    }
}
