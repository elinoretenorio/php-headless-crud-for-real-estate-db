<?php

declare(strict_types=1);

namespace RealEstate\Tests\Clients;

use PHPUnit\Framework\TestCase;
use RealEstate\Database\DatabaseException;
use RealEstate\Clients\{ ClientsDto, IClientsRepository, ClientsRepository };

class ClientsRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private ClientsDto $dto;
    private IClientsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("RealEstate\Database\IDatabase");
        $this->result = $this->createMock("RealEstate\Database\IDatabaseResult");
        $this->input = [
            "client_id" => 2117,
            "client_name" => "mention",
            "client_contact" => "particularly",
            "client_email" => "ericcase@example.net",
            "client_address" => "agreement",
            "client_image" => "Technology class key rise dog within dinner.",
            "client_fb_account" => "nor",
            "username" => "theory",
            "password" => "sea",
        ];
        $this->dto = new ClientsDto($this->input);
        $this->repository = new ClientsRepository($this->db);
    }

    protected function tearDown(): void
    {
        unset($this->db);
        unset($this->result);
        unset($this->input);
        unset($this->dto);
        unset($this->repository);
    }

    public function testInsert_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testInsert_ReturnsId(): void
    {
        $expected = 4426;

        $sql = "INSERT INTO `clients` (`client_name`, `client_contact`, `client_email`, `client_address`, `client_image`, `client_fb_account`, `username`, `password`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->clientName,
                $this->dto->clientContact,
                $this->dto->clientEmail,
                $this->dto->clientAddress,
                $this->dto->clientImage,
                $this->dto->clientFbAccount,
                $this->dto->username,
                $this->dto->password
            ]);
        $this->db->expects($this->once())
            ->method("lastInsertId")
            ->willReturn($expected);

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsRowCount(): void
    {
        $expected = 2706;

        $sql = "UPDATE `clients` SET `client_name` = ?, `client_contact` = ?, `client_email` = ?, `client_address` = ?, `client_image` = ?, `client_fb_account` = ?, `username` = ?, `password` = ?
                WHERE `client_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->clientName,
                $this->dto->clientContact,
                $this->dto->clientEmail,
                $this->dto->clientAddress,
                $this->dto->clientImage,
                $this->dto->clientFbAccount,
                $this->dto->username,
                $this->dto->password,
                $this->dto->clientId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $clientId = 9164;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($clientId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $clientId = 7466;

        $sql = "SELECT `client_id`, `client_name`, `client_contact`, `client_email`, `client_address`, `client_image`, `client_fb_account`, `username`, `password`
                FROM `clients` WHERE `client_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$clientId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($clientId);
        $this->assertEquals($this->dto, $actual);
    }

    public function testGetAll_ReturnsEmptyOnException(): void
    {
        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->getAll();
        $this->assertEmpty($actual);
    }

    public function testGetAll_ReturnsDtos(): void
    {
        $sql = "SELECT `client_id`, `client_name`, `client_contact`, `client_email`, `client_address`, `client_image`, `client_fb_account`, `username`, `password`
                FROM `clients`";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute");
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->getAll();
        $this->assertEquals([$this->dto], $actual);
    }

    public function testDelete_ReturnsFailedOnException(): void
    {
        $clientId = 3585;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($clientId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $clientId = 5322;
        $expected = 3974;

        $sql = "DELETE FROM `clients` WHERE `client_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$clientId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($clientId);
        $this->assertEquals($expected, $actual);
    }
}