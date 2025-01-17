<?php




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
