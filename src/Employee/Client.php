<?php
/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Employee;

use EasyDingTalk\Kernel\BaseClient;

/**
 * 智能人事相关API
 * Class Client
 * @author bonzaphp@gmail.com
 * @Date 2022/4/13 2:39 下午
 * @package EasyDingTalk\Employee
 */
class Client extends BaseClient
{
    /**
     * 获取在职员工列表
     * @author bonzaphp@gmail.com
     */
    public function onJob()
    {
        return $this->client->postJson('topapi/smartwork/hrm/employee/queryonjob', []);
    }

    /**
     * 获取待入职员工列表
     * @param  array  $params
     * @return array|object|\Overtrue\Http\Support\Collection|\Psr\Http\Message\ResponseInterface|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @author bonzaphp@gmail.com
     */
    public function preentry(array $params = ['offset' => 0, 'size' => 50])
    {
        return $this->client->postJson('topapi/smartwork/hrm/employee/querypreentry', $params);
    }


    /**
     * 获取离职员工列表
     * @param  array  $params
     * @return array|object|\Overtrue\Http\Support\Collection|\Psr\Http\Message\ResponseInterface|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function dimission(array $params = ['offset' => 0, 'size' => 50])
    {
        return $this->client->postJson('topapi/smartwork/hrm/employee/querydimission', $params);
    }

    /**
     * 获取员工离职信息
     */
    public function dimissionList(array $userid_list)
    {
        return $this->client->postJson('topapi/smartwork/hrm/employee/listdimission', $userid_list);
    }

    /**
     * 添加企业待入职员工
     */
    public function addPreentry()
    {
        return $this->client->postJson('topapi/smartwork/hrm/employee/addpreentry', []);
    }

    /**
     * 批量获取员工离职信息
     * 新版服务端API
     * @return array|object|\Overtrue\Http\Support\Collection|\Psr\Http\Message\ResponseInterface|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @author bonzaphp@gmail.com
     */
    public function dimissionInfos(array $userIds)
    {
        $userIdStr = '["'.implode('","', $userIds).'"]';
        return $this->client->get('https://api.dingtalk.com/v1.0/hrm/employees/dimissionInfos', [
            'userIdList' => $userIdStr,
        ]);
    }


}
