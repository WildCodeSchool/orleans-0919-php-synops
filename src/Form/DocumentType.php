<?php

namespace App\Form;

use App\Entity\Document;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class DocumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tool', null, ['choice_label' => 'name',
                'label' => 'Sous-catégorie'])
            ->add('name', TextareaType::class, ['label' => "Nom de l'outil"])
            ->add('description', TextareaType::class, ['label' => "Description de l'outil"])
            ->add('file', VichFileType::class, [
                'label' => 'Fichier',
                'required' => false,
                'delete_label' => 'Supprimer le fichier',
                'download_label' => 'Voir le fichier'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Document::class,
        ]);
    }
}
