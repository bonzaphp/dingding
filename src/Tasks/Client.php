<?php

namespace EasyDingTalk\Tasks;

use EasyDingTalk\Kernel\BaseClient;
use GuzzleHttp\Exception\GuzzleException;

/**
 * 消息通知
 * Class Client
 * @author bonzaphp@gmail.com
 * @Date 2022/5/10 5:51 PM
 * @package EasyDingTalk\Tasks
 */
class Client extends BaseClient
{
    /**
     * 创建待办任务
     *
     * @param  string  $unionId  员工在当前开发者企业账号范围内的唯一标识。
     * @param  string  $operatorId  操作人的unionId
     * @param  string  $subject  待办标题,最大长度1024。
     * @param  string  $description  待办描述
     * @param  int  $priority  待办优先级，优先级，取值： 10：较低 20：普通 30：紧急 40：非常紧急
     * @return array|object|\Overtrue\Http\Support\Collection|\Psr\Http\Message\ResponseInterface|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function add(string $unionId, string $operatorId, string $subject, string $access_token, string $description = '', int $priority = 20)
    {
        $content = [
            'subject'     => $subject,
            'description' => $description,
            'priority'    => $priority,
            'dueTime'     => self::getMillisecond() + (3600 * 24 * 1000),
            'dingNotify'  => 1,
        ];
        return $this->client->postJson("https://api.dingtalk.com/v1.0/todo/users/{$unionId}/tasks?operatorId=".$operatorId, $content);
    }

    /**
     * 获取毫秒级别的时间戳
     * @return float
     * @author bonzaphp@gmail.com
     */
    private static function getMillisecond(): float
    {
        [$msec, $sec] = explode(' ', microtime());
        return (float) sprintf('%.0f', ((float) $msec + (float) $sec) * 1000);
    }


}
