<?php

require_once  dirname(__DIR__, 2).'/models/Donation/Donation.php';
require_once  dirname(__DIR__, 2).'/models/Donation/DonationByCash.php';
require_once  dirname(__DIR__, 2).'/models/Donation/DonationByFawry.php';
require_once  dirname(__DIR__, 2).'/models/Donation/DonationByVisa.php';

class DonationController
{
    public function index() {
        // TODO: add the view path
        require_once dirname(__DIR__, 2) . '';
    }

    public static function donate(array $donationData) {
        $donationStrategy = null;

        // Set the appropriate auth strategy based on user type
        if ($donationData['donation_method'] == 1) {
            $donationStrategy = new DonationByVisa();
        } elseif ($donationData['donation_method'] == 2) {
            $donationStrategy = new DonationByFawry();
        } elseif ($donationData['donation_method'] == 3) {
            $donationStrategy = new DonationByCash();
        }

        $donation = new Donation($donationStrategy);
        $donation->makeDonation($donationData['amount'], $donationData['event_id'], $donationData['account_id']);
    }

    public function getUserDonations(int $user_id) {
        Donation::getAllDonationsByUser($user_id);
}

    public function getEventDonations($eventId)
    {
        Donation::getAllDonationsToEvent($eventId);
    }

}