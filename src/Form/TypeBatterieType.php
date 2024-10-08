<?php
namespace App\Form;

use App\Entity\TypeBatterie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class TypeBatterieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference', TextType::class, [
                'attr' => ['class' => 'form-control'],  
                'label' => 'Référence', 
                'label_attr' => ['class' => 'fw-bold']  
            ])
            ->add('capacite', IntegerType::class, [
                'attr' => ['class' => 'form-control'],  
                'label' => 'Capacité (en Watts)',  
                'label_attr' => ['class' => 'fw-bold']  
            ])
            ->add('pays', TextType::class, [
                'attr' => ['class' => 'form-control'],  
                'label' => 'Pays',  
                'label_attr' => ['class' => 'fw-bold']  
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TypeBatterie::class,
        ]);
    }
}

