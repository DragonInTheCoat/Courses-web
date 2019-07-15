<pre>
<?php
error_reporting(E_ALL); 
ini_set('display_errors', TRUE); 
ini_set('display_startup_errors', TRUE);

class User
{
	private $login;
	private $pass;
	private $email;
	private $uathStatus = false;
	private $valid;
	public function __construct()
	{
		$this->isValid = true;
	}
	public function registr($login, $pass, $email)
	{
		$this->setEmail($email);
		$this->setLogin($login);
		$this->setPass($pass);
	}
	public function getLogin()
	{
		return $this->login;
	}
	public function getEmail()
	{
		return $this->email;
	}
	public function getPass()
	{
		return $this->pass;
	}
	public function setEmail($email)
	{
		//todo
		if(preg_match( '/^\w[^@]*@.*?\.\w{2,}$/is', $email))
		{
			//$this->valid = true;
			$this->email = $email;
		}
		else
		{
			$this->valid = false;
			throw new Exception('Неверный эмейл');
		}
	}
	public function setLogin($login)
	{
		if(preg_match( '/^[a-z\d\!\@\#\$\%\^\&\*\(\)\_\-\+\|]{3,}$/is', $login))
		{
			//$this->valid = true;
			$this->login = $login;
		}
		else
		{
			$this->valid = false;
			throw new Exception('Неверный логин');
		}
	}
	public function setPass($pass)
	{
		if(preg_match( '/^[a-z\d\!\@\#\$\%\^\&\*\(\)\_\-\+\|]{3,}$/is', $pass))
		{
			//$this->valid = true;
			$this->pass = password_hash($pass, PASSWORD_DEFAULT);
		}
		else
		{
			$this->valid = false;
			throw new Exception('Неверный пароль');
		}
	}
	public function isValid()
	{
		//todo
		/*if(preg_match( '/^[a-z\d\!\@\#\$\%\^\&\*\(\)\_\-\+\|]{3,}$/is', $this->login))
			return true;*/
		return $this->isValid;
	}
	public function exit()
	{
		$user->authStatus = false;
	}
	public function statusAuth()
	{
		return $user->authStatus;
	}
}

class ExtendsLog
{
	private $users = array();
	public function __construct()
	{
		if(file_exists(__DIR__ . "/../datafiles/database.json"))
		{
			$handle = fopen(__DIR__ . "/../datafiles/database.json", "r");
			if ($handle) {
				while (($line = fgets($handle)) !== false)
				{
					$arr = explode(';', $line);
					if(count($arr) == 3)
						$this->users[] = new User($arr[0], $arr[1], $arr[2]);
				}
			fclose($handle);
			}
		}
	}
	public static function auth($login, $pass)
	{
		$user = $this->findObj($login);
		if(get_class($arr) == 'User')
		{
			if(password_verify($pass, $user->getPass()))
			{
				$user->uathStatus = true;
			}
			else
			{
				throw new Exception('Неверный пароль');
			}
		}
		else
		{
			throw new Exception('Пользователь не найден');
		}
			
	}
	
	public function getArr()
	{
		return $this->users;
	}
	public function addUser($login, $pass, $email)
	{
		//сделать проверку email и login на индивидуальность
		$user = new User();
		$user->registr($login, $pass, $email);
		if($this->checkUser($user))
			$this->users[] = $user;
	}
	private function checkUser($user)
	{
		/*echo "I'm here".PHP_EOL;
		echo $user->isValid() . ' ' . count($this->find($user->getLogin())) . ' ' . count($this->find($user->getEmail())) . PHP_EOL;*/
		if($user->isValid())
		{
			if(count($this->find($user->getLogin())) == 0 && count($this->find($user->getEmail())) == 0)
			{
				return true;
			}
			else
			{
				throw new Exception('Логин или эмейл заняты');
				return false;
			}
		}
		else
		{
			return false;
		}
	}

	public function find($findstr)
	{
		//echo $findstr . PHP_EOL;
		for ($i=0;$i<count($this->users);$i++)
		{
			if($this->users[$i]->getEmail() == $findstr || $this->users[$i]->getLogin() == $findstr)
				return array(0=>$this->users[$i]->getLogin(), 1=>$this->users[$i]->getPass(), 2=>$this->users[$i]->getEmail());
		}
		return array();
	}
	
	public function findObj($findstr)
	{
		//echo $findstr . PHP_EOL;
		for ($i=0;$i<count($this->users);$i++)
		{
			if($this->users[$i]->getEmail() == $findstr || $this->users[$i]->getLogin() == $findstr)
				return $this->users[$i];
		}
		return false;
	}
	
	private function arrStr()
	{
		$str = $this->users[0]->getLogin().';'. $this->users[0]->getPass().';'.$this->users[0]->getEmail();
		for ($i=1;$i<count($this->users);$i++)
		{
			$str = $str. PHP_EOL .$this->users[$i]->getLogin().';'. $this->users[$i]->getPass().';'.$this->users[$i]->getEmail();
		}
		return $str;
	}
	
	public function __distruct()
	{
		if(!file_exists(__DIR__ . "/../datafiles"))
			mkdir(__DIR__ . "/../datafiles");

		$handle = fopen(__DIR__ . "/../datafiles/database.json", "w");
		if (count($this->users) > 0)
			fwrite($handle , $this->arrStr());
		fclose($handle);
		
	}
}

$a = new ExtendsLog();

$a->addUser('login66','password','email666@ya.ru');
print_r($a->getArr());

?>
</pre>