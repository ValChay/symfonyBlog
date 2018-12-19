<?php
/**
 * Created by PhpStorm.
 * User: valentin
 * Date: 19/12/18
 * Time: 15:24
 */

namespace App\Utils;
use App\Repository\AuthorRepository;

class Calculator
{
    // notre auteurrepository sera disponible dans dautre méthode
    private $repository;

    /**
     * Calculator constructor.
     */
    public function __construct(AuthorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function add(int $numb1, int $numb2): int{

        return $numb1 + $numb2 ;
    }



}