

function sendMail (){
    const nodemailer = require('nodemailer');

const transporter = nodemailer.createTransport({
    host: "smtp.mailtrap.io",
    port: 2525,
    auth: {
      user: "15402a909b996f",
      pass: "32e611e5b52571"
    }
});

    transporter.sendMail({
        from: '"Me" <web@121corp.mx>',
        to: "rtapia@121corp.com",
        subject: "holis",
        text: "Test de envio de correo perron",
        html: "<b>Test de envio de correo perron</b>"
    }).then(info => {
        console.log({info});
    }).catch(console.log());
    
}


//transporter.verify().then(console.log).catch(console.error);