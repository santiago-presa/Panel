<?php

namespace AppBundle\Form;

use AppBundle\Entity\Correo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmailFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('para',  HiddenType::class, array(
                'data' => 'santiago.presa@gmail.com',
            ))
            ->add('desde',  HiddenType::class, array(
                'data' => 'contacto@nicolaspresa.com',
            ))
            ->add('asunto', TextType::class)
            ->add('descripcion', TextareaType::class)
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Correo::class,
        ));

    }

    public function getName()
    {
        return 'app_bundle_email_form_type';
    }
}
