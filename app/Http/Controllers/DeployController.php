<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Mail;
use Log;

class DeployController extends Controller
{

    public function deploy(){

        $target = '/var/www/http/wechat';
        $token = '';

        $json_web_hook = json_decode(file_get_contents('php://input'), true);

        //if (empty($json['token']) || $json['token'] !== $token) {
        //    exit('error request');
        //}

        $cmd = "cd $target && git reset --hard origin/master && git clean -f && git pull origin master 2>&1 && git checkout master";
        //$cmd = "cd $target && git pull origin master";
        var_dump($cmd);
        $result = shell_exec($cmd);
        var_dump($result);

        $flag_mail = Mail::send(
            'mail.deploy',
            ['deploy_result' => $result, 'json_web_hook' => $json_web_hook],
            function($message){
                $to = 'xfang@i9i8.com';
                $message->to($to)->subject('Deploy Email');
            }
        );

        if($flag_mail){
            echo 'Send Mail Success.';
            Log::info(date('Y-m-d h:i:s') . 'Send Mail Success:');
        }else{
            echo 'Send Mail Fail';
            Log::info(date('Y-m-d h:i:s') . 'Send Mail Fail:');
        }

    }



}
