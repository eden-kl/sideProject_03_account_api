<?php
/**
 * Account repository
 *
 * @version 0.1.2
 * @author eden.chen eden.chen@kkday.com
 * @date 2024/12/25
 * @since 0.1.0 2024/12/25 eden.chen: 新建立AccountRepository class
 * @since 0.1.1 2024/12/25 eden.chen: 新增phpDoc
 * @since 0.1.2 2024/12/25 eden.chen: 改用array回傳
 */

namespace App\Repositories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Collection;
use LaravelIdea\Helper\App\Models\_IH_Account_C;

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
     * @return Account
     */
    public function create(array $data): Account
    {
        return Account::create($data);
    }

    /**
     * @param $pk
     * @param array $data
     * @return Account|_IH_Account_C|array
     */
    public function update($pk, array $data): Account|_IH_Account_C|array
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
     * @return array
     */
    public function find($pk): array
    {
        return Account::findOrFail($pk)->toArray();
    }
}
