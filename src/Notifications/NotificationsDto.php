<?php

declare(strict_types=1);

namespace RealEstate\Notifications;

class NotificationsDto 
{
    public int $notificationId;
    public string $notificationName;
    public string $notificationDescription;
    public int $adminId;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->notificationId = (int) ($row["notification_id"] ?? 0);
        $this->notificationName = $row["notification_name"] ?? "";
        $this->notificationDescription = $row["notification_description"] ?? "";
        $this->adminId = (int) ($row["admin_id"] ?? 0);
    }
}