$(document).ready(function(e){
   
    // Submit form data via Ajax
    $("#contactFrm").on('submit', function(e){
        // document.querySelector('.contact .cta--submit span').innerHTML = 'Sending'; 
        // document.querySelectorAll('.contact__error').forEach((item) => {
        //     item.innerHTML = '';
        // });
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: 'sendMail.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(response){ 
                // document.querySelector('.contact .cta--submit span').innerHTML = 'Contact Us'; 

                // if(response.status && response.status == 1) {  
                //     document.querySelector('.contact .cta--submit').classList.add('cta--success');
                //     document.querySelector('.contact .cta--submit span').innerHTML = 'Message sent';
                //     document.querySelector('.contact .cta--submit').setAttribute('disabled', true);
                //     return true;
                // }

                // Object.keys(response).forEach((key) => {
                //     document.querySelector(`.contact__error[data-name=${key}]`).innerHTML = response[key];
                // });
            }, 
            error: function(error) {
                console.log(JSON.stringify(error,null,2))
            }
        });
    
    });
});