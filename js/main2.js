$(document).ready(function () {
	//getIpClient();
	
});

var locTotal;

async function getIpClient() {
    try {
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
//https://availableconection.azurewebsites.net/controller/daoDatos.php
        $.post('', datos, function (res) {
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
			//console.log(latitud+" "+ longitud);
			locTotal = (latitud+" "+ longitud);
	}
	
	navigator.geolocation.getCurrentPosition(success, function(msg){
		//locTotal = (latitud+" "+ longitud);
		});
	}
}

var usuario,correo,contra,telefono;
function guardarDatos(){
	try{
		usuario = document.getElementById("usuario").value;
		correo = document.getElementById("correo").value;
		contra = document.getElementById("contra").value;
		telefono = document.getElementById("correo").value;
		
		let datosU = {
			'action': 'add',
            'usuario': usuario,
            'correo': correo,
			'contra': contra,
			'telefono': telefono,
        };
		
		$.post('../controller/registroDao.php', datosU, function (res) {
            var datosR = JSON.parse(res);
            if (!datosR.error) {
                console.log("OK");
            }
            else if (datosR.error) {
                console.log(datosR.error);
            }
        });
		
	} catch (error) {
        console.error(error);
    }	
}