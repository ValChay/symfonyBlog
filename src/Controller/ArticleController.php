<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;

;

use App\Utils\Calculator;
use App\Utils\Good;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     *
     */
    public function index(ArticleRepository $repo, Calculator $calc, Good $good)
    {
        $list = $repo->findLatest(4);

        dump($calc->add(24,56));

        $weldonne = $good->welldone();

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'list' => $list,
            'weldonne' => $weldonne
        ]);
    }

    /**
     * @Route("/creation", name="article_new", methods={"GET", "POST"})
     *
     */
    public function create(EntityManagerInterface $manager, Request $request, TranslatorInterface $trans)
    {
        $form = $this->createForm(ArticleType::class, new Article());
        //On recupère les données
        $form->handleRequest($request);

        //
        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();
            $manager->persist($article);
            $manager->flush();
            $this->addFlash('success',
                $trans->trans('flash.success.article-created',
                ['%title%' => $article->getTitle()]
                )
            );
            return $this->redirectToRoute('article');
        }
        return $this->render('article/createArticle.html.twig', [
            'myform' => $form->createView()
        ]);
    }

    /**
     * @Route("/article/{id}", name="article_show")
     */
    public function show(Article $article)
    {

        $form = $this->createForm(FormType::class, null,['method' => 'DELETE',
        'action' => $this->generateUrl(
        'article_delete',
        ['id' => $article->getId()
        ])
        ]);
        return $this->render('article/show.html.twig',[
            'article' => $article,
            'delete_form' => $form->createView()
        ]);
    }

    /**
     * @Route("admin/article/{id}/edit", name="article_edit")
     * @IsGranted("ROLE_USER")
     */
    public function edit(Article $article, EntityManagerInterface $manager, Request $request)
    {
        $form = $this->createForm(ArticleType::class, $article);
        // avec handleREquest sil ya des donnée sur notre article se sera déja a jour
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setLastUpdate(new \DateTime());
            $manager->flush();

            // C'est ce parametre la que je vais remplacer
            return $this->redirectToRoute('article_show', ['id' => $article->getId()]);
        }
        return $this->render('article/edit.html.twig', [
            'edit_form' => $form->createView()
        ]);
    }

    /**
     * @Route("admin/article/{id}/delete", name="article_delete", methods={"DELETE"} )
     */
    public function delete(Article $article, EntityManagerInterface $manager)
    {
        $this->denyAccessUnlessGranted('ARTICLE_DELETE',$article->getAuthor());

        $manager->remove($article);
        $manager->flush();
        return $this->redirectToRoute('article');

    }

}

