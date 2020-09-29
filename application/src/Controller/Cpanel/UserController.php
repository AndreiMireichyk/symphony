<?php

namespace App\Controller\Cpanel;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/cp", name="cp.user.")
 * Class UserController
 * @package App\Controller\Cpanel
 */
class UserController extends AbstractController
{
    /**
     * @Route("/user", name="index")
     */
    public function index(UserRepository $repository)
    {
        return $this->render('cpanel/user/index.html.twig', [
            'controller_name'=>'controller_name',
            'users' => $repository->findAll()
        ]);
    }

    /**
     * @Route("/user/store", name="store")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return JsonResponse
     * @throws \Exception
     */
    public function store(Request $request, EntityManagerInterface $em, ValidatorInterface $vl){


        $user = new User();
        #$user->setName('Andrew');
        $user->setFullName('Andrew Mireichyk');
        $user->setEmail('andrew@app.com');
        $user->setPassword('password');
        $user->setCreatedAt(new \DateTime());
        $user->setUpdatedAt(new \DateTime());

        $errors = $vl->validate($user);

        if($errors->count()){
            dump((array) $errors);
            return new JsonResponse((array)$errors, 422);
        }

        $em->persist($user);
        $em->flush();

        return new JsonResponse((array)$user, 200);
    }
}
