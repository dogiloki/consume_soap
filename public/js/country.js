var form=document.getElementById('form');
var list_countries=document.getElementById('list_countries');

document.addEventListener('DOMContentLoaded',()=>{
    this.getCountries();
});

function getCountries(){
    HTTP.get('api/list_country_name',(data)=>{
        this.getCountry(data.countries[0].sISOCode);
        for(let country of data.countries){
            let option=document.createElement('option');
            option.value=country.sISOCode;
            option.text=country.sName;
            this.list_countries.appendChild(option);
        }
    },null,true);
}

list_countries.addEventListener('change',()=>{
    this.getCountry(list_countries.options[list_countries.selectedIndex].value);
});

function getCountry(sISOCode){
    HTTP.get('api/full_country_info/'+sISOCode,(data)=>{
        country=data.country;
        console.log(country);
        this.form['iso_code'].value=country.sISOCode;
        this.form['name'].value=country.sName;
        this.form['capital'].value=country.sCapitalCity;
        this.form['phone_code'].value=country.sPhoneCode;
        this.form['currency_iso_code'].value=country.sCurrencyISOCode;
        this.form['continent_iso_code'].value=country.sContinentCode;
        this.form['src_flag'].value=country.sCountryFlag;
        this.form['img_src_flag'].src=country.sCountryFlag;
    },null,true);
}