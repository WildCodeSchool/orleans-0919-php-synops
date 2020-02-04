<?php

namespace App\Form;

use App\Entity\Team;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class TeamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('phone', TextType::class, [
                'label' => 'Téléphone'
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-Mail'
            ])
            ->add('linkedin', TextType::class, [
                'label' => 'LinkedIn'
            ])
            ->add('description', CKEditorType::class, [
                'label' => 'Carrière'
            ])
            ->add('imageFile', VichImageType::class, [
                'label' => 'Photo',
                'required' => false,
                'delete_label' => 'Supprimer l\'image ?',
                'download_label' => 'Agrandir l\'image'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Team::class,
        ]);
    }
}
