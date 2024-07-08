<?php

namespace App\Repository;

use App\Entity\Project;
use App\Repository\Contract\IProjectRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Uid\Uuid;

/**
 * @extends ServiceEntityRepository<Project>
 *
 * @method Project|null find($id, $lockMode = null, $lockVersion = null)
 * @method Project|null findOneBy(array $criteria, array $orderBy = null)
 * @method Project[]    findAll()
 * @method Project[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectRepository extends ServiceEntityRepository implements IProjectRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }

    public function allNotDeleted(): array
    {
        return $this->createQueryBuilder('prj')
            ->where('prj.deletedAt IS NULL')
            ->orderBy('prj.createdAt', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function add(Project $project): void
    {
        $this->getEntityManager()->persist($project);
        $this->getEntityManager()->flush();
    }

    public function findById(Uuid $id): ?Project
    {
        return $this->find($id);
    }

    public function findByTitleAndClient(string $title, string $client): ?Project
    {
        return $this->findOneBy(['title' => $title, 'client' => $client]);
    }

    public function flush(): void
    {
        $this->getEntityManager()->flush();
    }
}
