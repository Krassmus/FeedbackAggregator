<?php

require_once 'app/controllers/plugin_controller.php';

class PushController extends PluginController {

    public function polls_action()
    {
        if (Request::get("origin") && $_SERVER['HTTP_X_ORIGIN_SIGNATURE'] && Request::get("poll_id")) {
            $payload = file_get_contents("php://input");
            $origin = new FeedbackOrigin(md5(Request::get("origin")));
            if ($origin->isNew() || (!$this->plugin->verifySignature($payload, $origin['token']))) {
                throw new Exception("Wrong hash.");
            }
            $poll = FeedbackPoll::find(Request::option("poll_id"));
            $answers = Request::getArray("answers");
            foreach ($poll->options as $option) {
                if (isset($answers[$option->getId()])
                        && $answers[$option->getId()]['option_id'] === $answers[$option->getId()]) {
                    $answer = new FeedbackAnswer();
                    $answer['option_id'] = $answers[$option->getId()]['option_id'];
                    $answer['origin_id'] = $origin->getId();
                    $answer['user'] = $answers[$option->getId()]['user'];
                    $answer['answer'] = $answers[$option->getId()]['answer'];
                    $answer['answer_time'] = $answers[$option->getId()]['answer_time'];
                    $answer->store();
                }
            }
            $this->render_text("ok");
        }
    }

}