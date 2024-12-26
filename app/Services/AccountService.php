<?php
/**
 * Account Service
 *
 * @version 0.1.1
 * @author eden.chen eden.chen@kkday.com
 * @date 2024/12/25
 * @since 0.1.0 2024/12/25 eden.chen: 新建立AccountService class
 * @since 0.1.1 2024/12/25 eden.chen: 新增建立帳號createAccount
 */

namespace App\Services;

use App\Enums\StatusCode;
use App\Exceptions\AccountException;
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
            'status' => StatusCode::allSuccess->value,
            'data' => $this->accountRepository->all(),
        ];
    }

    /**
     * @param array $data
     * @return array
     * @throws AccountException
     */
    public function createAccount(array $data): array
    {
        $account = $this->accountRepository->find($data['account']);
        if ($account !== []) {
            throw AccountException::requestFailed('此帳號已存在。');
        }
        $this->accountRepository->create($data);
        return [
            'status' => StatusCode::allSuccess->value,
            'message' => 'Account:[' . $data['account'] . '] 已建立。',
        ];
    }
}
