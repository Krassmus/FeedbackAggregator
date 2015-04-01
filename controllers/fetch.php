<?php

require_once 'app/controllers/plugin_controller.php';

class FetchController extends PluginController {

    public function token_action()
    {
        if (Request::isPost() && Request::get("origin")) {
            $origin = new FeedbackOrigin(md5(Request::get("origin")));
            if (!$origin->isNew()) {
                throw new Exception("Token already distributed. Please contact the coregroup.");
            }
            $origin['origin'] = Request::get("origin");
            $origin['token'] = hash("sha256", uniqid());
            $origin->store();
            $this->render_json(array(
                'token' => $origin['token']
            ));
        } else {
            throw new Exception("Use POST with correct parameter.");
        }
    }

    public function polls_action()
    {
        if (Request::get("origin") && $_SERVER['HTTP_X_ORIGIN_SIGNATURE']) {
            $payload = file_get_contents("php://input");
            $origin = new FeedbackOrigin(md5(Request::get("origin")));
            if ($origin->isNew() || (!$this->plugin->verifySignature($payload, $origin['token']))) {
                throw new Exception("Wrong hash.");
            }
            $polls = FeedbackPolls::findBySQL("start_time >= UNIX_TIMESTAMP() ORDER BY start_time ASC, name ASC");
            $poll_data = array();
            foreach ($polls as $poll) {
                $data = $poll->toArrayRecursive();
                $poll_data[] = $data;
            }
            $this->render_json($poll_data);
        }
    }
}