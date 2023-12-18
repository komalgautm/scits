<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogBookComment extends Model
{
    /**
     * CREATE TABLE `log_book_comments` (
     *   `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
     *   `log_book_id` int NOT NULL,
     *   `user_id` int NOT NULL,
     *   `comment` text NOT NULL,
     *   `is_deleted` int NOT NULL DEFAULT '0' COMMENT '''1''=>''yes'',''0''=''no''',
     *   `created_at` datetime NOT NULL,
     *   `updated_at` datetime NOT NULL
     * ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
     */
    protected $table = 'log_book_comments';
}
