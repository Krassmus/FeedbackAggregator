<?php

class InitPlugin extends Migration {
    
    public function up() {
        DBManager::get()->exec("
            CREATE TABLE IF NOT EXISTS `feedback_origins` (
                `origin_id` varchar(32) NOT NULL PRIMARY KEY,
                `origin` varchar(128) NOT NULL,
                `token` varchar(64) NOT NULL,
                `chdate` bigint NOT NULL,
                `mkdate` bigint NOT NULL
            );
        ");
        DBManager::get()->exec("
            CREATE TABLE `feedback_polls` (
                `poll_id` varchar(32) NOT NULL PRIMARY KEY,
                `name` varchar(64) NOT NULL,
                `description` text NOT NULL,
                `start_time` bigint NOT NULL,
                `end_time` bigint NOT NULL,
                `chdate` int NOT NULL,
                `mkdate` int NOT NULL
            );
        ");
        DBManager::get()->exec("
            CREATE TABLE `feedback_options` (
                `option_id` varchar(32) NOT NULL PRIMARY KEY,
                `poll_id` varchar(32) NOT NULL,
                `datatype` varchar(64) NOT NULL,
                `description` text NOT NULL
            );
        ");
        DBManager::get()->exec("
            CREATE TABLE `feedback_answers` (
                `answer_id` varchar(32) NOT NULL,
                `option_id` varchar(32) NOT NULL,
                `origin_id` varchar(32) NOT NULL,
                `user` int NOT NULL,
                `answer` text NOT NULL,
                `answer_time` bigint NOT NULL,
                `chdate` bigint NOT NULL,
                `mkdate` bigint NOT NULL
            );
        ");
    }
	
    public function down() {

    }
}