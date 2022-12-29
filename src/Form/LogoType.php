<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Logo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class LogoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imglg',FileType::class,[
                'label'=>'Image',
                'mapped'=> false

            ])
           // ->add('datecreation')
            ->add('client',EntityType::class, [

               'class'=>Client::class,
                'choice_label'=>'username','attr'=>array('class'=>'form-control1')
            ])        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Logo::class,
        ]);
    }
}
