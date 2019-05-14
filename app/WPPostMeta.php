<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WPPostMeta extends Model
{
	protected $table = 'wp_postmeta';
    protected $connection = 'dreamgo';
}
