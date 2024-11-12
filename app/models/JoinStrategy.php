<?php

declare(strict_types= 1);

interface JoinStrategy{
    public function join($event_id, $account_id): void;
}

?>