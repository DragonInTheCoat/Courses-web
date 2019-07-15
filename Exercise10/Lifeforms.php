<?php
interface MovingLifeform {
    function startMove();
    function stopMove();
    function getMoveStatus();
}

trait Helpers {
    public function getClassName(){ return get_class($this); }
}

abstract class Lifeform implements MovingLifeform {
    use Helpers;
    
    protected $moveStatus = 0;
    protected $type;
    protected $moveType;
    
    public function getType(){ return $this->type; }
    public function getMoveType(){ return $this->moveType; }
    public function rodi(){
        $className = $this->getClassName();
        $baby = new $className();
        return $baby;
    }
    
    public function startMove(){ $this->moveStatus=1; }
    public function stopMove(){ $this->moveStatus=0; }
    public function getMoveStatus(){ return $this->moveStatus; }
    
}

abstract class Winged extends Lifeform {
    protected $flyStatus;
    public function rise(){ return 'На взлёт!'; }
    public function land(){ return 'Посадка..'; }
    public function getFlyStatus(){ return $this->flyStatus?'Летаю':'Не летаю'; }
}

abstract class Wingless extends Lifeform {
    protected $swimStatus;
    public function swim(){ return 'Ныряю!'; }
    public function unswim(){ return 'Вышел на сушу'; }
    public function getSwimStatus(){ return $this->swimStatus?'Плаваю':'Хожу'; }
}

class Bird extends Winged {
    public function __construct(){ $this->type = 'Птичка'; }
}
class Bat extends Winged {
    public function __construct(){ $this->type = 'Летучая мышка'; }
}
class Human extends Wingless {
    public function __construct(){ $this->type = 'Человечек'; }
}
class Croc extends Wingless {
    public function __construct(){ $this->type = 'Крокодильчик'; }
}

$theCroc = new Croc();
$smallCroc = $theCroc->rodi();
echo $smallCroc->getType();


