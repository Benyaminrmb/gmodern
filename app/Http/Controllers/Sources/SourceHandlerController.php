<?php

namespace App\Http\Controllers\Sources;

use App\Http\Controllers\CrawlerController;
use App\Models\Post;
use App\Models\Source;

abstract class SourceHandlerController
{
    abstract public function run(Source $source):array;
    abstract public function getDetail(Post $post):string;

}
