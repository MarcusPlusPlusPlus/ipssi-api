<?php

namespace App\Form;

use Ramsey\Uuid\Uuid;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("location_id", TextType::class, array(
                'label' => 'ID Location',
                'csrf_protection' => false
            ))
            ->add("date", DateType::class, array(
                'label' => 'Date',
                'csrf_protection' => false
                ))
            ->add("name", TextType::class, array(
                'label' => 'Nom',
                'csrf_protection' => false
                ));
    }
}
