const WebSocket = require('ws');
const pveajs = require("pvea")

let jsonData = require('./config.json');

const wss = new WebSocket.Server({ port: jsonData.port });

wss.on('connection', function connection(ws, req) {
    console.log(req.url);
    if (req.url == '/websockify') {
        ws.on('message', function incoming(message) {
            if (!ws.first) {
                return;
            }
            try {
                message = JSON.parse(message);
            } catch (error) {
                ws.send("Error 1");
                ws.terminate();
                return;
            }
            if (message.sessionid) {
                ws.first = false;
                ws.sessionid = message.sessionid;
                ws.serverid = message.serverid;
                getNoVNCInfo(ws);
            }
        });
        var request = require('request');
        ws.first = true;
        ws.curlob = request;
    } else {
        ws.on('message', function incoming(message) {
            if (message == 'Pong') {
                ws.pong = true;
                return;
            }
            try {
                messagej = JSON.parse(message);
            } catch (error) {
                ws.send("Error");
                return;
            }
            if (messagej.sessionid) {
                ws.sessionid = messagej.sessionid;
                ws.serverid = messagej.serverid;
            } else {
                ws.send('Close');
                ws.terminate();
            }
        });
        var request = require('request');
        ws.curlob = request;
        ws.pong = true;
        socketloop(ws, 0);
    }
});


function socketloop(ws, loopcount) {
    loopcount++;
    if (loopcount == 10) {
        if (!ws.pong) {

            ws.send('Close');
            ws.terminate();
            return;
        }
        ws.pong = false;

        ws.send('Ping');
        loopcount = 0;
    }
    setTimeout(function() {
        if (!ws.serverid) {
            ws.send('Close');
            ws.terminate();
            return;
        }
        const formData = {
            'id': ws.serverid,
            'sessionid': ws.sessionid
        }
        ws.curlob.post({ url: jsonData.backendendpoint, formData: formData, headers: { 'Function': 'vservercurrentstats', 'key': jsonData.backendapikey } }, function(error, response, body) {
            try {
                ws.send(JSON.stringify(JSON.parse(body).response));
                socketloop(ws, loopcount);
            } catch (e) {
                return;
            }
        })
    }, 500)
}

function getNoVNCInfo(ws) {
    const formData = {
        'id': ws.serverid,
        'sessionid': ws.sessionid
    }
    ws.curlob.post({ url: jsonData.backendendpoint, formData: formData, headers: { 'Function': 'getVNCInfo', 'key': jsonData.backendapikey } }, function(error, response, body) {
        try {
            body = JSON.parse(body);
        } catch (e) {
            return;
        }
        if (body.fail) {
            ws.send("Error 2");
            ws.terminate();
            return;
        }
        body = body.response;
        ws.send(body.password);
        const endpoint = "wss://" + body.nodehostname + ":8006/api2/json";
        let vncproxy_port = body.port;
        let vncproxy_ticket = body.ticket;
        const pvea = new pveajs(body.nodehostname, 'interface@pve', "WDs8X1Pi9RpC8LWRhbvA");
        async function getProxmoxData() {
            const clientWS = new WebSocket(
                `${endpoint}/nodes/${body.node}/qemu/${ws.serverid}/vncwebsocket?port=${vncproxy_port}&vncticket=${encodeURIComponent(vncproxy_ticket)}`, ["binary"], {
                    headers: { Cookie: pvea.ticket },
                }
            );

            clientWS.on("unexpected-response", (req, res) => {
                console.log(req);
                console.log(res);
            });

            clientWS.on("message", (message) => {
                ws.send(message);
            });
            clientWS.on("close", () => ws.close());
            clientWS.on("error", (e) => console.log(e) && ws.close());

            ws.on("message", (message) => {
                clientWS.send(message);
            });
            ws.on("close", () => clientWS.close());
            ws.on("error", (e) => console.log(e) && clientWS.close());
        }
        pvea.run(getProxmoxData);
    })
}