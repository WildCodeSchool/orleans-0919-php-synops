<?php

namespace App\Form;

use App\Entity\Tool;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ToolType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', null, ['choice_label' => 'sector', 'label' => 'Le nom des catégories'])
            ->add('name', TextType::class, ['label' => "Le nom de la catégorie"]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tool::class,
        ]);
    }
}
