let toggle = document.querySelector('.toggle');
let nav = document.querySelector('.navigation1');
let main = document.querySelector('.main1');
let wrapper = document.querySelector('.wrapper');

toggle.onclick = function () {
    nav.classList.toggle('active')
    main.classList.toggle('active')
    wrapper.classList.toggle('active')
}