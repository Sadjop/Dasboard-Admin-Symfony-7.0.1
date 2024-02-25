<?php

namespace App\Form;

use App\Entity\Favlist;
use App\Entity\Product;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FavlistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('listName')
                    ->add('product', EntityType::class, [
                        'class' => Product::class,
                        'choice_label' => 'product_title',
                        'multiple' => true,
                        'expanded' => true,
                    ]);


                    // ->add('user', EntityType::class, [
                    //     'class' => User::class,
                    //     'choice_label' => 'id',
                    //     'data' => $options['user'], 
                    // ]);
    }



            public function configureOptions(OptionsResolver $resolver): void
            {
                $resolver->setDefaults([
                    'data_class' => Favlist::class,
                ]);
            }

}
