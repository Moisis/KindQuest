<?php

class LoggingListener implements IListener{

    private $log_file;

    public function __construct($subject, $log_file){
        $this->log_file = $log_file;
        $subject->subscribe($this);
    }

    public function update($data){
        $log_entry = "[" . date("d-m-Y H:i:s") . "] UserID: " . $_SESSION["ID"] . " Amount:" . $data . "\n";
        file_put_contents($this->log_file, $log_entry, FILE_APPEND);
    }

}