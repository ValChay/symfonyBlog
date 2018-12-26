<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('body')
            ->add('published')
            ->add('author', null,
                ['choice_label' => 'name'])
        ;
    }
// a chaque fois quon ajoute quelque chose on vérifieque c'est un champs de Article
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
            'label_format' => 'article.entity.%name%',
        ]);
    }
}
