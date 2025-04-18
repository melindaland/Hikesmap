<?php

namespace App\Form;

use App\Entity\ForumMessage;
use App\Entity\ForumSujet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ForumMessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('message')
            ->add('date', null, [
                'widget' => 'single_text',
            ])
            ->add('sujet', EntityType::class, [
                'class' => ForumSujet::class,
                'choice_label' => 'id',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ForumMessage::class,
        ]);
    }
}
