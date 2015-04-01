<?php

class FeedbackPoll extends SimpleORMap {

    protected static function configure($config = array())
    {
        $config['db_table'] = 'feedback_polls';
        $config['has_many']['options'] = array(
            'class_name' => "FeedbackOption",
            'on_delete' => "delete",
            'on_store' => "store",
        );
        parent::configure($config);
    }

}