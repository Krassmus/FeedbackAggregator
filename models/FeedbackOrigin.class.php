<?php

class FeedbackOrigin extends SimpleORMap {

    protected static function configure($config = array())
    {
        $config['db_table'] = 'feedback_origins';
        parent::configure($config);
    }

}