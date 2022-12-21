<?php


defined('Sp5Rc08l2TtOjxxSIiCf') or die();

class VServerPacket
{
    private $masterdatabase;
    private $config;

    public function __construct($masterdatabase, $config)
    {
        $this->masterdatabase = $masterdatabase;
        $this->config = $config;
    }

    public function create($sortid, $cores, $memory, $disk, $price, $title, $description)
    {
        $this->masterdatabase->insert("vserver_packets", [
            "title" => $title,
            "description" => $description,
            "sortid" => $sortid,
            "cores" => $cores,
            "memory" => $memory,
            "disk" => $disk,
            "price" => $price,
        ]);
    }

    public function delete($id)
    {
        
        $this->masterdatabase->update("vserver_main", [
            "packet" => null,
        ], [
            "packet" => $id,
        ]);
        $this->masterdatabase->delete("vserver_packets", [
            "id" => $id,
        ]);
    }

    public function getall()
    {
        return $this->masterdatabase->select("vserver_packets", [
            "title",
            "description",
            "id",
            "sortid",
            "cores",
            "memory",
            "disk",
            "price",
            "created_on",
            "active",
            "normal"
        ], [
            "ORDER" => ["sortid" => "ASC"],
            "active" => 1,
            "normal" => [1,4],
        ]);
    }
    public function getbyid($id)
    {
        return $this->masterdatabase->select("vserver_packets", [
            "title",
            "description",
            "id",
            "sortid",
            "cores",
            "memory",
            "disk",
            "price",
            "created_on",
            "active",
            "normal"
        ], [
            "id" => $id,
        ])[0];
    }


    public function getbyNormal()
    {
        return $this->masterdatabase->select("vserver_packets", [
            "title",
            "description",
            "id",
            "sortid",
            "cores",
            "memory",
            "disk",
            "price",
            "created_on",
            "active",
        ], [
            "normal" => 2,
        ]);
    }
    public function getbyida($id)
    {
        return $this->masterdatabase->select("vserver_packets", [
            "title",
            "description",
            "id",
            "sortid",
            "cores",
            "memory",
            "disk",
            "price",
            "created_on",
            "active",
        ], [
            "id" => $id,
        ]);
    }

    public function update($id, $sortid, $cores, $memory, $disk, $price, $title, $description)
    {
        $this->masterdatabase->update("vserver_packets", [
            "title" => $title,
            "description" => $description,
            "sortid" => $sortid,
            "cores" => $cores,
            "memory" => $memory,
            "disk" => $disk,
            "price" => $price,
        ], [
            "id" => $id,
        ]);
    }

}
