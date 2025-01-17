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
            $axx = $this->wizard->getData();
//            print "<pre>";
//            print_r($axx);
//            print "</pre>";


            // Finish the Wizard
            if ($action === 'finish') {
                $this->wizard->resetData();
                $this->finishWizard();
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
      require_once dirname(__DIR__, 2) . '/views/Wizard/complete.php';
    }


    public function getAllEvents(): EventIterator
    {
        return Fundraising::getAllFundraising();

    }
}