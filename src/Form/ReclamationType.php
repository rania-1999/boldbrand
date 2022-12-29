<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Reclamation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type;

class ReclamationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('obj',Type\TextType::class, array(
                'attr' => array('class' => 'form-control', 'style' => 'line-height: 20px;')))
            ->add('msg', Type\TextareaType::class, array(
                'attr' => array('class' => 'form-control', 'style' => 'line-height: 20px;')))
            ->add('response', Type\TextareaType::class, array(
                'attr' => array('class' => 'form-control', 'style' => 'line-height: 20px;')))

         //   ->add('datecreation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reclamation::class,
        ]);
    }
}
