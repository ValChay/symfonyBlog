<?php

namespace App\Tests;

use App\Entity\Article;
use App\Entity\Author;
use PHPUnit\Framework\TestCase;


class ArticleTest extends TestCase
{
    public function testSomething()
    {
        $article = new Article();

        $this->assertNull($article->getId());
        $this->assertInstanceOf(\DateTime::class, $article->getCreation());
        $this->assertInstanceOf(\DateTime::class, $article->getLastUpdate());
        $this->assertFalse($article->getPublished());
    }

    public function testFill()
    {
        $article = new Article();

        $article
            ->setTitle('Bonjour')
            ->setBody('Coucou')
            ->setPublished(true)
            ->setLastUpdate(new \DateTime());



        $this->assertEquals('Bonjour',$article->getTitle());
        $this->assertEquals('Coucou',$article->getBody());
        $this->assertTrue($article->getPublished());

        return $article;
    }

    /**
     * @dataProvider provideArticles
     * @param $title
     * @param $body
     * @param $published
     */
    public function testManyArticles($title, $body, $published) {

            $article = new Article();

        $article
            ->setTitle($title)
            ->setBody($body)
            ->setPublished($published);

        $this->assertEquals($title,$article->getTitle());
        $this->assertEquals($body,$article->getBody());
    }

    public function provideArticles(): array {
        return [
            ['Hourra','Hop', true],
        ['Mon titre', 'Re-hop',false],


        ];
    }

    /**
     * @depends testFill
     */

    public function testSetAuthor(Article $article){

        $author=  $this->createMock(Author::class);
        $author->method('getName')->willReturn('Josh');
        $article->setAuthor($author);
        $this->assertInstanceOf(Author::class, $article->getAuthor());
    }
}
