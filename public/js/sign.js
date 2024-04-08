window.base64 = {};
base64.ABC = [
	'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
	'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
	'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
	'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
	'0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '+', '/', '=',
];
base64.fromBuffer = input => {
	const bytes = new Uint8Array(input);
	const chars = new Array(Math.ceil(bytes.length * 4 / 3));
	for (let targetIdx = 0, sourceIdx = 0; sourceIdx < bytes.length; sourceIdx += 3) {
		const [ byte1, byte2, byte3, ] = bytes.subarray(sourceIdx, sourceIdx + 3);
		const haveByte2 = Number.isInteger(byte2);
		const haveByte3 = haveByte2 && Number.isInteger(byte3);
		chars[targetIdx++] = base64.ABC[byte1 >> 2 & 0x3F];
		chars[targetIdx++] = base64.ABC[byte1 << 4 & 0x30 | (haveByte2 ? byte2 >> 4 & 0x0F : 0)];
		chars[targetIdx++] = base64.ABC[haveByte2 ? byte2 << 2 & 0x3C | (haveByte3 ? byte3 >> 6 & 0x03 : 0) : 64];
		chars[targetIdx++] = base64.ABC[haveByte3 ? byte3 << 0 & 0x3F : 64];
	}
	return chars.join('');
};
base64.toBuffer = input => {
	const chars = input.replace(/[^A-Za-z0-9\+\/]/g, '');
	const bytes = new Uint8Array(Math.floor(chars.length * 3 / 4));
	for (let targetIdx = 0, sourceIdx = 0; sourceIdx < chars.length; sourceIdx += 4) {
		const [ char1, char2, char3, char4, ] = Array.from(chars.substring(sourceIdx, sourceIdx + 4), item => base64.ABC.indexOf(item));
		const haveChar3 = Number.isInteger(char3);
		const haveChar4 = haveChar3 && Number.isInteger(char4);
		bytes[targetIdx++] = char1 << 2 & 0xFC | char2 >> 4 & 0x03;
		if (haveChar3) bytes[targetIdx++] = char2 << 4 & 0xF0 | char3 >> 2 & 0x0F;
		if (haveChar4) bytes[targetIdx++] = char3 << 6 & 0xC0 | char4 >> 0 & 0x3F;
	}
	return bytes.buffer;
};

function parseCertificateTitle(title, delimeter = ',') {
        const result = {};
        const regexp = new RegExp(
            '([^=]+)\\s*=\\s*(?:([^"' + delimeter + ']+)|"([^"]*(?:""[^"]*)*)")' + delimeter + '?\\s*', 'g'
        );
        let match;
        while ((match = regexp.exec(title)) !== null) {
            result[match[1]] = match[2] || match[3].replace(/""/g, '"');
        }
        return result;
}

function getCertList() {
    return new Promise( (resolve) => {
        cadesplugin.then(async () => {
            let oStore = await cadesplugin.CreateObjectAsync("CAdESCOM.Store");

            await oStore.Open(
                cadesplugin.CADESCOM_CONTAINER_STORE,
                cadesplugin.CAPICOM_MY_STORE,
                cadesplugin.CAPICOM_STORE_OPEN_MAXIMUM_ALLOWED);

            var oCertificates = await oStore.Certificates;
            var count = await oCertificates.Count;

            const thumbprintSet = new Map();

            for (let i = 1; i <= count; i++) {
                    var cert = await oCertificates.Item(i);
                    if (!await cert.HasPrivateKey()) continue;
                    if (thumbprintSet.has(await cert.Thumbprint)) continue;

                    const item = {
                        cert,
                        thumbprint: await cert.Thumbprint,
                        serial: await cert.SerialNumber,
                        subject: parseCertificateTitle(await cert.SubjectName),
                        issuer: parseCertificateTitle(await cert.IssuerName),
                        validFrom: new Date(await cert.ValidFromDate),
                        validUpto: new Date(await cert.ValidToDate),
                    };

                    thumbprintSet.set(await cert.Thumbprint, item);
            }

            resolve(thumbprintSet)
        },
        function(error) {
            alert(error)
        }
       )
    })

}

async function createSignature(certificate, input, detached = true) {
	await cadesplugin;
	const signer = await cadesplugin.CreateObjectAsync('CAdESCOM.CPSigner');
	await signer.propset_Certificate(certificate);
	const signedData = await cadesplugin.CreateObjectAsync('CAdESCOM.CadesSignedData');
	await signedData.propset_ContentEncoding(cadesplugin.CADESCOM_BASE64_TO_BINARY);
	await signedData.propset_Content(input);
	return await signedData.SignCades(signer, cadesplugin.CADESCOM_CADES_BES, detached, cadesplugin.CADESCOM_ENCODE_BASE64);
}

function get_binary_file_and_signe(url, cert) {
    var oReq = new XMLHttpRequest();
    oReq.open("GET", url, true);
    oReq.responseType = "arraybuffer";

    oReq.onload = async function (oEvent) {
      var arrayBuffer = oReq.response; // Note: not oReq.responseText
      if (arrayBuffer) {


        const signatureFile = new File(
            [ base64.toBuffer(await createSignature(cert, base64.fromBuffer(arrayBuffer), true)), ],
            'signe' + (true ? '.sig' : '.p7s'),
            { type: 'application/pkcs7-signature', }
        );

        // linkNode.setAttribute('href', URL.createObjectURL(signatureFile));
	    // linkNode.download = signatureFile.name;
        // linkNode.innerHTML = "Скачать подпись"

        const formData = new FormData()
        formData.append('signature', signatureFile);
        formData.append('signe_id', signe_id.value);

        const config = { 'content-type': 'multipart/form-data' }
        axios.post('/load_signed_file', formData, config)
            .then((response) => {
                document.location.href = return_lnk.value
            })
            .catch(error => {
                console.log(error)
            });
        }

    };

    oReq.send(null);
}

document.addEventListener('DOMContentLoaded',  () => {
    getCertList().then(
        (list) => {
            console.log(list)
            let cert_select = document.getElementById("cert_list")
            if  (cert_select){
                cert_select.itemMap = list
                list.forEach((value, key, set) => {
                    let option = document.createElement('option');
                    option.value = value.thumbprint
                    option.innerHTML = value.subject.CN+" "+value.issuer.CN+" до "+value.validUpto.toLocaleDateString()
                    cert_select.append(option)
                });

            }

        },

        (error) => {
            alert(error)
        }

    )

    do_signe.addEventListener('click', async event => {
        event.preventDefault();
        let cert_select = document.getElementById("cert_list")

        if (!cert_select.value) {
            alert("Выберите сертификат");
            return;
        }
        console.log(file_lnk.value)
        console.log(cert_select.value)
        console.log(cert_select.itemMap)
        console.log(cert_select.itemMap.get(cert_select.value).cert)
        get_binary_file_and_signe(file_lnk.value, cert_select.itemMap.get(cert_select.value).cert)
    })


})
