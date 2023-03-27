<?php

namespace App\Controller\Sandbox;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/sandbox/securitytest', name: 'sandbox_securitytest')]
class SucrityTestController extends AbstractController
{
    #[Route('/addusers', name: '_addusers')]
    public function addUsersAction(EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $user
            ->setLogin('jarod')
            ->setName('Le Caméléon')
            ->setRoles(['ROLE_CLIENT']);
        $hashedPassword = $passwordHasher->hashPassword($user, 'toto');
        $user->setPassword($hashedPassword);
        $em->persist($user);

        $user = new User();
        $user
            ->setLogin('parker')
            ->setName('Mlle Parker')
            ->setRoles(['ROLE_SALARIE']);
        $hashedPassword = $passwordHasher->hashPassword($user, 'azerty');
        $user->setPassword($hashedPassword);
        $em->persist($user);

        $user = new User();
        $user
            ->setLogin('sidney')
            ->setName('Sidney')
            ->setRoles(['ROLE_SALARIE', 'ROLE_GESTION']);
        $hashedPassword = $passwordHasher->hashPassword($user, 'password');
        $user->setPassword($hashedPassword);
        $em->persist($user);

        $user = new User();
        $user
            ->setLogin('raines')
            ->setName('William Raines')
            ->setRoles(['ROLE_DIRIGEANT']);
        $hashedPassword = $passwordHasher->hashPassword($user, '123456');
        $user->setPassword($hashedPassword);
        $em->persist($user);

        $user = new User();
        $user
            ->setLogin('angelo')
            ->setName('Angelo')
            ->setRoles(['ROLE_GESTION']);
        $hashedPassword = $passwordHasher->hashPassword($user, 'qwerty');
        $user->setPassword($hashedPassword);
        $em->persist($user);

        $em->flush();

        return new Response('<body></body>');
    }
}
