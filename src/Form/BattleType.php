<?php

declare(strict_types=1);

namespace App\Form;

use App\Model\Ships;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Sodium\add;

class BattleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $ships = $options['ships'];

        $ships1 = [];
        foreach ($ships as $ship) {
            $ships1[$ship->getName()] = $ship->getName();
        }

        $builder
            ->add(
                'ship1',
                ChoiceType::class,
                [
                    'choices' => [
                        $ships1
                    ],
                    'label' => 'Ship: ',
                ],
            )
            ->add('Quantity', TextType::class);

        $builder
            ->add(
                'ship2',
                ChoiceType::class,
                [
                    'choices' => [
                        $ships1
                    ],
                    'label' => 'Ship: '
                ],
            )
            ->add('Quantity:', TextType::class)

            ->add('Engage', SubmitType::class, ['label' => 'Engage!']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'ships' => ''
            ]
        );
    }

}