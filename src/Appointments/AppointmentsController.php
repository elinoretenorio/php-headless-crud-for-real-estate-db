<?php

declare(strict_types=1);

namespace RealEstate\Appointments;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class AppointmentsController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IAppointmentsService $service;

    public function __construct(IAppointmentsService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var AppointmentsModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $appointmentId = (int) ($args["appointment_id"] ?? 0);
        if ($appointmentId <= 0) {
            return new JsonResponse(["result" => $appointmentId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var AppointmentsModel $model */
        $model = $this->service->createModel($data);
        $model->setAppointmentId($appointmentId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $appointmentId = (int) ($args["appointment_id"] ?? 0);
        if ($appointmentId <= 0) {
            return new JsonResponse(["result" => $appointmentId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var AppointmentsModel $model */
        $model = $this->service->get($appointmentId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var AppointmentsModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $appointmentId = (int) ($args["appointment_id"] ?? 0);
        if ($appointmentId <= 0) {
            return new JsonResponse(["result" => $appointmentId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($appointmentId);

        return new JsonResponse(["result" => $result]);
    }
}