<pre>
<?php
abstract class Organism {
	private $form;
	private $move;
	public function getForm()
	{
		return $this->form;
	}
	public function getMove()
	{
		return $this->move;
	}
	public abstract function __construct($var1, $var2);
	public abstract function factory($var1, $var2);
}
abstract class Wings extends Organism {
	private $flying;
	public function TakeOff()
	{
		if($this->flying == true)
		{
			$this->flying = true;
			echo "Взлетает".PHP_EOL;
		}
	}
	public function Land()
	{
		if($this->flying == true)
		{
			$this->flying = false;
			echo "Садится".PHP_EOL;
		}
	}
	public function IsFlying()
	{
		if($this->flying)
			echo "Летит".PHP_EOL;
		else
			echo "Гуляет".PHP_EOL;
	}
	public abstract function __construct($var1, $var2);
}

abstract class Fish extends Organism {
	private $environment;
	public function Swim()
	{
		$environment = true;
		echo "Плывёт".PHP_EOL;
	}
	public function Jump()
	{
		$environment = false;
		echo "Выпрыгивает из воды".PHP_EOL;
	}
	
	public function IsSwimming()
	{
		if($environment)
			echo "В воде".PHP_EOL;
		else
			echo "В воздухе".PHP_EOL;
	}
	public abstract function __construct($var1, $var2);
}
class Owl extends Wings {
	private $kind;
	use ClassName;
	public function __construct($var1, $var2)
	{
		$this->form = $var1;
		$this->move = $var2;
		$this->kind = 'Сова';
		$this->flying = true;
    }
	public function factory($var1, $var2)
	{
		return new Owl($var1, $var2);
	}
	public function getKind()
	{
		return $this->kind;
	}
}

class Parrot extends Wings {
	private $kind;
	private $talk;
	use ClassName;
	public function __construct($var1, $var2)
	{
		$this->form = $var1;
		$this->move = $var2;
		$this->kind = 'Попугай';
		$this->flying = true;
		$this->talk = array('Теперь, когда мы научились летать по воздуху, как птицы, плавать под водой, как рыбы, нам не хватает только одного: научиться жить на земле, как люди. - Бернард Шоу.',

		'Стремись не к тому, чтобы добиться успеха, а к тому, чтобы твоя жизнь имела смысл. Альберт Эйнштейн',

		'Три вещи никогда не возвращаются обратно — время, слово, возможность. Поэтому: не теряй времени, выбирай слова, не упускай возможность. - Конфуций.',

		'Бояться надо не смерти, а пустой жизни. Бертольд Брехт',

		'Сколько бы мудрых слов ты ни прочел, сколько бы ни произнес, какой тебе от них толк, коль ты не применяешь их на деле? - Будда.',

		'Любить – значит видеть человека таким, каким его задумал Бог. - Ф.М. Достоевский.',

		'Если не бегаешь, пока здоров, придется побегать, когда заболеешь. - Гораций.');
    }
	public function Talk()
	{
		echo $this->talk[rand(0, 6)].PHP_EOL;
	}
	public function factory($var1, $var2)
	{
		return new Parrot($var1, $var2);
	}
	public function getKind()
	{
		return $this->kind;
	}
}

class Whale extends Fish {
	private $kind;
	use ClassName;
	public function __construct($var1, $var2)
	{
		$this->form = $var1;
		$this->move = $var2;
		$this->kind = 'Кит';
    }
	public function factory($var1, $var2)
	{
		return new Whale($var1, $var2);
	}
	public function getKind()
	{
		return $this->kind;
	}

}

class Salmon extends Fish {
	private $kind;
	private $cooked;
	use ClassName;
	//Oraganism
	public function Cook()
	{
		echo 'Лосося поймали, зажарили и подали к столу.'.PHP_EOL;
		$this->cooked = true;
	}
	public function getForm()
	{
		return $this->form;
	}
	public function getMove()
	{
		return $this->move;
	}
	public function __construct($var1, $var2)
	{
		$this->form = $var1;
		$this->move = $var2;
		$this->kind = 'Лосось';
		$this->cooked = false;
    }
	public function factory($var1, $var2)
	{
		return new Whale($var1, $var2);
	}
	public function getKind()
	{
		return $this->kind;
	}
		//Wings
	public function Swim()
	{
		if(!$this->cooked)
		{
			$environment = true;
			echo "Плывёт".PHP_EOL;
		}
		else
			echo 'Кто-то бросил жареного лосося в воду.'.PHP_EOL;
	}
	public function Jump()
	{
		if(!$this->cooked)
		{
			$environment = false;
			echo "Выпрыгивает из воды".PHP_EOL;
		}
		else
			echo 'Даже после смерти лосось не перестаёт удивлять своими прыжками.'.PHP_EOL;
	}
	public function IsSwimming()
	{
		if(!$this->cooked)
		{
			if($environment)
				echo "В воде".PHP_EOL;
			else
				echo "В воздухе".PHP_EOL;
		}
		else
			echo 'Такая потеря для общества...'.PHP_EOL;
	}
}

trait ClassName {
	public function getClass()
	{
		return get_class ($this);
	}
	
}
$newClass1 = new Owl('Полярная сова', true);
$newClass2 = new Parrot('Жако', true);
$newClass3 = new Whale('Косатка', true);
$newClass4 = new Salmon('Лосось', true);
echo $newClass1 -> getClass().PHP_EOL;
echo $newClass1 -> getKind().PHP_EOL;
$newClass1 -> Land();
echo $newClass2 -> getClass().PHP_EOL;
echo $newClass2 -> getKind().PHP_EOL;

$newClass2 -> Talk();
echo $newClass3 -> getClass().PHP_EOL;
echo $newClass3 -> getKind().PHP_EOL;
$newClass3 -> Jump();
echo $newClass4 -> getClass().PHP_EOL;
echo $newClass4 -> getKind().PHP_EOL;
$newClass4 -> Jump();
$newClass4 -> Cook();
$newClass4 -> Jump();
?>
</pre>