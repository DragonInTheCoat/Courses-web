'use strict'

let subjectsCollection = {
    subjects: ['Математика','Физика','Литература','Программирование','История','Русский язык','Физкультура','Труд'],
    addSubject: function(subj){},
    removeSubject: function(subj){}
}


function Pupil(){    
    this.lname = '';
    this.fname = '';
    this.mname = '';
    this.phone = '';
    this.tags = [];
    this.age = 6;
	this.subjects = {};
    
    this.getShortFio = function(){
        return this.lname+' '+this.fname[0]+'.'+(this.mname?(this.mname[0]+'.'):'');
    };
};

Pupil.add = function(params){
    let newPupil = new Pupil;
    for(let i in newPupil) {if(params[i]) newPupil[i] = params[i]};
    
    subjectsCollection.subjects.forEach(function(val){
        newPupil.subjects[val] = {klass: false, expedition: false, project: false};
    });
    
    return newPupil;
};

let lnames = ['Иванов','Дарвин','Дворжак','Декурсель','Дефо','Джеймс','Джексон','Джонсон','Дзержинский','Дмитриев','Дункан','Дымарский','Дюма','Файнс','Фармер','Фёдоров','Фергюсон','Фишер','Франке','Франко','Фридман','Фрич'];

let fnames = ['Адриан','Азарий','Аким','Алан','Агафья','Агриппина','Акулина','Алевтина','Александра','Алина','Алла','Анастасия','Ангелина','Анжела','Анжелика','Анна','Антонина','Анфиса'];

let pupils = [];
for(let i=0; i<5; i++) pupils.push(Pupil.add({
    lname:		lnames[Math.floor(Math.random()*(lnames.length-1))],
	fname:		fnames[Math.floor(Math.random()*(fnames.length-1))],
	mname:		'',
	phone:		'',
	tags:		[],		
	age:		Math.floor(6+Math.random()*10)
}));

showPupils();

function showPupils(){  
  let html = '';
  pupils.forEach(function(pupil,i){
      html += '<div class="pupil" onclick="edit('+i+')">'+pupil.getShortFio()+'</div>';
  });
  document.getElementById('pupils_container').innerHTML = html;
}

function edit(id){
    let elts = document.forms[0].elements;
    
    elts.id.value = id;
    elts.lname.value = pupils[id].lname;
    elts.fname.value = pupils[id].fname;
    elts.mname.value = pupils[id].mname;
    elts.phone.value = pupils[id].phone;
    elts.tags.value = pupils[id].tags;
    elts.tags.onchange();
    elts.age.value = pupils[id].age;        
    
    let html = '<table><tr><th>Предмет</th><th>В классе</th><th>Экспедиция</th><th>Свой проект</th></tr>';
    for(let subject in pupils[id].subjects) {                
        html += '<tr><th>'+subject+'</th>';
        html += '   <td><input data-subject="'+subject+'" data-type="klass" type="checkbox" '+(pupils[id].subjects[subject].klass?'checked':'')+'></td>';
    	html += '   <td><input data-subject="'+subject+'" data-type="expedition" type="checkbox" '+(pupils[id].subjects[subject].expedition?'checked':'')+'></td>';
    	html += '   <td><input data-subject="'+subject+'" data-type="project" type="checkbox" '+(pupils[id].subjects[subject].project?'checked':'')+'></td>';
    	html += '</tr>';
    };
    
    html += '<tr><th>Проставить все</th><td><input type="button" onclick="setChecked(\'klass\')" value="В классе"></td><td><input type="button" onclick="setChecked(\'expedition\')" value="Экспедиция"></td><td><input type="button" onclick="setChecked(\'project\')" value="Свой проект"></td></tr></table>';
    
    document.getElementById('subjects_container').innerHTML = html;    
    
    document.forms[0].hidden = false;
};




function setChecked(type){
    let chks = Array.from(document.querySelectorAll('[data-type="'+type+'"]'));
    let status = !chks.every(function(chk){return chk.checked});
    for(let chk of chks) chk.checked = status;
};

function save(){
    if(document.forms[0].elements.id === '') return;
    let elts = document.forms[0].elements;
    let id = elts.id.value;
    
    pupils[id].lname = elts.lname.value; 
    pupils[id].fname = elts.fname.value;
    pupils[id].mname = elts.mname.value;
    pupils[id].phone = elts.phone.value;
    pupils[id].tags = elts.tags.value.split(',').map(function(elt){return elt.trim()});
    pupils[id].age = elts.age.value;
    
    for(let subject in pupils[id].subjects) {
        pupils[id].subjects[subject].klass = document.querySelector('[data-type="klass"][data-subject="'+subject+'"]').checked;
        pupils[id].subjects[subject].expedition = document.querySelector('[data-type="expedition"][data-subject="'+subject+'"]').checked;
        pupils[id].subjects[subject].project = document.querySelector('[data-type="project"][data-subject="'+subject+'"]').checked;
    }
    
    document.forms[0].hidden = true;
};

function del(){
    if(document.forms[0].elements.id === '') return;
    let elts = document.forms[0].elements;
    let id = elts.id.value;
    delete(pupils[id]);
    document.forms[0].hidden = true;
    showPupils();
}











document.forms[0].elements.tags.onchange = function(event){
    let html = '';
    let tagsArray = this.value.split(',')
        .map(function(elt){return elt.trim()})
        .filter(function(value, index, self){
            return self.indexOf(value) === index;
        })
        .filter(function(elt){
            if(elt) html += '<div class="tag">'+elt+'<div class="close" onclick="removeTag(\''+elt+'\')">&times;</div></div>';
            return !!elt;
        });
    
    this.value = tagsArray.join(', ');
    document.getElementById('tags_container').innerHTML = html;
};

function removeTag(val){
    let tagsArray = document.forms[0].elements.tags.value
        .split(',')
        .map(function(elt){return elt.trim()})
        .filter(function(elt){
            return elt != val
        });
    
    document.forms[0].elements.tags.value = tagsArray.join(', ');
    document.forms[0].elements.tags.onchange();
};

document.forms[0].elements.phone.oninput = function(event){
    this.value = this.value.replace(/[^\d]/gis, '').split('').reduce(function(sum, val, i, ar){
        let isFin = ar.length-1 == i;
        if(i==0) {return '+7 ';}
        else if(i==3) {return sum + val + (isFin?'':' ');}
        else if(i==6 || i==8) {return sum + val + (isFin?'':'-');}
        else {return sum + val;}
    }, '');
    
};