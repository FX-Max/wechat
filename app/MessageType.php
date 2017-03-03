<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 17/3/3
 * Time: 23:10
 */

namespace App\Wechat\MessageType;

/**
 * Class MessageType
 * @package App\Wechat\MessageType
 * define the message type
 */
class MessageType
{
    /**/
    public static $MSG_TYPE_EVENT = 'event';

    /**/
    public static $MSG_TYPE_TEXT  = 'text';

    /**/
    public static $MSG_TYPE_IMAGE = 'image';

    /**/
    public static $MSG_TYPE_VOICE = 'voice';

    /**/
    public static $MSG_TYPE_VIDEO = 'video';

    /**/
    public static $MSG_TYPE_LOCATION = 'location';
    
    /**/
    public static $MSG_TYPE_LINK = 'link';

}