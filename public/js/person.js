var form_language=document.getElementById('form_language');
var form_person=document.getElementById('form_person');
var content_languages=document.getElementById('content_languages');

document.addEventListener('DOMContentLoaded',()=>{
    this.form_person['languages_id[]'].selectedIndex=-1;
    this.form_person['languages_leves[]'].selectedIndex=-1;
});

form_person.addEventListener('submit',(evt)=>{
    evt.preventDefault();
    for(let language of this.content_languages.getElementsByTagName("p")){

        let language_id=language.getAttribute('language_id');
        let language_level=language.getAttribute('language_level');
        let option_language_id=document.createElement('option');
        let option_language_level=document.createElement('option');

        option_language_id.value=language_id;
        option_language_id.selected=true;
        option_language_level.value=language_level;
        option_language_level.selected=true;

        this.form_person['languages_id[]'].appendChild(option_language_id);
        this.form_person['languages_leves[]'].appendChild(option_language_level);
        
    }
    form_person.submit();
});

form_language.addEventListener('submit',(evt)=>{
    evt.preventDefault();
    let div_language=document.createElement('p');
    div_language.textContent=form_language['language_id'].options[form_language['language_id'].selectedIndex].text+" - "+form_language['language_level'].value+"%";
    div_language.setAttribute('title','Eliminar');
    div_language.addEventListener('click',(evt)=>{
        evt.preventDefault();
        this.removeLanguage(div_language);
    });
    div_language.setAttribute('language_id',form_language['language_id'].value);
    div_language.setAttribute('language_level',form_language['language_level'].value);
    this.content_languages.appendChild(div_language);
});

function removeLanguage(div_language){
    div_language.remove();
}