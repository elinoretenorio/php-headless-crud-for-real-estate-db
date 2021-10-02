<?php

declare(strict_types=1);

namespace RealEstate\Tests\Admin;

use PHPUnit\Framework\TestCase;
use RealEstate\Admin\{ AdminDto, AdminModel };

class AdminModelTest extends TestCase
{
    private array $input;
    private AdminDto $dto;
    private AdminModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "admin_id" => 7910,
            "admin_name" => "campaign",
            "admin_contact" => "that",
            "admin_address" => "until",
            "admin_email" => "christina05@example.net",
            "username" => "test",
            "password" => "wife",
        ];
        $this->dto = new AdminDto($this->input);
        $this->model = new AdminModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new AdminModel(null);

        $this->assertInstanceOf(AdminModel::class, $model);
    }

    public function testGetAdminId(): void
    {
        $this->assertEquals($this->dto->adminId, $this->model->getAdminId());
    }

    public function testSetAdminId(): void
    {
        $expected = 3665;
        $model = $this->model;
        $model->setAdminId($expected);

        $this->assertEquals($expected, $model->getAdminId());
    }

    public function testGetAdminName(): void
    {
        $this->assertEquals($this->dto->adminName, $this->model->getAdminName());
    }

    public function testSetAdminName(): void
    {
        $expected = "start";
        $model = $this->model;
        $model->setAdminName($expected);

        $this->assertEquals($expected, $model->getAdminName());
    }

    public function testGetAdminContact(): void
    {
        $this->assertEquals($this->dto->adminContact, $this->model->getAdminContact());
    }

    public function testSetAdminContact(): void
    {
        $expected = "physical";
        $model = $this->model;
        $model->setAdminContact($expected);

        $this->assertEquals($expected, $model->getAdminContact());
    }

    public function testGetAdminAddress(): void
    {
        $this->assertEquals($this->dto->adminAddress, $this->model->getAdminAddress());
    }

    public function testSetAdminAddress(): void
    {
        $expected = "next";
        $model = $this->model;
        $model->setAdminAddress($expected);

        $this->assertEquals($expected, $model->getAdminAddress());
    }

    public function testGetAdminEmail(): void
    {
        $this->assertEquals($this->dto->adminEmail, $this->model->getAdminEmail());
    }

    public function testSetAdminEmail(): void
    {
        $expected = "rothmelissa@example.org";
        $model = $this->model;
        $model->setAdminEmail($expected);

        $this->assertEquals($expected, $model->getAdminEmail());
    }

    public function testGetUsername(): void
    {
        $this->assertEquals($this->dto->username, $this->model->getUsername());
    }

    public function testSetUsername(): void
    {
        $expected = "serve";
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
        $expected = "TV";
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