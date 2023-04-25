var form=document.getElementById('form');
var list_languages=document.getElementById('list_languages');

document.addEventListener('DOMContentLoaded',()=>{
    this.getLanguages();
});

function getLanguages(){
    HTTP.get('api/list_language_name',(data)=>{
        this.getLanguage(data.languages[0].sISOCode,data.languages[0].sName);
        for(let language of data.languages){
            let option=document.createElement('option');
            option.value=language.sISOCode;
            option.text=language.sName;
            this.list_languages.appendChild(option);
        }
    },null,true);
}

list_languages.addEventListener('change',()=>{
    this.getLanguage(list_languages.options[list_languages.selectedIndex].value,list_languages.options[list_languages.selectedIndex].text);
});

function getLanguage(sISOCode,sName){
    this.form['iso_code'].value=sISOCode;
    this.form['name'].value=sName;
}