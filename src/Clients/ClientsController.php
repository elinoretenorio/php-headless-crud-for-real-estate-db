<?php

declare(strict_types=1);

namespace RealEstate\Clients;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class ClientsController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IClientsService $service;

    public function __construct(IClientsService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var ClientsModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $clientId = (int) ($args["client_id"] ?? 0);
        if ($clientId <= 0) {
            return new JsonResponse(["result" => $clientId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var ClientsModel $model */
        $model = $this->service->createModel($data);
        $model->setClientId($clientId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $clientId = (int) ($args["client_id"] ?? 0);
        if ($clientId <= 0) {
            return new JsonResponse(["result" => $clientId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var ClientsModel $model */
        $model = $this->service->get($clientId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var ClientsModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $clientId = (int) ($args["client_id"] ?? 0);
        if ($clientId <= 0) {
            return new JsonResponse(["result" => $clientId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($clientId);

        return new JsonResponse(["result" => $result]);
    }
}