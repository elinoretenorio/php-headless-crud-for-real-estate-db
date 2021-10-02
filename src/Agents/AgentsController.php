<?php

declare(strict_types=1);

namespace RealEstate\Agents;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class AgentsController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IAgentsService $service;

    public function __construct(IAgentsService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var AgentsModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $agentId = (int) ($args["agent_id"] ?? 0);
        if ($agentId <= 0) {
            return new JsonResponse(["result" => $agentId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var AgentsModel $model */
        $model = $this->service->createModel($data);
        $model->setAgentId($agentId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $agentId = (int) ($args["agent_id"] ?? 0);
        if ($agentId <= 0) {
            return new JsonResponse(["result" => $agentId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var AgentsModel $model */
        $model = $this->service->get($agentId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var AgentsModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $agentId = (int) ($args["agent_id"] ?? 0);
        if ($agentId <= 0) {
            return new JsonResponse(["result" => $agentId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($agentId);

        return new JsonResponse(["result" => $result]);
    }
}