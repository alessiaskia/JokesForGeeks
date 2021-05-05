<?php

namespace App\Form;

use App\Entity\Joke;
use App\Entity\Gadget;

use App\Entity\OrderDetail;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

//form types
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class OrderDetailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('color', ChoiceType::class, [
                'choices'  => [
                    'Black' => 'black',
                    'White' => 'white',
                    'Red' => 'red',
                    'Blue' => 'blue',
                ],
                'expanded' => true,
                'multiple' => false,
                'attr' => ['class' => 'd-flex'],
            ])
            ->add('size', ChoiceType::class, [
                'choices'  => [
                    'XS' => 'xs',
                    'S' => 's',
                    'M' => 'm',
                    'L' => 'l',
                    'XL' => 'xl',
                    '2XL' => '2xl',
                ],
                'expanded' => true,
                'multiple' => false,
                'attr' => ['class' => 'd-flex'],
            ])

            ->add('joke', EntityType::class, [
                'class' => Joke::class,
                'choice_label' => 'setup',
            ])

            ->add('gadget', EntityType::class, [
                'class' => Gadget::class,
                'choice_label' => 'type',
            ]);

        // ->add('joke', TextType::class)
        // ->add('gadget', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => OrderDetail::class,
        ]);
    }
}
