<?php

namespace App\Form;

use DateTime;
use App\Entity\Bookings;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class BookingsType extends AbstractType
{

    
    private function getconfiguration($label,$placeholder,$options = [] ){
        return array_merge ([
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
        ], $options);
   }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if(isset($_GET['date'])){
         $date = $_GET['date'];
        $builder
            ->add('name',TextType::class ,[
                'required' => false,
                'attr' => 
                    [
                        'class' => 'form-control'
                    ]
                
            ], $this->getconfiguration('name','entrer votre name'))
            ->add('email',TextType::class ,
            [
                'required' => false,
                'attr' => 
                    [
                        'class' => 'form-control'
                    ]
                
            ], $this->getconfiguration('timeslot','entrer votre timeslot'))
            ->add('timeslot',TextType::class , [
                'required' => false,
                'attr' => 
                    [
                        'class' => 'form-control',
                        'id' => 'timeslot'
                    ]
                
            ])
            ->add('date',HiddenType::class, [
               
                'attr' => 
                    [ 
                        'value' => $date
                    ]
                
            ])
        ;
    }
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bookings::class,
        ]);
    }
}
