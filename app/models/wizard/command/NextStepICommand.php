<?php



require_once dirname(__DIR__, 2) . '/wizard/state/EnterDetailsIState.php';

class NextStepICommand implements ICommand
{
    private WizardContext $wizard;

    public function __construct(WizardContext $wizard)
    {
        $this->wizard = $wizard;
    }

    public function execute(): void
    {
        $this->wizard->getCurrentState()->next($this->wizard);
    }
}