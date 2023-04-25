class HTTP{

	static url="http://localhost:8000";

	static post(uri,action,params=null,resert=false){
		this.#request(uri,'POST',action,params,resert);
	}

	static get(uri,action,params=null,resert=false){
		this.#request(uri,'GET',action,params,resert);
	}

	static put(uri,action,params=null,resert=false){
		this.#request(uri,'PUT',action,params,resert);
	}

	static delete(uri,action,params=null,resert=false){
		this.#request(uri,'DELETE',action,params,resert);
	}

	static #request(uri,method,action,params=null,resert=false){
		let form_data=null;
		if(params!=null){
			// form_data=new FormData();
			// for(let key in params){
			// 	form_data.append(key,params[key]);
			// }
			form_data=JSON.stringify(params);
		}
		// Encabezados
		let headers={};
		headers['Content-Type']='application/json';
		headers['Accept']='application/json';
		// Petición
		fetch(HTTP.url+"/"+uri,{
			'method':method,
			'headers':headers,
			'body': form_data
		})
		.then(async(rs)=>{
			let data=await rs.json();
			let message=null;
			switch(rs.status){
				case 200: message=null; break;
				case 400: message="Solicitud incorrecta"; break;
				case 401: message="Error de autentificación"; break;
				case 402: message="Error de autentificación"; break;
				case 403: message="No tiene permisos"; break;
				case 404: message="Error en el servidor"; break;
				case 500: message="Error en el servidor"; break;
			}
			if(rs.status==401){
				this.removeCookie("blog_token");
			}
			if((rs.status<200 || message!=null) && !resert){
				alert(data.error??data.message??message);
				return null;
			}
			if(rs.status!=200 && resert){
				setTimeout(()=>{
					this.#request(uri,method,action,params,resert);
				},5000);	
			}else{
				return data;
			}
			return null;
		})
		.then((data)=>{
			//Util.load(false);
			if(data!=null){
				action(data);
			}
			return data;
		})
		.catch((error)=>{
			//Util.load(false);
			console.log(error);
			if(resert){
				setTimeout(()=>{
					this.#request(uri,method,action,params,resert);
				},5000);	
			}
			return null;
		});
		return null;
	}

	static setCookie(name,value,days){
		let expires="";
		if(days){
			let date=new Date();
			date.setTime(date.getTime()+(days*24*60*60*1000));
			expires="; expires="+date.toUTCString();
		}
		document.cookie=name+"="+value+expires+"; path=/";
	}

	static getCookie(name){
		let nameEQ=name+"=";
		let ca=document.cookie.split(';');
		for(let i=0;i<ca.length;i++){
			let c=ca[i];
			while(c.charAt(0)==' '){
				c=c.substring(1,c.length);
			}
			if(c.indexOf(nameEQ)==0){
				return c.substring(nameEQ.length,c.length);
			}
		}
		return null;
	}

	static removeCookie(name){
		document.cookie=name+'=; Max-Age=-99999999;';
	}
	
}