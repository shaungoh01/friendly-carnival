<?php

namespace App\Services;

use App\Article;

class ArticleService
{
    //we can add more function here like sending an email notification to make this service make more sense.
    public function approveCollaborate(Article $article, $user_id)
    {
        $article->users()->updateExistingPivot($user_id,["status"=>"approved"]);
    }

    public function requestCollaborate(Article $article, $user_id)
    {
        $article->users()->syncWithoutDetaching([$user_id=>["status"=>"pending"]]);
    }

}
