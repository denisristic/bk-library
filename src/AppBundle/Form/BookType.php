<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 9/1/2017
 * Time: 12:34 PM
 */

namespace AppBundle\Form;

use AppBundle\Entity\Book;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class BookType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['attr' => ['autofocus' => true]])
            ->add('authors', EntityType::class,
                array('class'=>'AppBundle:Author',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('a')
                            ->orderBy('a.surname', 'ASC');
                    },
                    'choice_label'=>'surname',
                    'multiple' => true
                    ))
            ->add('genre', EntityType::class,
                array('class'=>'AppBundle:Genre',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('g')
                            ->orderBy('g.genre', 'ASC');
                    },
                    'choice_label'=>'genre'))
            ->add('publisher', EntityType::class,
                array('class'=>'AppBundle:Publisher',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('p')
                            ->orderBy('p.publisher', 'ASC');
                    },
                    'choice_label'=>'publisher'))
            ->add('publication_date', IntegerType::class)
            ->add('pages', IntegerType::class)
            ->add('price', IntegerType::class)
            ->add('action_price', IntegerType::class, ['required' => false])
            ->add('description', TextareaType::class, ['required' => false])
            ->add('imageFile', VichImageType::class, [
                'required' => true,
            ])
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Book::class,
        ));
    }
}