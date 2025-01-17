<?php


class CommandFactory
{
    public static function createCommand(string $action, $wizard)
    {
        $commandMap = [
            'next' => NextStepICommand::class,
            'previous' => PreviousStepICommand::class,
        ];

        if (!isset($commandMap[$action])) {
            throw new Exception("No command found for action: $action");
        }

        return new $commandMap[$action]($wizard);
    }
}
