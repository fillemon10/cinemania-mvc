<?php

namespace app\models;

use app\core\OMDb;

class SingleReview extends Review
{
    public string $plot = "";
    public string $imdb_rating = "";

    public function getOMDbData()
    {
        $omdb = new OMDb(['plot' => 'full', 'apikey' => '84385d89']);
        $movie = $omdb->get_by_id($this->imdb_id);
        $this->plot = $movie["Plot"];
        $this->imdb_rating = $movie['Ratings'][0]["Value"];
    }
}
