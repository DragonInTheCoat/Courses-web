<?php
if(isset($_GET['xhr'])) {
	echo var_dump(
    move_uploaded_file($_FILES['file']['tmp_name'], __DIR__.'/uploads/'.$_FILES['file']['name']));
    echo json_encode($_FILES);
    exit();
}
?>

<form method="POST" >
    <input type="file" name="file"><br>
    <input type="submit">
	<input type="text" name="auth_login" value=""><br>
</form>

<div id="progress_container" hidden>
  <progress id="pgb" max="" value=""></progress>
  <br>
  Загружено <span id="pgb_val">0</span>%
  <br>
  Прошло <span id="pgb_time">0</span>с
  <br>
  Скорость загрузки <span id="pgb_speed">0</span> Мб/с
</div>

<script>
document.forms[0].onsubmit = function(){
    const pgb = document.getElementById('pgb');
    const pgb_val = document.getElementById('pgb_val');
    const pgb_time = document.getElementById('pgb_time');
    const pgb_speed = document.getElementById('pgb_speed');
    let time = 0;
    
    let xhr = new XMLHttpRequest();	
    xhr.open(this.method, '/web_4/Exercise14/uploader.php?xhr');
    xhr.responseType = 'json';    
    
    let formData = new FormData(this);
    
    xhr.onload = function() {
        console.log('onload');
        console.log(xhr);
    };
        
    xhr.onerror = function() {
      console.log('error');
      console.log(xhr);
    };
    
    xhr.upload.onloadstart = function(event) {
        document.getElementById('progress_container').hidden = false;
        console.log('upload.onloadstart');
        
        console.log(xhr);
        console.log(event);
        time = event.timeStamp;
    };
    
    xhr.upload.onload = function(event) {
        console.log('upload.onload');
    };
    
	xhr.upload.onerror = function(event) {
        console.log('upload.onerror');
    };
	
	xhr.upload.onprogress = function(event) {
        console.log('upload.onprogress');
        //console.log(xhr);
        console.log(event);
        
        pgb.max = event.total;
        pgb.value = event.loaded;
        pgb_val.innerText = Math.ceil(event.loaded*100/event.total);
        const t = Math.ceil((event.timeStamp - time)/1000);
        pgb_time.innerText = t;
        pgb_speed.innerText = Math.ceil((event.loaded / t)/1000000);
        
	};
    
	xhr.upload.ontimeout = function(event) {
        console.log('upload.ontimeout');
	};
    
    xhr.send(formData);
    
    return false;
};


</script>