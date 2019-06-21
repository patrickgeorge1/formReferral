<?php


namespace App\Controller;


use App\Entity\Users;
use App\Form\AddFormType;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;

class MainController extends AbstractController
{

    /**
     * @Route("/", methods={"POST", "GET"}, name="formular")
     */
    public function add(EntityManagerInterface $entityManager, Request $request) {

        // crez forma pe baza clasei sale
        $form = $this->createForm(AddFormType::class);

        // permit formei sa ia informatiile din requesturi
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            // user tine informatia transmisa prin form, si este deja o clasa pt ca am mapat forma la o clasa
            /** @var $user Users */  // ajut php storm sa stie ca e clasa cu get si set
            $user = $form->getData();
            $user->setPassword(sha1($user->getPassword()));

            $entityManager->persist($user);
            $entityManager->flush();
            return new Response($user->getUsername()." ai fost adaugat in baza de date!");
        }
        return $this->render('base.html.twig', [
            'addForm' => $form->createView(),
        ]);
    }

}