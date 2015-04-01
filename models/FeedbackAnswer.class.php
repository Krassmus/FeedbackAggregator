<?php

class FeedbackAnswer extends SimpleORMap {

    protected static function configure($config = array())
    {
        $config['db_table'] = 'feedback_answers';
        $config['belongs_to']['option'] = array(
            'class_name' => 'FeedbackOption',
            'foreign_key' => 'option_id'
        );
        parent::configure($config);
    }

}