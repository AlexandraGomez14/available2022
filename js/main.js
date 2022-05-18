$(document).ready(function () {
    getIpClient();
});

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
            'loc': response.data.loc,
            'org': response.data.org,
            'timezone': response.data.timezone,
        };

        $.post('daoDatos.php', datos, function (res) {
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