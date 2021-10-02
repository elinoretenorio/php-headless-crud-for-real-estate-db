<?php

declare(strict_types=1);

namespace RealEstate\Notifications;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class NotificationsController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private INotificationsService $service;

    public function __construct(INotificationsService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var NotificationsModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $notificationId = (int) ($args["notification_id"] ?? 0);
        if ($notificationId <= 0) {
            return new JsonResponse(["result" => $notificationId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var NotificationsModel $model */
        $model = $this->service->createModel($data);
        $model->setNotificationId($notificationId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $notificationId = (int) ($args["notification_id"] ?? 0);
        if ($notificationId <= 0) {
            return new JsonResponse(["result" => $notificationId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var NotificationsModel $model */
        $model = $this->service->get($notificationId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var NotificationsModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $notificationId = (int) ($args["notification_id"] ?? 0);
        if ($notificationId <= 0) {
            return new JsonResponse(["result" => $notificationId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($notificationId);

        return new JsonResponse(["result" => $result]);
    }
}