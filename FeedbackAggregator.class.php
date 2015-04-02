<?php

require_once __DIR__ . "/models/FeedbackOrigin.class.php";
require_once __DIR__ . "/models/FeedbackAnswer.class.php";
require_once __DIR__ . "/models/FeedbackPoll.class.php";
require_once __DIR__ . "/models/FeedbackOption.class.php";

class FeedbackAggregator extends StudIPPlugin implements SystemPlugin {

    public function __construct()
    {
        parent::__construct();
        if ($GLOBALS['perm']->have_perm("root")) {
            $tab = new Navigation(_("Erhebungen"), PluginEngine::getURL($this, array(), "creator/overview"));
            Navigation::addItem("/tools/feedbackaggregator", $tab);
        }
    }

    public function verifySignature($payload, $token)
    {
        $signatureHeader = $_SERVER['HTTP_X_ORIGIN_SIGNATURE'];
        list($algorithm, $hash) = explode('=', $signatureHeader, 2);
        $calculatedHash = hash_hmac($algorithm, $payload, $token);
        return $calculatedHash === $hash;
    }
}