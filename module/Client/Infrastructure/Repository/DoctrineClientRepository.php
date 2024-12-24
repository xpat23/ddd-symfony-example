<?php

declare(strict_types=1);

namespace Client\Infrastructure\Repository;

use Client\Domain\Entity\Client;
use Client\Domain\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

readonly class DoctrineClientRepository implements ClientRepository
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function add(Client $client): void
    {
        $this->em->persist($client);
        $this->em->flush();
    }

    public function update(Client $client): void
    {
        $this->em->persist($client);
        $this->em->flush();
    }

    public function findById(int $id): ?Client
    {
        return $this->createQueryBuilder('c')
            ->where('c.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    private function createQueryBuilder(string $alias): QueryBuilder
    {
        return $this->em
            ->createQueryBuilder()
            ->select($alias)
            ->from(Client::class, $alias);
    }
}