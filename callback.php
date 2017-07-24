<?php
function info($message) {

    $info = json_encode(array(
        'error' => array(
           	'error_code' => '3',
            'error_msg' => "$message",
        ),
    ));

    echo $info;

}
function success($message) {

    $success = json_encode(array(
        'response' => array (
            'success' => '0',
            'msg' => "$message",
        ),
    ));

    echo $success;

}
function error($message) {

    $error = json_encode(array(
        'error' => array(
            'error_code' => '1',
            'error_msg' => "$message",
        ),
    ));
    echo $error;
}
?>