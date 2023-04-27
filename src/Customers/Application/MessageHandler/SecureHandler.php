<?php

namespace App\Customers\Application\MessageHandler;

use App\Customers\Application\Message\UserRegistration;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsMessageHandler(priority: 128)]
class SecureHandler{

    public function __construct(private UserPasswordHasherInterface $userPasswordHasher){
    }

    public function __invoke(UserRegistration $userRegistration)
    {
        $userRegistration->user->setPassword(
            $this->userPasswordHasher->hashPassword(
                $userRegistration->user,
                $userRegistration->form->get('plainPassword')->getData()
            )
        );
    }
}