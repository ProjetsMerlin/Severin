document.addEventListener('DOMContentLoaded', () => {
    const forms = document.querySelectorAll('.newsletter-form');
    const action = forms[0]?.getAttribute('action');
    if (!action) return;
    forms.forEach(form => {
        form.addEventListener('submit', async event => {
            event.preventDefault();
            const formData = new FormData(form);
            const response =
                await fetch(action, {
                    method: 'POST',
                    body: formData
                });
            const result = await response.json();
            console.log(result);
            if( true === result.success) {
                form.reset();
                window.location.href = document.body.getAttribute('data-baseurl') + 'merci';
            }
            else {
                alert(result.message);
            }
        });
    });
});