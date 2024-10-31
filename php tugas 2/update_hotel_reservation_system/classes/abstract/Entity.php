<?php
namespace HotelSystem;

abstract class Entity {
    protected $name;
    protected $createdAt;

    public function __construct($name) {
        $this->name = $name;
        $this->createdAt = date("Y-m-d H:i:s");
    }
    
    abstract public function getDetails();

    public function getName() {
        return $this->name;
    }

    public function getCreationDate() {
        return $this->createdAt;
    }
}
?>
