<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type;
class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           // ->add('pseudo')
            ->add('password',PasswordType::class, [
               'attr'=> [
                   'placeholder' => 'Entrer votre mot de passe',
                   'class' => 'form-control'
               ]
           ])
              // ->add('image')
            ->add('nom',Type\TextType::class, array(
               'attr' => array('class' => 'form-control', 'style' => 'line-height: 20px;')))
            ->add('prenom',Type\TextType::class, array(
                'attr' => array('class' => 'form-control', 'style' => 'line-height: 20px;')))
            ->add('email',Type\TextType::class, array(
                'attr' => array('class' => 'form-control', 'style' => 'line-height: 20px;')))
            ->add('num',Type\TextType::class, array(
                'attr' => array('class' => 'form-control', 'style' => 'line-height: 20px;')))
            ->add('image',FileType::class,[
                'label'=>'Image',
                'mapped'=> false

            ])            ->add('paye',ChoiceType::class,[
                'choices'=> array(
                    'oui'=>'oui',
                    'non'=>'non',),'attr'=>array('class'=>'form-control1')
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
