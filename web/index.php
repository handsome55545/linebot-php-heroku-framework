<?php
/**
 * Copyright 2016 LINE Corporation
 *
 * LINE Corporation licenses this file to you under the Apache License,
 * version 2.0 (the "License"); you may not use this file except in compliance
 * with the License. You may obtain a copy of the License at:
 *
 *   https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */
require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
/*$a=array(
　"0"=>"葛格",
　"1"=>"牛蛙妹妹",
　"2"=>"紅心A"
);*/
$bbbb=rand(0,4);
foreach ($client->parseEvents() as $event) { //接收憑證
    switch ($event['type']) {          //判斷傳回資料型態
        case 'message':                     //如果有訊息                 //$message['text'] 接收到的資料會儲存在這邊
            $message = $event['message'];           //將資料存入陣列   //$m_message['text']=將你們要秀出的資料存進的變數
            switch ($message['type']) {         
                case 'text':                //如果有文字訊息
                    $m_message['text']=$message['text'];   
                	if($m_message!="")
                	{
                		$client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                        'messages' => array(
                            array(
                                'type' => 'text',
                                'text' => $m_message
                            )
                        )
                    	));
                	}
                    break;
            }
            break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
