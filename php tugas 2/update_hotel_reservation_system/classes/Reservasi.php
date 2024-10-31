<?php
namespace HotelSystem;

require_once 'Tamu.php';
require_once 'traits/SpecialOfferTrait.php';

class Reservasi extends Tamu {
    use SpecialOfferTrait;

    private $kamar;
    private $nights;
    private $specialOffer;

    public function __construct($name, $status, $contactInfo, $kamar, $nights) {
        parent::__construct($name, $status, $contactInfo);
        $this->kamar = $kamar;
        $this->nights = $nights;
        $this->specialOffer = $this->calculateSpecialOffer($status);
    }

    public function calculateTotalPrice() {
        return $this->kamar->getPrice() * $this->nights;
    }

    // Magic method __toString untuk menampilkan detail reservasi
    public function __toString() {
        return "Reservasi Kamar\n" .
               "Tamu: {$this->name}, Status: {$this->status}, Kontak: {$this->contactInfo}\n" .
               "{$this->kamar->getDetails()}\n" .
               "Lama Menginap: {$this->nights} malam\n" .
               "Total Biaya: Rp " . $this->calculateTotalPrice() . "\n" .
               "Penawaran Khusus: {$this->specialOffer}\n";
    }
}
?>
