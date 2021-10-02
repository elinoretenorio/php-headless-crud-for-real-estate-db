<?php

declare(strict_types=1);

namespace RealEstate\Agents;

class AgentsDto 
{
    public int $agentId;
    public string $agentName;
    public string $agentContact;
    public string $agentEmail;
    public string $agentAddress;
    public string $agentImage;
    public string $agentFbAccount;
    public string $username;
    public string $password;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->agentId = (int) ($row["agent_id"] ?? 0);
        $this->agentName = $row["agent_name"] ?? "";
        $this->agentContact = $row["agent_contact"] ?? "";
        $this->agentEmail = $row["agent_email"] ?? "";
        $this->agentAddress = $row["agent_address"] ?? "";
        $this->agentImage = $row["agent_image"] ?? "";
        $this->agentFbAccount = $row["agent_fb_account"] ?? "";
        $this->username = $row["username"] ?? "";
        $this->password = $row["password"] ?? "";
    }
}