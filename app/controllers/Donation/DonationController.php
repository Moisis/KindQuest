<?php

require_once  dirname(__DIR__, 2).'/models/Donation/Donation.php';
require_once  dirname(__DIR__, 2).'/models/Donation/DonationByCash.php';
require_once  dirname(__DIR__, 2).'/models/Donation/DonationByFawry.php';
require_once  dirname(__DIR__, 2).'/models/Donation/DonationByVisa.php';
require_once  dirname(__DIR__, 2).'/models/Donation/DonationProxy.php';

require_once  dirname(__DIR__, 2).'/models/Users/BaseAccoount.php';
require_once dirname(__DIR__, 2).'/enums/NotificationFor.php';

require_once  dirname(__DIR__, 2).'/enums/DonationMethodTypes.php';

require_once dirname(__DIR__, 2).'/models/DonoData.php';
require_once dirname(__DIR__, 2).'/models/Subject.php';
require_once dirname(__DIR__, 2).'/models/EmailListener.php';

require_once dirname(__DIR__, 2).'/models/Badges/Badge.php';


class DonationController
{
    private static DonoData $donation_observer;
    public function index() {

        $fundraising_events = $this->getAllEvents();

        $donation_observer = new DonoData();
        $emailListener = new EmailListener($donation_observer);
        

        require_once dirname(__DIR__, 2) . '/views/donation.php';
    }


    public function getAllEvents() {
        return Fundraising::getAllFundraising();
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

        $donation = new DonationProxy($donationStrategy);
        $donoResult = $donation->makeDonation($donationData['amount'], $donationData['event_id'], $donationData['account_id']);

        if($donoResult == false){
           header('Location: /suspend');
        }
        if($donationData['amount'] > 100){
            Badge::addBadgeToUser($donationData['account_id'], BadgesTypes::DonoChamp->value);
            if(array_key_exists("badge" , $_SESSION)){
                if($_SESSION["badge"] -> checkIfBadgeExistsAndIncrement("DonationMilestoneBadge") == false){
                    $_SESSION["badge"] = new DonationMilestoneBadge($_SESSION["badge"], $_SESSION["ID"]);
                }
            }
        }

        // TODO : we need to notify the observer (#null exception)
    //    self::$donation_observer->notify($donation);
    
        $observer = BaseAccount::getPreferencesObserver(NotificationFor::Donation->value, $_SESSION['username']);
        $observer->notify($donation);
        // sleep(3);
        // header('Location: /');
        exit();
    }

    public function getUserDonations(int $user_id) {
        Donation::getAllDonationsByUser($user_id);
}

    public function getEventDonations($eventId)
    {
        Donation::getAllDonationsToEvent($eventId);
    }

}