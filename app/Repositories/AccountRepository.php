<?php
/**
 * Account repository
 *
 * @version 0.1.4
 * @author eden.chen eden.chen@kkday.com
 * @date 2024/12/25
 * @since 0.1.0 2024/12/25 eden.chen: 新建立AccountRepository class
 * @since 0.1.1 2024/12/25 eden.chen: 新增phpDoc
 * @since 0.1.2 2024/12/25 eden.chen: 改用array回傳
 * @since 0.1.3 2024/12/25 eden.chen: 移除不用的use
 * @since 0.1.4 2024/12/25 eden.chen: 修改create回傳格式為void
 */

namespace App\Repositories;

use App\Models\Account;

class AccountRepository implements CRUDRepositoryInterface
{

    /**
     * @return array
     */
    public function all(): array
    {
        return Account::all()->toArray();
    }

    /**
     * @param array $data
     * @return void
     */
    public function create(array $data): void
    {
        Account::create($data);
    }

    /**
     * @param $pk
     * @param array $data
     * @return Account
     */
    public function update($pk, array $data): Account
    {
        $account = Account::findOrFail($pk);
        $account->update($data);
        return $account;
    }

    /**
     * @param $pk
     * @return void
     */
    public function delete($pk): void
    {
        $account = Account::findOrFail($pk);
        $account->delete();
    }

    /**
     * @param $pk
     * @return Account|null
     */
    public function find($pk): ?Account
    {
        return Account::find($pk);
    }
}
