<?php

namespace App\Form;

use App\Entity\Proprietaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProprietaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomProprietaire')
            ->add('numTelephone')
            ->add('adresse')
            ->add('autreContact')
            ->add('idPaiement');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Proprietaire::class,
        ]);
    }
}