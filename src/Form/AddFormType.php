<?php


namespace App\Form;


use App\Entity\Users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Tests\Fixtures\Validation\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class AddFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // username si password sunt numele var post/get din request
        $builder
            ->add("username", TextType::class)
            ->add("password", PasswordType::class)
            ->add("camp_exterior", CountryType::class,[
                "mapped" => false,
                "help" => "Choose a country"
            ])
            ->add('referral', EntityType::class, [
                'class' => Users::class,
                'choice_label' => 'id',
                "help" => "Who told you about us ?"

            ])
        ;
    }


    // set options for form behaviour
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class
        ]);
    }


}