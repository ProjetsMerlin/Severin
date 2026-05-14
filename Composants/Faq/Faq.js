document.querySelectorAll('.faq').forEach(faq => {
    const items = faq.querySelectorAll('.faq-item');
    
    items.forEach(item => {
        const question = item.querySelector('.faq-question');
        
        question.addEventListener('click', () => {
            item.classList.toggle('active');
        });
    });
});