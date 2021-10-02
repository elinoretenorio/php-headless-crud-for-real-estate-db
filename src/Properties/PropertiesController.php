<?php

declare(strict_types=1);

namespace RealEstate\Properties;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class PropertiesController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IPropertiesService $service;

    public function __construct(IPropertiesService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var PropertiesModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $propertyId = (int) ($args["property_id"] ?? 0);
        if ($propertyId <= 0) {
            return new JsonResponse(["result" => $propertyId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var PropertiesModel $model */
        $model = $this->service->createModel($data);
        $model->setPropertyId($propertyId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $propertyId = (int) ($args["property_id"] ?? 0);
        if ($propertyId <= 0) {
            return new JsonResponse(["result" => $propertyId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var PropertiesModel $model */
        $model = $this->service->get($propertyId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var PropertiesModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $propertyId = (int) ($args["property_id"] ?? 0);
        if ($propertyId <= 0) {
            return new JsonResponse(["result" => $propertyId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($propertyId);

        return new JsonResponse(["result" => $result]);
    }
}