<?php

declare(strict_types=1);

namespace RealEstate\Comments;

class CommentsDto 
{
    public int $commentId;
    public string $comment;
    public int $propertyId;
    public int $clientId;
    public string $commentTime;
    public string $commentDate;
    public int $commentStatus;
    public int $adminId;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->commentId = (int) ($row["comment_id"] ?? 0);
        $this->comment = $row["comment"] ?? "";
        $this->propertyId = (int) ($row["property_id"] ?? 0);
        $this->clientId = (int) ($row["client_id"] ?? 0);
        $this->commentTime = $row["comment_time"] ?? "";
        $this->commentDate = $row["comment_date"] ?? "";
        $this->commentStatus = (int) ($row["comment_status"] ?? 0);
        $this->adminId = (int) ($row["admin_id"] ?? 0);
    }
}