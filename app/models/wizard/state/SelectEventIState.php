<?php


require_once dirname(__DIR__, 2) . '/wizard/state/IState.php';


class SelectEventIState implements IState {
    public function next(WizardContext $context): void {
        $context->setState(new ReviewDetailsIState());
    }

    public function previous(WizardContext $context): void {
        $context->setState(new EnterDetailsIState());
    }

    public function renderView(): string {
        return 'select-event.php';
    }
}