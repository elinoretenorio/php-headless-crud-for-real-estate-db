<?php

declare(strict_types=1);

namespace RealEstate\Admin;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class AdminController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IAdminService $service;

    public function __construct(IAdminService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var AdminModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $adminId = (int) ($args["admin_id"] ?? 0);
        if ($adminId <= 0) {
            return new JsonResponse(["result" => $adminId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var AdminModel $model */
        $model = $this->service->createModel($data);
        $model->setAdminId($adminId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $adminId = (int) ($args["admin_id"] ?? 0);
        if ($adminId <= 0) {
            return new JsonResponse(["result" => $adminId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var AdminModel $model */
        $model = $this->service->get($adminId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var AdminModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $adminId = (int) ($args["admin_id"] ?? 0);
        if ($adminId <= 0) {
            return new JsonResponse(["result" => $adminId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($adminId);

        return new JsonResponse(["result" => $result]);
    }
}