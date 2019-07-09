<?php

namespace App\Form;

use App\Entity\Bathroom;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class BathroomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bathroomArea')
            ->add('bathroomBath' , ChoiceType::class, [
                'choices'=>$this->getChoices2()                
    ])
            ->add('bathroomGround', ChoiceType::class, [
                'choices'=>$this->getChoices()                
    ])
            ->add('bathroomHeight')
            ->add('bathroomProjectName')
            ->add('bathroomShower' , ChoiceType::class, [
                'choices'=>$this->getChoices2()                
    ])
            ->add('bathroomSink' , ChoiceType::class, [
                'choices'=>$this->getChoices2()                
    ])
            ->add('bathroomWC' , ChoiceType::class, [
                'choices'=>$this->getChoices2()                
    ])
            ->add('userId')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bathroom::class,
            //Pour changer l'intitulé au niveau de la langue via le fichier translations
            'translation_domain' =>'formRoom'
        ]);
    }

    //Methode pour récupérer toutes les valeurs de ma constante GROUND dans Project
    public function getChoices(){
        $choices = Bathroom::GROUND;
        $output = [];
        foreach($choices as $k => $v){
            $output[$v] = $k;
        }
        return $output;
     }

     public function getChoices2(){
        $choices = Bathroom::YESNO;
        $output = [];
        foreach($choices as $k => $v){
            $output[$v] = $k;
        }
        return $output;
     }
}
