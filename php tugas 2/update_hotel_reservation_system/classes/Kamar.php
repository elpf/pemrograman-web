<?php
namespace HotelSystem;

require_once 'abstract/Entity.php';

class Kamar extends Entity {
    private $price;
    private $roomNumber;

    public function __construct($name, $price, $roomNumber) {
        parent::__construct($name);
        $this->price = $price;
        $this->roomNumber = $roomNumber;
    }

    public function getDetails() {
        return "Tipe Kamar: $this->name, Harga per Malam: Rp $this->price, Nomor Kamar: $this->roomNumber";
    }

    public function getPrice() {
        return $this->price;
    }
}
?>
