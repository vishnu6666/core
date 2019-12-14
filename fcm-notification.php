++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
FCM Notification 
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
<?php 

define('API_ACCESS_KEY','key value here');

public function sendGCMtoAndroid($message, $device_id ,$title) 
{
    // API access key from Google API's Console
    $fields = array (
        "to" => $device_id,
        'notification' => array (
            "body" => $message,
            "title" => $title,
            "icon" => "ic_launcher"
        ),
    );

    $fields = json_encode ( $fields );
    $headers = array
    (
        'Authorization: key=' .API_ACCESS_KEY,
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
    curl_setopt( $ch,CURLOPT_POST, true );
    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch,CURLOPT_POSTFIELDS, $fields );
    $result = curl_exec($ch );
    curl_close( $ch );
    // echo $result;
    return $result;
}