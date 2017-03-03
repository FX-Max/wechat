<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Wechat\MessageType;

class WechatController extends Controller
{


    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        //Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function($message){
            //return "欢迎关注 666！";

            switch ($message->MsgType) {
                case MessageType::$MSG_TYPE_EVENT :
                    return '收到事件消息';
                    break;

                case MessageType::$MSG_TYPE_TEXT :
                    return '收到文字消息';
                    break;

                case MessageType::$MSG_TYPE_IMAGE:
                    return '收到图片消息';
                    break;

                case MessageType::$MSG_TYPE_VOICE:
                    return '收到语音消息';
                    break;

                case MessageType::$MSG_TYPE_VIDEO:
                    return '收到视频消息';
                    break;

                case MessageType::$MSG_TYPE_LOCATION:
                    return '收到坐标消息';
                    break;

                case MessageType::$MSG_TYPE_LINK:
                    return '收到链接消息';
                    break;


                default:
                    return '收到其它消息';
                    break;
            }


        });

        //Log::info('return response.');

        return $wechat->server->serve();
    }

}
