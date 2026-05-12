document.querySelectorAll('.menu').forEach(menu => {
    const burger = menu.querySelector('.menu-burger');
    
    burger.addEventListener('click', () => {
        menu.classList.toggle('menu-open');
    });
});