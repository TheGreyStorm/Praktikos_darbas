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
           'Paprastas vartotojas' => 'ROLE_USER',
           'Vadybininkas' => 'ROLE_MANAGER',
           'Administratorius' => 'ROLE_ADMIN'
       );

        $builder
            ->add('email',null, array('label'=>'El. paštas'))
            ->add('username', null, array('label'=>'Vartotojo vardas'))
            ->add(
                'roles',
                'Symfony\Component\Form\Extension\Core\Type\ChoiceType',
                array(
                    'multiple' => true,
                    'expanded' => true,
                    'label' => 'Parinkti visas tinkančias roles:',
                    'choices' => $permissions,
                )
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
