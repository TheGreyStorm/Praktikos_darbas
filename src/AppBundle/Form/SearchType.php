<?php
/**
 * Created by PhpStorm.
 * User: giedrius.l
 * Date: 4/12/2018
 * Time: 1:06 PM
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('question', TextType::class)
            ->add('slug', TextType::class)
            ->add('answer', TextType::class)
            ->add('category', TextType::class)
            ->add('search', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           // 'data_class' => 'AppBundle\Form\SearchType'
        ]);
    }
}