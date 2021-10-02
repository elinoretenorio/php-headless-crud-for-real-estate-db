<?php

declare(strict_types=1);

namespace RealEstate\Comments;

interface ICommentsService
{
    public function insert(CommentsModel $model): int;

    public function update(CommentsModel $model): int;

    public function get(int $commentId): ?CommentsModel;

    public function getAll(): array;

    public function delete(int $commentId): int;

    public function createModel(array $row): ?CommentsModel;
}