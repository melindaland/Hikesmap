<?php

// src/Form/ParcoursType.php

// src/Form/ParcoursType.php

namespace App\Form;

use App\Entity\Parcours;
use App\Entity\Marqueur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParcoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Parcours',
                'attr' => ['placeholder' => 'Entrez le nom du parcours'],
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
                'attr' => ['placeholder' => 'Entrez une description'],
            ])
            ->add('marqueurs', EntityType::class, [
                'class' => Marqueur::class,
                'choice_label' => 'titre',  
                'multiple' => true, 
                'expanded' => true,
                'attr' => ['class' => 'marqueur-checkboxes'], 
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Parcours::class,
        ]);
    }
}
