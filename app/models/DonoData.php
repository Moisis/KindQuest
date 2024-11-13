<?php

require_once 'Subject.php';
class DonoData implements Subject{

    private $listeners;

    
    public function notify($data){
        forEach($this->listeners as $listener){
            $listener->update($data);
        }
    }
    public function subscribe($listener){
        $this->listeners[] = $listener;
    }
    public function unsubscribe($listener){
        for( $i = 0; $i < count($this->listeners); $i++ ){
            if( $this->listeners[$i] == $listener ){
                unset($this->listeners[$i]);
                break;
            }
        }
    }

}