'use strict';
import IMask from 'imask';
import ViTab from './TabClass.js';
import FileFunnel from './FileFunnel.js';

document.addEventListener('DOMContentLoaded', function(){

    function slideDown(el){
        el.style.height = 'auto';
        let elHeight = el.offsetHeight;
        el.style.height = '0px';
        setTimeout(function(){
            el.style.height = elHeight + 'px';
        }, 50);
        let interval = setInterval(function(){
            if(el.offsetHeight == elHeight){
               clearInterval(interval);
               el.style.height = 'auto';
               el.style.overflow = 'visible';
            }
        }, 300);
    }
    function slideUp(el){
        el.style.height = el.offsetHeight + 'px';
        el.style.overflow = 'hidden';
        setTimeout(function(){
            el.style.height = '0px';
        }, 100);
        let interval = setInterval(function(){
            if(el.offsetHeight == 0){
                clearInterval(interval);
                el.removeAttribute('style');
            }
        }, 300);
    }
    function toggleSlider(el){
        if(el.offsetHeight > 0){
            slideUp(el);
        }else{
            slideDown(el);
        }
    }

    // мобильное меню
    let burgerBtn = document.querySelector('.burger-btn');
    let nav = document.querySelector('nav');
    if(burgerBtn){
        burgerBtn.addEventListener('click', function(){
            this.classList.toggle('active');
            document.body.classList.toggle('fixed');
            nav.classList.toggle('show');
        })
    }

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
        });
    }

    let nlThousandMask = document.querySelectorAll('.filtr-thousand');
    let arrThousendMask = [];
    if(nlThousandMask.length > 0){
        nlThousandMask.forEach(tm=>{
            arrThousendMask.push(IMask(tm, {mask: [
                '000',
                '0 000',
                '00 000',
                '000 000',
                '0 000 000',
                '00 000 000',
                '000 000 000',
                '0 000 000 000',
                '00 000 000 000',
                '000 000 000 000',
                '0 000 000 000 000',
            ]}));
        })
    }


    // развертывание и сверстывание подменю в главном меню

    let nlMainMenuArrowBtn = document.querySelectorAll('.main-menu__arrow, .main-menu__parent-panel span');
    if(nlMainMenuArrowBtn.length > 0){
        nlMainMenuArrowBtn.forEach(arrow=>{
            arrow.addEventListener('click', function(e){
                e.preventDefault();
                let submenu = arrow.parentElement.nextElementSibling;
                arrow.classList.toggle('active');
                toggleSlider(submenu);
            })
        })
    }

      // работа табов

    let nlTabs = document.querySelectorAll('.ip-tab');
    if(nlTabs.length > 0){
        nlTabs.forEach(tab=>{
            new ViTab(tab);
        });
    }

     // работа видеоконтейнера

     let nlPlayBtn = document.querySelectorAll('.video-box__video-play');
     if(nlPlayBtn.length > 0){
         nlPlayBtn.forEach(btn=>{
             btn.addEventListener('click', function(e){
                 e.preventDefault();
                 let video = this.previousElementSibling;
                 video.setAttribute('controls', 'controls')
                 video.play();
                 this.remove();
             })
         })
     }

     let userMenuBtn = document.querySelector('.header-icon-btn--user');
     if(userMenuBtn){
        userMenuBtn.addEventListener('click', function(){
            this.nextElementSibling.classList.toggle('user-menu--show');
        });
     }


    //  клики вне элемента
    document.addEventListener('click', function (e) {
        // отрабатываю клики вне определенных элементов
        let userMenuBox = document.querySelector('.user-menu-box');
        if (userMenuBox) {
            if (!(e.target.classList.contains('user-menu-box') || e.target.closest('.user-menu-box'))) {
                userMenuBox.querySelector('.user-menu').classList.remove('user-menu--show');
            }
        }
    });

    // автовысота textarea
    var nlTextarea = document.querySelectorAll('.form-elem__textarea-autoheigth');
    if(nlTextarea.length > 0){
        nlTextarea.forEach(tx=>{
            tx.setAttribute('style', 'height:'+ (tx.scrollHeight) +'px;overflow-y:hidden;');
            tx.addEventListener("input", OnInput, false);
        });
    }

    function OnInput() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    }

    // input file
    let fileFunnel = document.querySelector('.file-funnel');
    if(fileFunnel){
        let ffElem = new FileFunnel(fileFunnel,{
            deskBox: '.file-funnel__text',
            reciever: '.file-funnel__receiver',
            accept: ['.pdf', '.jpg', '.png', 'doc', 'docx'],
            docsBox: '.file-funnel__docs'
        });
    }
});
