<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Manager;

use App\Entity\Comment;
use App\Entity\Figure;
use App\Repository\CommentRepository;
use DateTime;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\Security\Core\Security;

/**
 * Class CommentManager.
 */
class CommentManager
{
    /**
     * A CommentRepository Instance
     *
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     * A SnowboarderManager Instance
     *
     * @var SnowboarderManager
     */
    private $snowboarderManager;

    /**
     * A Security service Instance
     *
     * @var Security
     */
    private $security;

    /**
     * CommentManager constructor.
     *
     * @param CommentRepository  $commentRepository
     * @param SnowboarderManager $snowboarderManager
     * @param Security           $security
     */
    public function __construct(CommentRepository $commentRepository, SnowboarderManager $snowboarderManager, Security $security)
    {
        $this->commentRepository = $commentRepository;
        $this->snowboarderManager = $snowboarderManager;
        $this->security = $security;
    }

    /**
     * @param Comment $comment
     * @param Figure  $figure
     *
     * @return void
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function createComment(Comment $comment, Figure $figure): void
    {
        $author = $this->security->getUser()->getUsername();
        $snowboarder = $this->snowboarderManager->findSnowboarderBy($author);
        $comment
            ->setFigure($figure)
            ->setSnowboarder($snowboarder)
            ->setCreatedAt(new DateTime())
        ;

        $this->commentRepository->create($comment);
    }
}
