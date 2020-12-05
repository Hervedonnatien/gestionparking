<?php

namespace App\Form;

use App\Entity\Voiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numVoiture')
            ->add('cooperative')
            ->add('typeVoiture')
            ->add('ligne')
            ->add('visuel')
            ->add('nomProprietaire')
            //Ajout d'une image
            ->add('image', FileType::class, [
                'mapped' => true,
                'multiple' => false,
                'required' => true,

            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
