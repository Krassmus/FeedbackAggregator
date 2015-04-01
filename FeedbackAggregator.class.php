<?php

require_once __DIR__."/models/FeedbackOrigin.class.php";
require_once __DIR__."/models/FeedbackAnswer.class.php";
require_once __DIR__."/models/FeedbackPoll.class.php";
require_once __DIR__."/models/FeedbackOption.class.php";

class FeedbackAggregator extends StudIPPlugin implements SystemPlugin {

    public function verifySignature($payload, $token)
    {
        $signatureHeader = $_SERVER['HTTP_X_ORIGIN_SIGNATURE'];
        list($algorithm, $hash) = explode('=', $signatureHeader, 2);
        $calculatedHash = hash_hmac($algorithm, $payload, $token);
        return $calculatedHash === $hash;
    }
}