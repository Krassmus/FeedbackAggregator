<?php

require_once 'app/controllers/plugin_controller.php';

class CreatorController extends PluginController {

    public function overview_action()
    {
        if (!$GLOBALS['perm']->have_perm("root")) {
            throw new AccessDeniedException("Kein Zugriff");
        }
        $this->polls = FeedbackPoll::findBySQL("1=1 ORDER BY start_time DESC");
    }

    public function edit_action($poll_id = null)
    {
        $this->poll = new FeedbackPoll($poll_id);
        if (!$this->poll->isNew() && $this->poll['start_time'] < time()) {
            throw new Exception("Umfrage ist schon gestartet und kann nicht mehr editiert oder gelöscht werden.");
        }
        if (Request::isPost()) {
            $data = Request::getArray("poll");
            $data['start_time'] = strtotime($data['start_time']);
            $data['end_time'] = strtotime($data['end_time']);
            $this->poll->setData($data);
            $this->poll->store();
            PageLayout::postMessage(MessageBox::success(_("Umfrage gespeichert")));
        }
    }

}