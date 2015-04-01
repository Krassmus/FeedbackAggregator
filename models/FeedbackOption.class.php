<?php

class FeedbackOption extends SimpleORMap {

    protected static function configure($config = array())
    {
        $config['db_table'] = 'feedback_options';
        $config['belongs_to']['poll'] = array(
            'class_name' => "FeedbackPoll",
            'foreign_key' => "poll_id"
        );
        $config['has_many']['answers'] = array(
            'class_name' => "FeedbackAnswer",
            'on_delete' => "delete",
            'on_store' => "store",
        );
        parent::configure($config);
    }

}