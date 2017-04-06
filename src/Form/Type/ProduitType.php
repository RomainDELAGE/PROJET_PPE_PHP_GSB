<?php

namespace PPE_PHP_GSB\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('nom', 'text') 
            ->add('dosage', 'number')
            ->add('prix', 'number')
            ->add('contreIndication', 'textarea')
            ->add('effetTherapeutique', 'textarea')
            ->add('idFamille', 'choice', array(
                'choices' => array(
                    null => '-- Sélectionner une famille --',
                    1 => 'Calmants', 
                    2 => 'Antalgiques antipyretiques en association',
                    3 => 'Antidepresseur d\'action centrale',
                    4 => 'Antivertigineux antihistaminique H1',
                    5 => 'Antibiotique antituberculeux',
                    6 => 'Antibiotique antiacneique local',
                    7 => 'Antibiotique de la famille des beta-lactamines ',
                    8 => 'Antibiotique de la famille des cyclines',
                    9 => 'Antibiotique de la famille des macrolides',
                    10 => 'Antihistaminique H1 local',
                    11 => 'Antidepresseur imipraminique (tricyclique)',
                    12 => 'Antidepresseur inhibiteur selectif de la recapture',
                    13 => 'Antibiotique local (ORL)',
                    14 => 'Antidepresseur IMAO non selectif',
                    15 => 'Antibiotique ophtalmique',
                    16 => 'Antipsychotique normothymique',
                    17 => 'Antibiotique urinaire minute',
                    18 => 'Corticoïde, antibiotique et antifongique à usage ',
                    19 => 'Hypnotique antihistaminique',
                    20 => 'Psychostimulant, antiasthenique',
                    21 => 'Antalgiques en association',
                    22 => 'Antalgiques antipyretiques en association',
                    23 => ' Antidepresseur d\'action centrale',
                    24 => 'Antivertigineux antihistaminique H1',
                    25 => 'Antibiotique antituberculeux',
                    26 => 'Antibiotique antiacneique local',
                    27 => 'Antibiotique de la famille des beta-lactamines', 
                    28 => 'Antibiotique de la famille des cyclines',
                    29 => 'Antibiotique de la famille des macrolides',
                    30 => 'Antihistaminique H1 local')
            ))
            ;
    }

    public function getName()
    {
        return 'produit';
    }
}