<?php
namespace HotelSystem;

require_once 'abstract/Entity.php';

class Tamu extends Entity {
    protected $status;
    protected $contactInfo;

    public function __construct($name, $status, $contactInfo) {
        parent::__construct($name);
        $this->status = $status;
        $this->contactInfo = $contactInfo;
    }

    public function getDetails() {
        return "Nama Tamu: $this->name, Status: $this->status, Kontak: $this->contactInfo";
    }

    public function getStatus() {
        return $this->status;
    }
}
?>
