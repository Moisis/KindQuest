<?php

require_once  dirname(__DIR__, 2).'/models/Donation/Donation.php';
require_once  dirname(__DIR__, 2).'/models/Donation/DonationByCash.php';
require_once  dirname(__DIR__, 2).'/models/Donation/DonationByFawry.php';
require_once  dirname(__DIR__, 2).'/models/Donation/DonationByVisa.php';

require_once  dirname(__DIR__, 2).'/enums/DonationMethodTypes.php';
class DonationController
{
    public function index() {
        // TODO: add the view path
        require_once dirname(__DIR__, 2) . '';
    }

    public static function donate(array $donationData) {
        $donationStrategy = null;

        // Set the appropriate auth strategy based on user type
        if ($donationData['donation_method'] == DonationMethodTypes::Visa->value) {
            $donationStrategy = new DonationByVisa();
        } elseif ($donationData['donation_method'] == DonationMethodTypes::Fawry->value) {
            $donationStrategy = new DonationByFawry();
        } elseif ($donationData['donation_method'] == DonationMethodTypes::Cash->value) {
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