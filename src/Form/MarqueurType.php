<?php
namespace App\Form;

use App\Entity\Marqueur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MarqueurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('latitude', TextType::class, [
                'label' => 'Latitude',
                'attr' => ['placeholder' => 'Entrez la latitude'],
            ])
            ->add('longitude', TextType::class, [
                'label' => 'Longitude',
                'attr' => ['placeholder' => 'Entrez la longitude'],
            ])
            ->add('titre', TextType::class, [
                'label' => 'Titre',
                'attr' => ['placeholder' => 'Entrez le nom du lieu'],
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
                'attr' => ['placeholder' => 'Entrez la description du lieu'],
            ])
            ->add('image', TextType::class, [
                'label' => 'Image',
                'attr' => ['placeholder' => 'Entrez l\'url de l\'image'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Marqueur::class,
        ]);
    }
}
