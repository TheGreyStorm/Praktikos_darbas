<?php
/**
 * Created by PhpStorm.
 * User: giedrius.l
 * Date: 4/10/2018
 * Time: 10:19 AM
 */

namespace AppBundle\Form;


use Symfony\Component\Form\FormBuilderInterface;

class ChangeUserRoleFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $permissions = array(
            'ROLE_USER' => 'User',
            'ROLE_MANAGER' => 'Manager',
            'ROLE_ADMIN' => 'admin'
        );

        $builder
            ->add(
                'id',
                'entity',
                array(
                    'class' => 'AppBundle\Entity\User',
                    'property' => 'username',
                    'label' => 'Choose the user'
                )
            )
            ->add(
                'role',
                'choice',
                array(
                    'label' => 'Choose the role',
                    'choices' => $permissions,
                )
            )
            ->add(
                'save',
                'submit'
            );
    }
}