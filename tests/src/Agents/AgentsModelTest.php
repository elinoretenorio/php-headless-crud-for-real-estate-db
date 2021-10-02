<?php

declare(strict_types=1);

namespace RealEstate\Tests\Agents;

use PHPUnit\Framework\TestCase;
use RealEstate\Agents\{ AgentsDto, AgentsModel };

class AgentsModelTest extends TestCase
{
    private array $input;
    private AgentsDto $dto;
    private AgentsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "agent_id" => 1412,
            "agent_name" => "send",
            "agent_contact" => "drop",
            "agent_email" => "harrismichael@example.net",
            "agent_address" => "herself",
            "agent_image" => "Space business there standard physical red.",
            "agent_fb_account" => "as",
            "username" => "color",
            "password" => "would",
        ];
        $this->dto = new AgentsDto($this->input);
        $this->model = new AgentsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new AgentsModel(null);

        $this->assertInstanceOf(AgentsModel::class, $model);
    }

    public function testGetAgentId(): void
    {
        $this->assertEquals($this->dto->agentId, $this->model->getAgentId());
    }

    public function testSetAgentId(): void
    {
        $expected = 2519;
        $model = $this->model;
        $model->setAgentId($expected);

        $this->assertEquals($expected, $model->getAgentId());
    }

    public function testGetAgentName(): void
    {
        $this->assertEquals($this->dto->agentName, $this->model->getAgentName());
    }

    public function testSetAgentName(): void
    {
        $expected = "really";
        $model = $this->model;
        $model->setAgentName($expected);

        $this->assertEquals($expected, $model->getAgentName());
    }

    public function testGetAgentContact(): void
    {
        $this->assertEquals($this->dto->agentContact, $this->model->getAgentContact());
    }

    public function testSetAgentContact(): void
    {
        $expected = "indicate";
        $model = $this->model;
        $model->setAgentContact($expected);

        $this->assertEquals($expected, $model->getAgentContact());
    }

    public function testGetAgentEmail(): void
    {
        $this->assertEquals($this->dto->agentEmail, $this->model->getAgentEmail());
    }

    public function testSetAgentEmail(): void
    {
        $expected = "gallegosjennifer@example.org";
        $model = $this->model;
        $model->setAgentEmail($expected);

        $this->assertEquals($expected, $model->getAgentEmail());
    }

    public function testGetAgentAddress(): void
    {
        $this->assertEquals($this->dto->agentAddress, $this->model->getAgentAddress());
    }

    public function testSetAgentAddress(): void
    {
        $expected = "Mrs";
        $model = $this->model;
        $model->setAgentAddress($expected);

        $this->assertEquals($expected, $model->getAgentAddress());
    }

    public function testGetAgentImage(): void
    {
        $this->assertEquals($this->dto->agentImage, $this->model->getAgentImage());
    }

    public function testSetAgentImage(): void
    {
        $expected = "Better behind hot dark range buy.";
        $model = $this->model;
        $model->setAgentImage($expected);

        $this->assertEquals($expected, $model->getAgentImage());
    }

    public function testGetAgentFbAccount(): void
    {
        $this->assertEquals($this->dto->agentFbAccount, $this->model->getAgentFbAccount());
    }

    public function testSetAgentFbAccount(): void
    {
        $expected = "ball";
        $model = $this->model;
        $model->setAgentFbAccount($expected);

        $this->assertEquals($expected, $model->getAgentFbAccount());
    }

    public function testGetUsername(): void
    {
        $this->assertEquals($this->dto->username, $this->model->getUsername());
    }

    public function testSetUsername(): void
    {
        $expected = "arm";
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
        $expected = "million";
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