<?php

namespace App\Form;

use App\Entity\Room;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RoomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('roomArea')
            //Pour que le contenu du champs sol soit le contenu de la constante GROUND
            ->add('roomGround', ChoiceType::class, [
                'choices'=>$this->getChoices()                
    ])
            ->add('roomHeight')
            ->add('roomProjectName')
            ->add('userId')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Room::class,
            //Pour changer l'intitulé au niveau de la langue via le fichier translations
            'translation_domain' =>'formRoom'
        ]);
    }

    //Methode pour récupérer toutes les valeurs de ma constante GROUND dans Project
    public function getChoices(){
        $choices = Room::GROUND;
        $output = [];
        foreach($choices as $k => $v){
            $output[$v] = $k;
        }
        return $output;
     }
}
