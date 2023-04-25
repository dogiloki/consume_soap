var form_language=document.getElementById('form_language');
var form_person=document.getElementById('form_person');
var content_languages=document.getElementById('content_languages');
var languages=[];

document.addEventListener('DOMContentLoaded',()=>{
    this.form_person['languages_id[]'].selectedIndex=-1;
    this.form_person['languages_leves[]'].selectedIndex=-1;
});

form_person.addEventListener('submit',(evt)=>{
    evt.preventDefault();
    this.languages.forEach((language)=>{
        this.form_person['languages_id[]'].options[language.language_index].selected=true
        this.form_person['languages_leves[]'].options[language.language_index].selected=true
        this.form_person['languages_leves[]'].options[language.language_index].value=language.language_level;
        this.form_person['languages_leves[]'].options[language.language_index].text=language.language_level;
    });
    form_person.submit();
});

form_language.addEventListener('submit',(evt)=>{
    evt.preventDefault();
    let div_language=document.createElement('div');
    div_language.textContent=form_language['language_id'].options[form_language['language_id'].selectedIndex].text+" - "+form_language['language_level'].value+"%";
    div_language.setAttribute('title','Eliminar');
    div_language.addEventListener('click',(evt)=>{
        evt.preventDefault();
        let index=languages.findIndex((language)=>{
            return language.obj==div_language;
        });
        languages.splice(index,1);
        div_language.remove();
    });
    languages.push({
        obj:div_language,
        language_index:form_language['language_id'].selectedIndex,
        language_level:form_language['language_level'].value
    });
    this.content_languages.appendChild(div_language);
});