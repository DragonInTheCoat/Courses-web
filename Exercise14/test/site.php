<?php
session_start();
$alert = '';
if(!empty($_SESSION['user'])) {
echo "Вы авторизованы.<br><Br><a id='exit' href='#'>Выход</a>";
echo "<script>
		document.getElementById('exit').onclick = function(){
		let xhr = new XMLHttpRequest();
		xhr.open('GET', './db.php?exit');
		xhr.responseType = 'json';
		xhr.send();
		//window.location.href = '/web_4/Exercise14/site.php';
		return false;
		};
	</script>";
}
else {
?>
<div id='container'>
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
</div>

<script>

document.forms[0].onsubmit = function(){

    let xhr = new XMLHttpRequest();	
    xhr.open(this.method, '/web_4/Exercise14/uploader.php');
    xhr.responseType = 'json';
    let formData = new FormData(this);
    xhr.send(formData);

	xhr.onload = function () {
		if (xhr.readyState === xhr.DONE) {
			if (xhr.status === 200) {
				//console.log(xhr.response);
				//console.log(xhr.responseText);
				if(xhr.response['status'] == 'OK')
				{
					document.getElementById('container').innerHTML = "Вы авторизованы.<br><Br><a id='exit' href='#'>Выход</a>";
					document.getElementById('exit').onclick = function(){
						let xhr1 = new XMLHttpRequest();	
						xhr1.open('GET', '/web_4/Exercise14/uploader.php?exit');
						xhr1.responseType = 'json';
						window.location.href = '/web_4/Exercise14/site.php';
						xhr1.send();
						return false;
					};
				}

				alert(xhr.response['alert']);
				
			}
		}
	};
    return false;
};

document.forms[1].onsubmit = function(){
    let xhr = new XMLHttpRequest();	
    xhr.open(this.method, '/web_4/Exercise14/uploader.php');
    xhr.responseType = 'json';
    let formData = new FormData(this);
    xhr.send(formData);
	xhr.onload = function () {
		if (xhr.readyState === xhr.DONE) {
			if (xhr.status === 200) {
				if(xhr.response['status']=='ERR')
					alert(xhr.response['alert']);
				//console.log(xhr.response);
				//console.log(xhr.responseText);
			}
		}
	};
    return false;
};

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
<?php
    }
?>
<div style="height:1000px"></div>