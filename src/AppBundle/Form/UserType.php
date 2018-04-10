<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $permissions = array(
           'User' => 'ROLE_USER',
           'Manager' => 'ROLE_MANAGER',
           'Admin' => 'ROLE_ADMIN'
       );

        $builder
            ->add('email')
            ->add('username')
            ->add(
                'roles',
                'Symfony\Component\Form\Extension\Core\Type\ChoiceType',
                array(
                    'multiple' => true,
                    'label' => 'Choose the role',
                    'choices' => $permissions,
                )
            )
            ->add(
                'save',
                'Symfony\Component\Form\Extension\Core\Type\SubmitType'
            );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }


}
