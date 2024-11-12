<?php

interface Subject{
    public function notify($data);
    public function subscribe($listener);
    public function unsubscribe($listener);
}