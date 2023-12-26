'use strict';
import IMask from 'imask';

document.addEventListener('DOMContentLoaded', function(){

    // показ и скрытие пароля
    let nlTogglePassBtn = document.querySelectorAll('.form-elem__btn-show-pass');
    if(nlTogglePassBtn.length > 0){
        nlTogglePassBtn.forEach(passBtn=>{
            passBtn.addEventListener('click', function(e){
                e.preventDefault();
                this.classList.toggle('show');
                if(this.previousElementSibling.getAttribute('type') == 'password'){
                    this.previousElementSibling.setAttribute('type', 'text');
                }else{
                    this.previousElementSibling.setAttribute('type', 'password');
                }
            });
        })

    }

    // Маски
    let nlTelMask = document.querySelectorAll('.tel-mask');
    let arrTelMask  = [];
    if(nlTelMask.length > 0){
        nlTelMask.forEach(telmaks=>{
            arrTelMask.push(IMask(telmaks, { mask: '+{7}(000)000-00-00'}))
        })
    }

});
