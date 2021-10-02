<?php

declare(strict_types=1);

namespace RealEstate\Comments;

class CommentsService implements ICommentsService
{
    private ICommentsRepository $repository;

    public function __construct(ICommentsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(CommentsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(CommentsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $commentId): ?CommentsModel
    {
        $dto = $this->repository->get($commentId);
        if ($dto === null) {
            return null;
        }

        return new CommentsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var CommentsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new CommentsModel($dto);
        }

        return $result;
    }

    public function delete(int $commentId): int
    {
        return $this->repository->delete($commentId);
    }

    public function createModel(array $row): ?CommentsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new CommentsDto($row);

        return new CommentsModel($dto);
    }
}