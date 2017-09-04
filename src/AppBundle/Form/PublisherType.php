<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 9/3/2017
 * Time: 3:07 PM
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;


class PublisherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('publisher', TextType::class)
            ->add('submit', SubmitType::class, array('label' => 'Add Publisher'));
    }
}