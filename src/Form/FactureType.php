<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Facture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class FactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('facture',Filetype::class,[
                'label'=>'facture',
                'mapped'=> false

            ])
            ->add('client',EntityType::class, [

                'class'=>Client::class,
                'choice_label'=>'username','attr'=>array('class'=>'form-control1')
            ])              ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Facture::class,
        ]);
    }
}
