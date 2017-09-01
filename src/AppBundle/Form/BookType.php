<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 9/1/2017
 * Time: 12:34 PM
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class BookType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, ['attr' => ['autofocus' => true]])
            ->add('authors', null)
            ->add('genre', null)
            ->add('publisher', null)
            ->add('publication_date', null)
            ->add('pages', null)
            ->add('price', null)
            ->add('action_price', null, ['required' => false])
            ->add('submit', SubmitType::class);
    }
}
