<?php

namespace Mattsmithdev;


class MovieRepository
{
    private $movies = [];

    public function __construct()
    {
        $movie1 = new Movie();
        $movie1->setId(1);
        $movie1->setTitle('Jaws');
        $movie1->setPrice(9.99);

        $movie2 = new Movie();
        $movie2->setId(2);
        $movie2->setTitle('Aliens');
        $movie2->setPrice(19.99);


        $movie3 = new Movie();
        $movie3->setId(3);
        $movie3->setTitle('Shrek');
        $movie3->setPrice(10.00);


        $this->movies[] = $movie1;
        $this->movies[] = $movie2;
        $this->movies[] = $movie3;
    }

    public function findAll()
    {
        return $this->movies;
    }
}