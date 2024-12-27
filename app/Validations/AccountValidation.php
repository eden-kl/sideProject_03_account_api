<?php
/**
 * 帳號驗證的validation
 *
 * @version 0.1.0
 * @author eden.chen eden.chen@kkday.com
 * @date 2024/12/27
 * @since 0.1.0 2024/12/27 eden.chen: 新建立AccountValidation class
 */

namespace App\Validations;

use App\Exceptions\AccountException;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;

class AccountValidation
{
    /**
     * @param Account $account
     * @param string $password
     * @return void
     * @throws AccountException
     */
    public static function checkPassword(Account $account, string $password):void
    {
        if (!Hash::check($password, $account->password)) {
            throw AccountException::passwordValidationFailed('密碼驗證錯誤');
        }
    }
}
