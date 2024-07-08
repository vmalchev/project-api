<?php

namespace App\Repository;

use App\Entity\Project;
use App\Entity\Task;
use App\Repository\Contract\ITaskRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Uid\Uuid;

/**
 * @extends ServiceEntityRepository<Task>
 *
 * @method Task|null find($id, $lockMode = null, $lockVersion = null)
 * @method Task|null findOneBy(array $criteria, array $orderBy = null)
 * @method Task[]    findAll()
 * @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskRepository extends ServiceEntityRepository implements ITaskRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    public function allNotDeleted(): array
    {
        return $this->createQueryBuilder('tsk')
            ->where('tsk.deletedAt IS NULL')
            ->orderBy('tsk.createdAt', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function add(Task $task): void
    {
        $this->getEntityManager()->persist($task);
        $this->getEntityManager()->flush();
    }

    public function findById(Uuid $id): ?Task
    {
        return $this->find($id);
    }

    public function findByNameAndProject(string $name, Project $project): ?Task
    {
        return $this->findOneBy(['name' => $name, 'project_id' => $project->getId()]);
    }

    public function flush(): void
    {
        $this->getEntityManager()->flush();
    }

}
