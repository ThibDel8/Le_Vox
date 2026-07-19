<?php

declare(strict_types=1);

namespace App\Command;

use App\Security\Domain\Entity\User;
use App\Security\Domain\Repository\UserReadRepositoryInterface;
use App\Security\Domain\Repository\UserWriteRepositoryInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:init-user-account',
    description: 'Création du compte Admin.',
)]
class InitializeUserAccountCommand extends Command
{
    public function __construct(
        private readonly string $adminInitUsername,
        private readonly string $adminInitPassword,
        private readonly UserPasswordHasherInterface $hasher,
        private readonly UserReadRepositoryInterface $userReadRepository,
        private readonly UserWriteRepositoryInterface $userWriteRepository,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $user = User::create(username: $this->adminInitUsername);

        $existing = $this->userReadRepository->findByUsername(username: $user->getUserIdentifier());

        if (null !== $existing) {
            $this->userWriteRepository->delete($existing);
        }

        $hashedPassword = $this->hasher->hashPassword(
            user: $user,
            plainPassword: $this->adminInitPassword,
        );

        $user->setPassword($hashedPassword);

        $this->userWriteRepository->save($user);

        $output->writeln('Admin account created.');

        return Command::SUCCESS;
    }
}
