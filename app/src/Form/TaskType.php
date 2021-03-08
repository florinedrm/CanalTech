<?php

namespace App\Form;

use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => 'Titre*',
                'help' => 'jusqu\'à 120 caractères'
            ))
            ->add('startAt', DateTimeType::class, array(
                'label' => 'Date de début*',
                'date_widget' => 'single_text',
                'invalid_message' => 'La date de début est invalide.',
                'time_widget' => 'single_text',
                'data' => new \DateTime()
            ))
            ->add('endAt', DateTimeType::class, array(
                'label' => 'Date de fin*',
                'date_widget' => 'single_text',
                'invalid_message' => 'La date de fin est invalide.',
                'time_widget' => 'single_text',
                'data' => new \DateTime()
            ))
            ->add('project', null, array(
                'label' => 'Projet*',
                'choice_label' => 'name',
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
            'attr' => array(
                'novalidate' => 'novalidate',
            )
        ]);
    }
}
