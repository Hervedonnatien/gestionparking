<?php

namespace App\Form;

use App\Entity\Paiement;
use App\Entity\Proprietaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaiementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('proprietaire',EntityType::class,[
                'class'=>Proprietaire::class,
                'choice_label'=>'nomProprietaire',
                'attr'=>[
                    'class'=>'custom-select'
                ]
            ])
            ->add('dateDebut')
            ->add('dateFin')
            ->add('modePaiement')
            ->add('montant');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Paiement::class,
        ]);
    }
}
