<?php

declare(strict_types=1);

namespace RealEstate\Tests\Clients;

use PHPUnit\Framework\TestCase;
use RealEstate\Clients\{ ClientsDto, ClientsModel };

class ClientsModelTest extends TestCase
{
    private array $input;
    private ClientsDto $dto;
    private ClientsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "client_id" => 3128,
            "client_name" => "work",
            "client_contact" => "world",
            "client_email" => "annettelara@example.org",
            "client_address" => "experience",
            "client_image" => "Security shoulder amount husband.",
            "client_fb_account" => "large",
            "username" => "arm",
            "password" => "art",
        ];
        $this->dto = new ClientsDto($this->input);
        $this->model = new ClientsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new ClientsModel(null);

        $this->assertInstanceOf(ClientsModel::class, $model);
    }

    public function testGetClientId(): void
    {
        $this->assertEquals($this->dto->clientId, $this->model->getClientId());
    }

    public function testSetClientId(): void
    {
        $expected = 5937;
        $model = $this->model;
        $model->setClientId($expected);

        $this->assertEquals($expected, $model->getClientId());
    }

    public function testGetClientName(): void
    {
        $this->assertEquals($this->dto->clientName, $this->model->getClientName());
    }

    public function testSetClientName(): void
    {
        $expected = "thus";
        $model = $this->model;
        $model->setClientName($expected);

        $this->assertEquals($expected, $model->getClientName());
    }

    public function testGetClientContact(): void
    {
        $this->assertEquals($this->dto->clientContact, $this->model->getClientContact());
    }

    public function testSetClientContact(): void
    {
        $expected = "eat";
        $model = $this->model;
        $model->setClientContact($expected);

        $this->assertEquals($expected, $model->getClientContact());
    }

    public function testGetClientEmail(): void
    {
        $this->assertEquals($this->dto->clientEmail, $this->model->getClientEmail());
    }

    public function testSetClientEmail(): void
    {
        $expected = "davidwhite@example.com";
        $model = $this->model;
        $model->setClientEmail($expected);

        $this->assertEquals($expected, $model->getClientEmail());
    }

    public function testGetClientAddress(): void
    {
        $this->assertEquals($this->dto->clientAddress, $this->model->getClientAddress());
    }

    public function testSetClientAddress(): void
    {
        $expected = "rock";
        $model = $this->model;
        $model->setClientAddress($expected);

        $this->assertEquals($expected, $model->getClientAddress());
    }

    public function testGetClientImage(): void
    {
        $this->assertEquals($this->dto->clientImage, $this->model->getClientImage());
    }

    public function testSetClientImage(): void
    {
        $expected = "Glass forward current floor house maintain.";
        $model = $this->model;
        $model->setClientImage($expected);

        $this->assertEquals($expected, $model->getClientImage());
    }

    public function testGetClientFbAccount(): void
    {
        $this->assertEquals($this->dto->clientFbAccount, $this->model->getClientFbAccount());
    }

    public function testSetClientFbAccount(): void
    {
        $expected = "medical";
        $model = $this->model;
        $model->setClientFbAccount($expected);

        $this->assertEquals($expected, $model->getClientFbAccount());
    }

    public function testGetUsername(): void
    {
        $this->assertEquals($this->dto->username, $this->model->getUsername());
    }

    public function testSetUsername(): void
    {
        $expected = "finally";
        $model = $this->model;
        $model->setUsername($expected);

        $this->assertEquals($expected, $model->getUsername());
    }

    public function testGetPassword(): void
    {
        $this->assertEquals($this->dto->password, $this->model->getPassword());
    }

    public function testSetPassword(): void
    {
        $expected = "fish";
        $model = $this->model;
        $model->setPassword($expected);

        $this->assertEquals($expected, $model->getPassword());
    }

    public function testToDto(): void
    {
        $this->assertEquals($this->dto, $this->model->toDto());
    }

    public function testJsonSerialize(): void
    {
        $this->assertEquals($this->input, $this->model->jsonSerialize());
    }
}