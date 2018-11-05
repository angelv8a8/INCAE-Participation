<?php

namespace App\Form;

use App\Entity\UserCourseSession;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserCourseSessionReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('teacherNote', ChoiceType::class, array(
                'choices'  => array(
                    '0 - No asistí' => 0,
                    '1 - Asistí pero no realicé los ejercicios ni participé activamente' => 1,
                    '2 - Asistí y realicé los ejercicios' => 2,
                    '3 - Asistí, realicé los ejercicios y participé ocasionalmente' => 3,
                    '4 - Asistí, realicé los ejercicios y constantemente aportando a la discusión' => 4,
                    '5 - Asistí, realicé los ejercicios y constantemente aportando a la discusión' => 5
                ),
                'label' => 'Nota',
                'expanded' => true)
                )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserCourseSession::class,
        ]);
    }
}
