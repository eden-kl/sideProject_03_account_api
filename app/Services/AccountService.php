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
use App\Validations\AccountValidation;

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
     * @param string $account
     * @return array
     * @throws AccountException
     */
    public function getOne(string $account):array
    {
        $response = $this->accountRepository->find($account);
        if ($response === null) {
            throw AccountException::notFound('查無此帳號。');
        }
        return [
            'status' => StatusCode::allSuccess->value,
            'data' => $response,
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
        if ($account !== null) {
            throw AccountException::requestFailed('此帳號已存在。');
        }
        $this->accountRepository->create($data);
        return [
            'status' => StatusCode::allSuccess->value,
            'message' => '帳號：[' . $data['account'] . '] 已建立。',
        ];
    }

    /**
     * @param string $account
     * @return array
     * @throws AccountException
     */
    public function deleteAccount(string $account): array
    {
        $response = $this->accountRepository->find($account);
        if ($response === null) {
            throw AccountException::notFound('查無此帳號。');
        }
        $this->accountRepository->delete($account);
        return [
            'status' => StatusCode::allSuccess->value,
            'message' => '帳號：[' . $account . '] 已成功刪除。',
        ];
    }

    /**
     * @param string $account
     * @param array $data
     * @return array
     * @throws AccountException
     */
    public function updateAccount(string $account, array $data): array
    {
        $response = $this->accountRepository->find($account);
        if ($response === null) {
            throw AccountException::notFound('查無此帳號。');
        }
        AccountValidation::checkPassword($response, $data['password']);
        $this->accountRepository->update($account, $data['update']);
        return [
            'status' => StatusCode::allSuccess->value,
            'message' => '帳號：[' . $account . '] 的密碼已成功更新。',
        ];
    }
}
