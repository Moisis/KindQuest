<?php

require_once dirname(__DIR__, 2) . '/models/wizard/command/ICommand.php';

require_once dirname(__DIR__, 2) . '/models/wizard/state/EnterDetailsIState.php';
require_once dirname(__DIR__, 2) . '/models/wizard/state/SelectEventIState.php';
require_once dirname(__DIR__, 2) . '/models/wizard/state/ReviewDetailsIState.php';

require_once dirname(__DIR__, 2) . '/models/wizard/state/context.php';
require_once dirname(__DIR__, 2) . '/models/wizard/command/NextStepICommand.php';
require_once dirname(__DIR__, 2) . '/models/wizard/command/PreviousStepICommand.php';

require_once dirname(__DIR__, 2).'/models/Events/Fundraising.php';
require_once dirname(__DIR__, 2).'/models/Product.php';
require_once  dirname(__DIR__, 2).'/models/Events/Event.php';


require_once dirname(__DIR__, 2) . '/models/wizard/command/CommandFactory.php';


//donate
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
require_once dirname(__DIR__, 2).'/models/LoggingListener.php';


require_once dirname(__DIR__, 2).'/models/Badges/Badge.php';


class WizardController
{
    private WizardContext $wizard;

    public function __construct()
    {

        session_regenerate_id();
        if (isset($_SESSION['wizard'])) {
            $this->wizard = unserialize($_SESSION['wizard']);
        } else {
            $this->wizard = new WizardContext(new EnterDetailsIState());
        }
    }

    public function __destruct()
    {
        $_SESSION['wizard'] = serialize($this->wizard);
    }

    public function index($id)
    {
        // Intialized the Wizard
        $this->wizard = new WizardContext(new EnterDetailsIState());
        $data = ['product_id' => $id];

        if (!isset($fundraising_events) ) {
            $data['event'] = 'null';
        } else {
            $data['event'] = $_POST['event'] ?? '';
        }

        // save data
        $this->wizard->setData($data);
        $this->renderView();
    }

    public function handleRequest($action)
    {
        try {
            // Checking The Requests Either Next , prev , finish
            $allowedActions = ['next', 'previous', 'finish'];
            if (!$action || !in_array($action, $allowedActions, true)) {
                throw new Exception("Invalid or missing action.");
            }


            // set the data Every time the request is made
            $data = $_POST;

            $this->wizard->setData($data);

            // Debugging
//            $axx = $this->wizard->getData();
//            print "<pre>";
//            print_r($axx);
//            print "</pre>";


            // Finish the Wizard
            if ($action === 'finish') {
                $this->finishWizard();
                $this->wizard->resetData();
                return;
            }

            //  factory Design Pattern
            $command = CommandFactory::createCommand($action, $this->wizard);
            $command->execute();

            $this->renderView();
        } catch (Exception $e) {
            echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
        }
    }
    private function renderView(): void
    {
        $view = $this->wizard->renderView();
        $viewPath = dirname(__DIR__, 2) . '/views/Wizard/' . $view;

        // Debugging
        if (!file_exists($viewPath)) {
            echo "<p style='color: red;'>View not found: " . htmlspecialchars($view) . "</p>";
            return;
        }

        // Getting the Data Through the Wizard
        $data = $this->wizard->getData();

        // Getting the Events and Product
        $fundraising_events = $this->getAllEvents();
        $product = Product::getProductById($this->wizard->getData()['product_id']);

        // Getting the Current Chosen  Event
        $current_event = isset($this->wizard->getData()['event']) ? Event::get_event((int)$this->wizard->getData()['event']) : '';
        require_once $viewPath;
    }

    private function finishWizard(): void
    {
        $check = self::donate($this->wizard->getData());

        if ($check == false) {
            require_once dirname(__DIR__, 2) . '/views/Suspended.php';

        }else{
            require_once dirname(__DIR__, 2) . '/views/Wizard/complete.php';
        }
    }


    public static function donate(array $donationData)  : bool  {

        if (isset($donationData['event']) && $donationData['event'] != 'null') {
            $donationStrategy = null;

            // Set the appropriate auth strategy based on user type
            if ($donationData['donation_method'] == DonationMethodTypes::Visa->value) {
                $donationStrategy = new DonationByVisa();
            } elseif ($donationData['donation_method'] == DonationMethodTypes::Fawry->value) {
                $donationStrategy = new DonationByFawry();
            } elseif ($donationData['donation_method'] == DonationMethodTypes::Cash->value) {
                $donationStrategy = new DonationByCash();
            }

            $product = Product::getProductById($donationData['product_id']);


            $donation = new DonationProxy($donationStrategy);
            $donoResult = $donation->makeDonation($product -> getPrice(), $donationData['event'], $_SESSION['ID']  );

            if($donoResult == false){
                return false;
            }
            if($product -> getPrice() >= 100){
                Badge::addBadgeToUser($_SESSION['ID'], BadgesTypes::DonoChamp->value);
                if(array_key_exists("badge" , $_SESSION)){
                    if($_SESSION["badge"] -> checkIfBadgeExistsAndIncrement("DonationMilestoneBadge") == false){
                        $_SESSION["badge"] = new DonationMilestoneBadge($_SESSION["badge"], $_SESSION["ID"]);
                    }
                }
            }


            $observer = BaseAccount::getPreferencesObserver(NotificationFor::Donation->value, $_SESSION['username']);
            //$observer->subscribe(new LoggingListener())
            // $logging_listener = new LoggingListener($observer, __DIR__ . "/../../../logFile.txt");

            $observer->notify($product->getPrice());

            // echo "Donation Success";
            // sleep(3);
//            header('Location: /');
//            exit();

            return true;

        }
        return false;
    }

    public function getAllEvents(): EventIterator
    {
        return Fundraising::getAllFundraising();

    }
}