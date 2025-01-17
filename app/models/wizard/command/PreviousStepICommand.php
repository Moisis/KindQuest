<?php


require_once dirname(__DIR__, 2) . '/wizard/state/context.php';

require_once dirname(__DIR__, 2) . '/wizard/command/ICommand.php';

class PreviousStepICommand implements ICommand {
    private WizardContext $wizard;

    public function __construct(WizardContext $wizard) {
        $this->wizard = $wizard;
    }

    public function execute(): void {
        $this->wizard->getCurrentState()->previous($this->wizard);
    }
}