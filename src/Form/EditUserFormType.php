<?php
/**
 * Created by PhpStorm.
 * User: giedrius.l
 * Date: 3/27/2018
 * Time: 3:10 PM
 */

namespace App\Form;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class EditUserFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     * @Route("/admin", name="admin")
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('roles', ChoiceType::class, [
               'multiple' => false,
               'expanded' =>true,
               'choices' => [
                   'Manager' => 'ROLE_MANAGER',
                   'User'=> 'ROLE_USER'
               ]
            ]);
    }

 /*   public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => User::class));
    }*/
}