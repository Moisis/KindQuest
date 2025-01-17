<?php



require_once dirname(__DIR__, 2) . '/wizard/state/context.php';

interface IState {
    public function next(WizardContext $context): void;
    public function previous(WizardContext $context): void;
    public function renderView(): string;
}