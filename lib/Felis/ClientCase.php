<?php


namespace Felis;


class ClientCase{
    const STATUS_OPEN = "O";	///< Case is open
    const STATUS_CLOSED = "C";  ///< Case is closed

    public function __construct($row) {
       $this->id = $row['id'];
       $this->client = $row['client'];
       $this->clientName = $row['clientName'];
       $this->agent = $row['agent'];
       $this->agentName = $row['agentName'];
       $this->number = $row['number'];
       $this->summary = $row['summary'];
       $this->status = $row['status'];

    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @return mixed
     */
    public function getClientName()
    {
        return $this->clientName;
    }

    /**
     * @return mixed
     */
    public function getAgent()
    {
        return $this->agent;
    }

    /**
     * @return mixed
     */
    public function getAgentName()
    {
        return $this->agentName;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return mixed
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }





    private $id;
    private $client;
    private $clientName;
    private $agent;
    private $agentName;
    private $number;
    private $summary;
    private $status;
}