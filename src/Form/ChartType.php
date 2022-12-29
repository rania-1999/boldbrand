<?php

namespace App\Form;

use App\Entity\Chart;
use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ChartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('docch',Filetype::class,[
                'label'=>'chart',
                'mapped'=> false,'attr'=>array( 'style' => 'line-height: 20px;',
                ' padding: 15px 100px;',
      'margin:10px 4px;',
      'cursor: pointer;',
      'text-transform: uppercase;',
      'text-align: center;',
      'position: relative;',)

            ])
          //  ->add('datecreation')
            ->add('client',EntityType::class, [

                'class'=>Client::class,
                'choice_label'=>'username','attr'=>array('class'=>'form-control1')
            ])              ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Chart::class,
        ]);
    }
}
