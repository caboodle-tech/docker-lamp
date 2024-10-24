const Listing = (() => {

    const toggle = (type) => {
        const form = document.createElement('form');
        form.style.display = 'none';
        form.method = 'POST';
        form.action = 'assets/listing.php';

        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'toggle';
        input.value = type;

        form.appendChild(input);
        document.body.appendChild(form);

        // Let the toggle finish
        setTimeout(() => {
            form.submit();
        }, 300);
    };

    return {
        toggle
    };

})();
