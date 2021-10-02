<?php

declare(strict_types=1);

namespace RealEstate\Comments;

interface ICommentsRepository
{
    public function insert(CommentsDto $dto): int;

    public function update(CommentsDto $dto): int;

    public function get(int $commentId): ?CommentsDto;

    public function getAll(): array;

    public function delete(int $commentId): int;
}