<?php
namespace EasyDingTalk\News;

use EasyDingTalk\Kernel\BaseClient;

/**
 * 消息通知
 * Class Client
 * @author bonzaphp@gmail.com
 * @Date 2022/5/10 5:51 PM
 * @package EasyDingTalk\News
 */
class Client extends BaseClient
{
    /**
     * 发送工作通知
     *
     * @param  string  $agent_id  发送消息的微应用id
     * @param  string  $userid_list  接收者的userid列表，最大用户列表长度100
     * @param  string  $dept_id_list  接收者的部门id列表，最大列表长度20。 接收者是部门ID时，包括子部门下的所有用户。
     * @param  array  $msg  消息内容
     * @param  string  $to_all_user
     * @return array|object|\Overtrue\Http\Support\Collection|\Psr\Http\Message\ResponseInterface|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function sendCorpConversation(string  $agent_id,string $userid_list, string $dept_id_list, array $msg, string $to_all_user = 'false')
    {
        //如果to_all_user为false,则用户列表和部门列表不能同时为空
        if (($to_all_user === 'false') && empty($userid_list) && empty($dept_id_list)) {
            throw new \InvalidArgumentException('userid_list and dept_id_list can not be empty at the same time');
        }
        $content =[
            'agent_id' => $agent_id,
            'to_all_user' => $to_all_user,
            'msg' => json_encode($msg, JSON_THROW_ON_ERROR),
        ];
        //检查用户列表是否为空
        if (!empty($userid_list)) {
            $content['userid_list'] = $userid_list;
        }
        //检查部门列表是否为空
        if (!empty($dept_id_list)) {
            $content['dept_id_list'] = $dept_id_list;
        }
        return $this->client->post('topapi/message/corpconversation/asyncsend_v2', $content);
    }

    /**
     * 发送普通消息
     *
     * @param  string  $userid 消息发送者的user_id
     * @param  string  $cid 会话ID
     * @param    $msg //消息内容
     * @return array|object|\Overtrue\Http\Support\Collection|\Psr\Http\Message\ResponseInterface|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendToConversation(string $userid,string $cid, $msg)
    {
        return $this->client->post('message/send_to_conversation', compact('userid'));
    }

}
