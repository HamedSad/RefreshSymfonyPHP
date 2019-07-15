<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('productName')
            ->add('productPrice')
            ->add('productUrlImage')
            ->add('productType', ChoiceType::class, [
                'choices'=>$this->getChoices()
                
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
            //Pour changer l'intitulé au niveau de la langue via le fichier translations
            'translation_domain' =>'formRoom'
        ]);
    }

    //Methode pour récupérer toutes les valeurs de ma constante GROUND dans Project
    public function getChoices(){
        $choices = Product::PRODUCT_TYPE;
        $output = [];
        foreach($choices as $k => $v){
            $output[$v] = $k;
        }
        return $output;
     }
}
