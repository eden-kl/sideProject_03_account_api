<?php
/**
 * CRUD repository 介面
 *
 * @version 0.1.0
 * @author eden.chen eden.chen@kkday.com
 * @date 2024/12/25
 * @since 0.1.0 2024/12/25 eden.chen: 新建立CRUDRepositoryInterface class
 */

namespace App\Repositories;

interface CRUDRepositoryInterface
{
    public function all();
    public function create(array $data);
    public function update($pk, array $data);
    public function delete($pk);
    public function find($pk);
}
