<?php
session_start();
$alert = '';
if(isset($_GET['exit'])) {
    $_SESSION['user'] = null;
    header('location: '.$_SERVER['PHP_SELF']);
    exit();
}
class DB extends PDO {
    public function __construct(){
        $host = '127.0.0.1';
        $db   = 'web_db';
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
              login=:login, password=:password, name=:name, birthdate=:birthdate, sex=:sex,
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
        $_SESSION['alert'] = 'Регистрация прошла успешно!';
        header('location: '.$_SERVER['PHP_SELF']);
        exit();
    }
}
else if(!empty($_POST['auth_login']) && !empty($_POST['auth_password'])) {
    $db = new DB();
    
    $sth = $db->prepare("SELECT * FROM user WHERE login=?");
    $sth->execute([$_POST['auth_login']]);
    $user = $sth->fetch();
    if($user) {
        if(password_verify($_POST['auth_password'], $user['password'])) {
            $_SESSION['user'] = $user;
            $db->prepare("UPDATE user SET authdate=:date WHERE id=:id")->execute(['date'=>time(), 'id'=>$user['id']]);
            $_SESSION['alert'] = 'Уважаемый '.$user['name'].', вы успешно авторизовались';
            header('location: '.$_SERVER['PHP_SELF']);
            exit();
        }
        else {
            $db->prepare("UPDATE user SET autherrcnt=`autherrcnt`+1 WHERE id=?")->execute([$user['id']]);
            $sth = $db->prepare("SELECT autherrcnt FROM user WHERE id=?");
            $sth->execute([$user['id']]);
            $autherrcnt = $sth->fetchColumn();
            if($autherrcnt>3) {
                $db->prepare("UPDATE user SET status=0 WHERE id=?")->execute([$user['id']]);
                $_SESSION['alert'] = 'Уважаемый '.$user['name'].', ваша учётная запись заблокирована';
                header('location: '.$_SERVER['PHP_SELF']);
                exit();
            }
            $alert = 'Пароль не подходит';
        }
    }
    else {$alert = 'Пользователь не найден';}
}

?>


<?php
if(!empty($_SESSION['user'])) {
    echo "Вы авторизованы.<br><Br><a href='/a/?exit'>Выход</a>";
}
else {
?>
<form method="POST" name="authform">
    <fieldset><legend>ФОРМА АВТОРИЗАЦИИ</legend>
    логин <input type="text" name="auth_login" value="<?=@$_POST['auth_login']?>"><br>
    пароль <input type="password" name="auth_password"><br>
    <input type="submit" name="submit" value="Войти">
    </fieldset>
</form>

<br><br>

<form method="POST" name="regform">
    <fieldset value="1"><legend>ФОРМА РЕГИСТРАЦИИ</legend>
    имя <input type="text" name="name" value="<?=@$_POST['name']?>"><br>
    дата рождения <input type="date" name="birthdate" value="<?=@$_POST['birthdate']?>"><br>
    Пол: <label>
          <input type="radio" name="sex" value="0" 
          <?=((isset($_POST['sex']) && $_POST['sex']==0) || !isset($_POST['sex']))?'checked':''?>
          > Ж</label> 
        <label>
            <input type="radio" name="sex" value="1"
            <?=((isset($_POST['sex']) && $_POST['sex']==1)?'checked':'')?>
        > М</label><br>
    логин <input type="text" name="login" value="<?=@$_POST['login']?>"><br>
    пароль <input type="password" name="password"><br>
    <input type="submit" name="submit" value="Зарегистрироваться" disabled>
    </fieldset>
</form>

<?php
    }
?>
<script>
<?php
    if($alert) echo "alert('".$alert."')";
    if(@$_SESSION['alert']) {
        echo "alert('".$_SESSION['alert']."')";
        $_SESSION['alert'] = null;
    }
    
?>

document.forms.regform.oninput = function(event){
    let flag = false;
    for(elt of this.elements){
        if(elt.nodeName != 'FIELDSET' && elt.type!='radio' && !elt.value) {
            flag=true;
        }
    };
    document.forms.regform.elements.submit.disabled = flag;
};
</script>

<div style="height:1000px"></div>