<?php

namespace BorySaintVincentBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $options['user'];

        $builder
            ->add('school_class', EntityType::class, [
                'class' => 'BorySaintVincentBundle:SchoolClass',
                'query_builder' => function (EntityRepository $er) use ($user) {
                    return $er->createQueryBuilder('s')
                        ->where('s.user = :user')
                        ->setParameter('user', $user)
                        ->orderBy('s.name', 'ASC');
                },
                'choice_label' => 'name',
                'label' => 'Classe liée à l\'article',
            ])
            ->add('title', TextType::class, ['label' => 'Titre'])
            ->add('picture', FileType::class, ['label' => 'Image en tête de l\'article'])
            ->add('pictureText', TextType::class, ['label' => 'Titre à afficher sur l\'image'])
            ->add('shortDescription', TextareaType::class, ['label' => 'Petite description de l\'article'])
            ->add('description', TextareaType::class, ['label' => 'Description de l\'article'])
            ->add('submit', SubmitType::class, ['label' => 'Valider']);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BorySaintVincentBundle\Entity\Article',
            'user'       => null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'borysaintvincentbundle_article';
    }


}
