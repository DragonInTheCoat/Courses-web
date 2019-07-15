<?php
trait Printer {
    public function arrayPrint($array){
        print_r($array);
    }
}

class SessionMessages {
    public function __construct(){ session_start(); }
    
    public function setMessage($type, $message){
        if(!isset($_SESSION['messages'][$type])) $_SESSION['messages'][$type] = [];
        if(!in_array($message, $_SESSION['messages'][$type])) $_SESSION['messages'][$type][] = $message;
    }
    
    public function hasMessage($type){
        return isset($_SESSION['messages'][$type]);
    }
    
    public function getMessages($type){
        if(!isset($_SESSION['messages'][$type])) return [];
        $messages = $_SESSION['messages'][$type];
        unset($_SESSION['messages'][$type]);
        return $messages;
    }
}

class SessionMessagesPrinter extends SessionMessages {
    use Printer;
    
    public function __construct(){ parent::__construct(); }
    
    public function printByType($type){
        if($this->hasMessage($type)) 
            $this->arrayPrint( $this->getMessages($type) );
    }
}

$smp = new SessionMessagesPrinter();
//print_r($_SESSION);

$smp->setMessage('alert', 'TEST');
$smp->setMessage('alert', 'QUEST');

$smp->printByType('alert');

