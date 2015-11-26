<?php
/***********************************************
Sample code for handling MailChimp Webhooks - to write the logfile, your webserver must be able to write 
to the file in the wh_log() function below.

This also assumes you use a key to secure the script and configure a URL like this in MailChimp:

http://www.mydomain.com/webhook.php?key=EnterAKey!

***********************************************/
$my_key  = 'MCSubscriptionKey!';

wh_log('==================[ Incoming Request ]==================');

wh_log("Full _REQUEST dump:\n".print_r($_REQUEST,true)); 

if ( !isset($_GET['key']) ){
    wh_log('No security key specified, ignoring request'); 
} elseif ($_GET['key'] != $my_key) {
    wh_log('Security key specified, but not correct:');
    wh_log("\t".'Wanted: "'.$my_key.'", but received "'.$_GET['key'].'"');
} else {
    //process the request
    wh_log('Processing a "'.$_POST['type'].'" request...');
    switch($_POST['type']){
        case 'subscribe'  : subscribe($_POST['data']);   break;
        case 'unsubscribe': unsubscribe($_POST['data']); break;
        case 'cleaned'    : cleaned($_POST['data']);     break;
        case 'upemail'    : upemail($_POST['data']);     break;
        case 'profile'    : profile($_POST['data']);     break;
        default:
            wh_log('Request type "'.$_POST['type'].'" unknown, ignoring.');
    }
}
wh_log('Finished processing request.');

/***********************************************
    Helper Functions
***********************************************/
function wh_log($msg){
    $logfile = 'MC_subscription_webhook.log';
    file_put_contents($logfile,date("Y-m-d H:i:s")." | ".$msg."\n",FILE_APPEND);
}

function subscribe($data){
    wh_log($data['email'] . ' just subscribed!');
    $dao = new UsuarioDAO($data['email']);
    if (!$dao->existe) {
        wh_log($data['email'] . ' no existe en nuestra base de datos!!!');
    }
    else {
        $dao->setMailchimpSuscrito(1);
    }
        
}
function unsubscribe($data){
    wh_log($data['email'] . ' just unsubscribed!');
    $dao = new UsuarioDAO($data['email']);
    if (!$dao->existe) {
        wh_log($data['email'] . ' no existe en nuestra base de datos!!!');
    }
    else {
        $dao->setMailchimpSuscrito(0);
    }
}
function cleaned($data){
    wh_log($data['email'] . ' was cleaned from your list!');
}
function upemail($data){
    wh_log($data['old_email'] . ' changed their email address to '. $data['new_email']. '!');
}
function profile($data){
    wh_log($data['email'] . ' updated their profile!');
}
