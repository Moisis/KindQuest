<?php

require_once __DIR__ . "/../../enums/AccountTypes.php";
require_once __DIR__ . "/../../enums/DonationMethodTypes.php";
require_once __DIR__ . "/../../enums/DonationMethodTypes.php";
require_once __DIR__ . "/../../models/Donation/Donation.php";
class AdminDonationsController
{
    public function index() {
        session_regenerate_id();

        $donations = Donation::getAllDonations();

        require_once dirname(__DIR__, 2) . "/views/admin/admin_donations.php";
    }
}