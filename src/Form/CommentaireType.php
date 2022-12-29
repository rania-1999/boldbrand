<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Commentaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comm',TextType::class,[
                'attr'=> [
                    'placeholder' => 'Ajouter un commentaire',
                    'class' => 'form-control',
                    'label'=>'Commentaire',
                    'style'=>"position: relative;bottom: 5px;left: 300px;height: 55px;width: 39%;",



                ]])
            ->add('Valider',SubmitType::class,[
                'attr'=> [
                    'style'=>"position: relative;bottom: 5px;left: 300px;",
                ]
            ])


        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
        ]);
    }
}
