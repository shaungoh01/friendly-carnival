<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Services\ArticleService;

class Article extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return ArticleService::class; }
}
