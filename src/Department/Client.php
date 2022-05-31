<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Department;

use EasyDingTalk\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 获取子部门 ID 列表
     *
     * @param string $id 部门ID
     *
     * @return mixed
     */
    public function getSubDepartmentIds($id)
    {
        return $this->client->get('department/list_ids', compact('id'));
    }

    /**
     * 获取部门列表
     *
     * @param bool   $isFetchChild
     * @param string $id
     * @param string $lang
     *
     * @return mixed
     */
    public function list($id = null, bool $isFetchChild = false, $lang = null)
    {
        return $this->client->get('department/list', [
            'id' => $id, 'lang' => $lang, 'fetch_child' => $isFetchChild ? 'true' : 'false',
        ]);
    }

    /**
     * 获取部门详情
     *
     * @param string $dept_id
     * @param  string  $lang
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $dept_id, $lang = null)
    {
        return $this->client->post('topapi/v2/department/get', compact('dept_id', 'lang'));
    }

    /**
     * 查询部门的所有上级父部门路径
     *
     * @param string $dept_id
     *
     * @return mixed
     */
    public function getParentsById($dept_id)
    {
        return $this->client->post('topapi/v2/department/listparentbydept', compact('dept_id'));
    }

    /**
     * 查询指定用户的所有上级父部门路径
     *
     * @param string $userid
     *
     * @return mixed
     */
    public function getParentsByUserId($userid)
    {
        return $this->client->post('topapi/v2/department/listparentbyuser', compact('userid'));
    }

    /**
     * 创建部门
     *
     * @param array $params
     *
     * @return mixed
     */
    public function create(array $params)
    {
        return $this->client->postJson('department/create', $params);
    }

    /**
     * 更新部门
     *
     * @param string $id
     * @param array  $params
     *
     * @return mixed
     */
    public function update($id, array $params)
    {
        return $this->client->postJson('department/update', compact('id') + $params);
    }

    /**
     * 删除部门
     *
     * @param string $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        return $this->client->get('department/delete', compact('id'));
    }
}
