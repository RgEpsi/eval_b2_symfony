<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\Positive;
class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('date')
            ->add('status')
            ->add('informations')
            ->add('category', ChoiceType::class, [
                'choices'  => [
                    'Concert' => 'concert',
                    'Conférence' => 'conference',
                    'Atelier' => 'atelier',
                    'Sport' => 'sport',
                ],
            ])
            ->add('NbPlaces', null, [
                'constraints' => [new Positive()], 
            ])
            ->add('image', FileType::class, [
                'label' => 'Image à la une',
                'mapped' => false, 
                'required' => false,
            ])
                ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
