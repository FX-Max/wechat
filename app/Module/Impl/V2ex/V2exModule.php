<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 17/3/4
 * Time: 13:10
 */

namespace App\Module\Impl\V2ex;

use GuzzleHttp\Client;

class V2exModule
{

    private function httpGet($url){
        /*
$client = new Client(['base_uri' => 'https://www.v2ex.com/api/']);
$response = $client->request('GET', 'topics/hot.json');
*/
        $return_data = array(
            'code' => 0,
            'msg'  => '',
            'data' => '',
        );

        if(!$url){
            $return_data['code'] = 1;
            $return_data['msg']  = 'url is null';
            return $return_data;
        }

        $client = new Client();
        $response = $client->request(
            'GET',
            $url,
            ['verify' => false]
        );

        if($response->getStatusCode() == '200'){
            $return_data['code'] = $response->getStatusCode();
            $return_data['data'] = json_decode($response->getBody(), true);
        }else{
            $return_data['code'] = $response->getStatusCode();
            $return_data['msg']  = '';
        }

        $return_data['data'] || $return_data['data'] = array();

        return $return_data;
    }

    public function getHotTopicsAuthorSocialInfo($data_hot_topics){

        $author_social_info = array();

        foreach ($data_hot_topics as $key => $topic_item){

            $topic_author_id = $topic_item['member']['id'];
            $topic_author_username = $topic_item['member']['username'];

            $return_member_info = $this->getMemberById($topic_author_id);

            if($return_member_info['code'] == 200){
                $author_social_info[] = $return_member_info['data'];
            }
        }

        return $author_social_info;
    }

    public function getHotTopics(){

        $url_hot_topic = 'https://www.v2ex.com/api/topics/hot.json';

        $return_data = $this->httpGet($url_hot_topic);

        return $return_data;
    }

    public function getLatestTopics(){

    }

    public function getMemberByUsername(){

    }

    public function getMemberById($id){

        $url_member = 'https://www.v2ex.com/api/members/show.json?id=' . $id;

        $return_data = $this->httpGet($url_member);

        return $return_data;
    }

}