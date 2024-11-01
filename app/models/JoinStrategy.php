<?php

declare(strict_types= 1);

interface JoinStrategy{
    public function join(Event $event): void;
}

?>