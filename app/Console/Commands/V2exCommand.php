<?php

namespace App\Console\Commands;

use App\Module\Impl\V2ex\V2exModule;
use Illuminate\Console\Command;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class V2exCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:v2ex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $data_send_mail = array();
        $email_to = env('DAILY_MAIL_TO', '');

        $v2exModule = new V2exModule();

        $return_hot_topics = $v2exModule->getHotTopics();

        $data_hot_topics = array();
        if($return_hot_topics['code'] == 200){
            $data_hot_topics = $return_hot_topics['data'];
        }

        foreach ($data_hot_topics as $topic_item){
            $data_send_mail['topic'][] = array(
                'url'   => $topic_item['url'],
                'title' => $topic_item['title'],
            );
        }

        $author_social_info = $v2exModule->getHotTopicsAuthorSocialInfo($data_hot_topics);

        foreach ($author_social_info as $key => $info_item) {
            if (!empty($info_item['website'])) {

                //处理一下website链接 有些没有http/https
                if ((strpos($info_item['website'], "http://") !== 0) &&
                    (strpos($info_item['website'], "https://") !== 0)
                ) {
                    $website_url = 'http://' . $info_item['website'];
                } else {
                    $website_url = $info_item['website'];
                }

                $data_send_mail['author'][] = array(
                    'username' => $info_item['username'],
                    'website'  => $website_url,
                );
            }

        }

        //send email

        $flag_mail = Mail::send(
            'mail.daily',
            [
                'data_topic'    =>  $data_send_mail['topic'],
                'data_author'   =>  $data_send_mail['author'],
            ],
            function($message) use ($email_to){
                $message->to($email_to)->subject('Daily Email');
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
