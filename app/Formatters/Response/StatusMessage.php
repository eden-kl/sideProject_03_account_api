<?php
/**
 * 狀態代碼對應message
 *
 * @version 0.2.0
 * @author eden.chen eden.chen@kkday.com
 * @date 2024/12/25
 * @since 0.1.0 2024/12/25 eden.chen: 新建立statusMessage class
 * @since 0.2.0 2024/12/26 eden.chen: 改用enum
 */

namespace App\Formatters\Response;

use App\Enums\StatusCode;
use Symfony\Component\HttpFoundation\Response;

final class StatusMessage
{
    private const CODE_MAPPING = [
        StatusCode::allSuccess->value => [
            'message' => 'Success',
            'httpCode' => Response::HTTP_OK,
        ],
        StatusCode::parameterError->value => [
            'message' => '參數錯誤',
            'httpCode' => Response::HTTP_BAD_REQUEST,
        ],
        StatusCode::accountDuplicated->value => [
            'message' => '帳號名稱重複',
            'httpCode' => Response::HTTP_OK,
        ],
        StatusCode::accountNotFound->value => [
            'message' => '查無此帳號',
            'httpCode' => Response::HTTP_OK,
        ],
        StatusCode::error->value => [
            'message' => 'Error',
            'httpCode' => Response::HTTP_OK,
        ],
    ];

    /**
     * @param string|null $code
     * @return string
     */
    public static function getMessage(string $code = null): string
    {
        return self::CODE_MAPPING[$code]['message'];
    }

    /**
     * @param string $code
     * @return string
     */
    public static function getHttpCode(string $code): string
    {
        return self::CODE_MAPPING[$code]['httpCode'];
    }

    /**
     * @param int $code
     * @param bool $isError
     * @return string
     */
    public static function getStatusCode(int $code, bool $isError = true): string
    {
        $code = $isError ? 'E' . $code : (string)$code;
        if (!array_key_exists($code, self::CODE_MAPPING)) {
            $code = StatusCode::error->value;
        }
        return $code;
    }
}
