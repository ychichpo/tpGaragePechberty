<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Voiture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private  readonly UserPasswordHasherInterface $hasher)
    {
    }
    public function load(ObjectManager $manager): void
    {

        $admin = new User();
        $admin->setEmail('admin@paul.com');
        $admin->setPassword($this->hasher->hashPassword($admin, 'admin_password'));
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPrenom('Paul');
        $admin->setNom('Le garagiste');
        $manager->persist($admin);


        $user1 = new User();
        $user1->setEmail('user@pierre.com');
        $user1->setPassword($this->hasher->hashPassword($user1, 'user_password'));
        $user1->setRoles(['ROLE_USER']);
        $user1->setPrenom('Pierre');
        $user1->setNom('Client1');
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail('user@jack.com');
        $user2->setPassword($this->hasher->hashPassword($user2, 'user_password'));
        $user2->setRoles(['ROLE_USER']);
        $user2->setPrenom('Jack');
        $user2->setNom('Client2');
        $manager->persist($user2);


        $opel = new Voiture();
        $opel->setMarque('Opel');
        $opel->setAnnee('2020');
        $opel->setModele('op5');
        $opel->setUser($user1);
        $manager->persist($opel);

        $mercedes = new Voiture();
        $mercedes->setMarque('Mercedes');
        $mercedes->setAnnee('2000');
        $mercedes->setModele('GLE');
        $mercedes->setUser($user1);
        $manager->persist($mercedes);

        $peugeot = new Voiture();
        $peugeot->setMarque('Peugeot');
        $peugeot->setAnnee('2002');
        $peugeot->setModele('807');
        $peugeot->setUser($user2);
        $manager->persist($peugeot);


        $manager->flush();
    }
}
