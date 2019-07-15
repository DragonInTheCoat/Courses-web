<?php
session_start();
$alert = '';
$status = 'ERR';
if(isset($_GET['exit'])) {
    $_SESSION['user'] = null;
	echo 'OK';
    exit();
}
class DB extends PDO {
    public function __construct(){
        $host = '127.0.0.1';
        $db   = 'web_4';
        $user = 'web';
        $pass = 'T!0i4B7~g7';
        $charset = 'utf8';
        $dsn = "mysql:host=$host; dbname=$db; charset=$charset";
        $opt =  [
          PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        return parent::__construct($dsn, $user, $pass, $opt);
    }
}

if(!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['name']) && !empty($_POST['birthdate'])) {
    $db = new DB();
    
    $sth = $db->prepare("SELECT count(*) FROM user WHERE login=?");
    $sth->execute([$_POST['login']]);
    $cnt = $sth->fetchColumn();
    
    if($cnt>0) {
        $alert = 'Пользователь с таким логином уже есть в базе!!';
    }
    else {
        $sth = $db
            ->prepare("INSERT INTO user SET 
              login=:login, pass=:password, name=:name, birthdate=:birthdate, sex=:sex,
              regdate=:regdate
              ")
            ->execute([
                'login' => $_POST['login'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'name' => $_POST['name'],
                'sex' => $_POST['sex'],
                'birthdate' => strtotime($_POST['birthdate']),
                'regdate' => time(),
            ]);
        $status = 'OK';
    }
}
else if(!empty($_POST['auth_login']) && !empty($_POST['auth_password'])) {
    $db = new DB();
    
    $sth = $db->prepare("SELECT * FROM user WHERE login=?");
    $sth->execute([$_POST['auth_login']]);
    $user = $sth->fetch();
    if($user) {
		$sth = $db->prepare("SELECT autherrcnt FROM user WHERE id=?");
		$sth->execute([$user['id']]);
		$autherrcnt = $sth->fetchColumn();
		if($autherrcnt>3) {
			$db->prepare("UPDATE user SET status=0 WHERE id=?")->execute([$user['id']]);
			$alert = 'Уважаемый '.$user['name'].', ваша учётная запись заблокирована';
		}
		else
		{
			if(password_verify($_POST['auth_password'], $user['pass'])) {
				$_SESSION['user'] = $user;
				$db->prepare("UPDATE user SET authdate=:date WHERE id=:id")->execute(['date'=>time(), 'id'=>$user['id']]);
				$alert = 'Уважаемый '.$user['name'].', вы успешно авторизовались';
				$status = 'OK';
			}
			else {
				$db->prepare("UPDATE user SET autherrcnt=`autherrcnt`+1 WHERE id=?")->execute([$user['id']]);
				$alert = 'Пароль не подходит';
			}
		}
    }
    else {$alert = 'Пользователь не найден';}
}
echo json_encode(['status'=>$status, 'alert'=>$alert]);
?>