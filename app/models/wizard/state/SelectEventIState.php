<?php


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