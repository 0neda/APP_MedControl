<?php

namespace App\Form;

use App\Entity\Medicamento;
use App\Enum\EnumTipoEstoque;
use App\Enum\EnumUnidadeEstoque;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MedicamentoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nome')
            ->add('anotacao')
            ->add('tipo_estoque', ChoiceType::class, [
                'choices' => EnumTipoEstoque::cases(),
                'choice_label' => fn($choice) => $choice->value,
                'placeholder' => 'Selecione',
                'required' => true,
                'label' => 'Tipo de Estoque'
            ])
            ->add('unidade_estoque', ChoiceType::class, [
                'choices' => EnumUnidadeEstoque::cases(),
                'choice_label' => fn($choice) => $choice->value,
                'placeholder' => 'Selecione',
                'required' => true,
                'label' => 'Unidade de Estoque'
            ])
            ->add('frequencia_horas')
            ->add('qtd_estoque')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Medicamento::class,
        ]);
    }
}