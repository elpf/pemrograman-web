<?php
namespace HotelSystem;

trait SpecialOfferTrait {
    public function calculateSpecialOffer($status) {
        switch ($status) {
            case "VIP":
                return "Free Spa Package";
            case "Regular":
                return "10% off next booking";
            default:
                return "Standard Benefits";
        }
    }
}
?>
