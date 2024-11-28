<?php

namespace App\Form;

use App\Entity\Medicamento;
use App\Enum\EnumTipoEstoque;
use App\Enum\EnumUnidadeEstoque;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MedicamentoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nome', TextType::class, [
                'label' => 'Nome'
            ])
            ->add('anotacao', TextType::class, [
                'label' => 'Anotação pessoal',
                'required' => false
            ])
            ->add('tipo_estoque', ChoiceType::class, [
                'choices' => EnumTipoEstoque::cases(),
                'choice_label' => fn($choice) => $choice->value,
                'placeholder' => 'Selecione',
                'required' => true,
                'label' => 'Tipo'
            ])
            ->add('unidade_estoque', ChoiceType::class, [
                //'attr' => ['class' => 'input input-bordered w-full col-span-1'],
                'choices' => EnumUnidadeEstoque::cases(),
                'choice_label' => fn($choice) => $choice->value,
                'placeholder' => 'Selecione a medida',
                'required' => true,
                'label' => 'Medida'
            ])
            ->add('frequencia_horas', IntegerType::class, [
                'attr' => [
                    'min' => 1,
                    'max' => 24,
                    'step' => 1,
                    'data-value' => "",
                    'data-show-value' => true
                ],
                'label' => 'Frequência em horas'
            ])
            ->add('qtd_estoque', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'Digite a quantidade',
                    'min' => 0
                ],
                'label' => 'Quantia em estoque'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Medicamento::class,
        ]);
    }
}