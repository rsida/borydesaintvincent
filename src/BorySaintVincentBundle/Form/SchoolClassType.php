<?php

namespace BorySaintVincentBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class SchoolClassType
 * @package BorySaintVincentBundle\Form
 */
class SchoolClassType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('user', EntityType::class, [
                'class' => 'UserBundle:User',
                'query_builder' => function ($repository) {
                    return $repository
                        ->createQueryBuilder('u')
                        ->where('u.roles LIKE :roles')
                        ->orderBy('u.username', 'ASC')
                        ->setParameter('roles', '%ROLE_PROFESSOR%');
                },
                'choice_label' => 'username',
            ])
            ->add('submit', SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BorySaintVincentBundle\Entity\SchoolClass'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'borysaintvincentbundle_schoolclass';
    }


}
