<?php
/**
 * Created by PhpStorm.
 * User: valentin
 * Date: 19/12/18
 * Time: 16:15
 */

namespace App\Utils;


use App\Entity\Author;
use App\Repository\AuthorRepository;
use Symfony\Contracts\Translation\TranslatorInterface;


class Good
{
private $repository;
private $translitor;

    const MSGS = ['excellent','bravo','mouais'];

    /**
     * Good constructor.
     */
    public function __construct(AuthorRepository $repository, TranslatorInterface $translator)
    {
        $this->repository = $repository;
        $this->translitor = $translator;
    }

    public function welldone(Author $author){

        // Je prend un index au hasard dans le tableau
        $level = array_rand(self::MSGS);
        // on récupère les auteur
        $allAuthors = $this->repository->findAll();

     $authorName = $allAuthors[array_rand($allAuthors)]->getName();

     return $this->translitor->trans(
         "good.".$level,
     ['%name%' => $authorName]
     );

    }


}