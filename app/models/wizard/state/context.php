<?php

//require_once dirname(__DIR__, 2) . '/wizard/EnterDetailsIState.php';

require_once __DIR__ . '/IState.php';

class WizardContext {
    private IState $currentState;
    private array $data = [];

    public function __construct(IState $initialState) {
        $this->currentState = $initialState;
    }

    public function setState(IState $state): void {
        $this->currentState = $state;
    }

    public function getCurrentState(): IState {
        return $this->currentState;
    }

    public function renderView(): string {
        return $this->currentState->renderView();
    }

    // Manage data
    public function setData(array $data): void {
        $this->data = array_merge($this->data, $data);
    }

    public function getData(): array {
        return $this->data;
    }

    public function resetData(): void {
        $this->data = [];
    }


}
