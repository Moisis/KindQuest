<?php

require_once dirname(__DIR__, 2) . '/wizard/state/IState.php';


class ReviewDetailsIState implements IState {
    public function next(WizardContext $context): void {
        // final state
    }

    public function previous(WizardContext $context): void {
        $context->setState(new SelectEventIState());
    }


    public function renderView(): string {
        return 'confirm-details.php';
    }
}
