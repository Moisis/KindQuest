<?php



require dirname(__DIR__, 2) . '/wizard/state/IState.php';


class EnterDetailsIState implements IState {
    public function next(WizardContext $context): void {
        $context->setState(new SelectEventIState());
    }

    public function previous(WizardContext $context): void {
        // first state
    }

    public function renderView(): string {
        return 'enter-details.php';
    }
}





