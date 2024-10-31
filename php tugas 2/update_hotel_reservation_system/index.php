<?php
require_once 'classes/Kamar.php';
require_once 'classes/Tamu.php';
require_once 'classes/Reservasi.php';

use HotelSystem\Kamar;
use HotelSystem\Reservasi;

// Inisialisasi data kamar dan reservasi tamu
$kamar = new Kamar("Deluxe", 150000, "101A");
$reservasi = new Reservasi("Jane Doe", "VIP", "08123456789", $kamar, 3);

// Cetak detail reservasi
echo $reservasi;
?>
