<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\File;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Utilisateur' => 'ROLE_USER',
                    'Administrateur' => 'ROLE_ADMIN']
            ])
            ->add('password')
            ->add('avatar', FileType::class)
        ;

        $builder->get('roles')
                ->addModelTransformer(new CallbackTransformer(
                    function($rolesArray) {
                        return count($rolesArray) ? $rolesArray[0] : null;
                    },
                    function($rolesString) {
                        return [$rolesString];
                    }
                ));

        $builder->get('avatar')
                ->addModelTransformer(new CallbackTransformer(
                    function($avatarString) {
                        return strlen($avatarString) ? new File($avatarString) : null;
                    },
                    function($avatarFile) {
                        return $avatarFile;
                    }
                ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
