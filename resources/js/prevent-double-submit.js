const isSubmitControl = (control) => {
    if (control instanceof HTMLButtonElement) {
        const type = (control.getAttribute('type') || 'submit').toLowerCase();
        return type === 'submit';
    }
    if (control instanceof HTMLInputElement) {
        const type = control.type.toLowerCase();
        return type === 'submit' || type === 'image';
    }
    return false;
};

const disableSubmitControls = (form) => {
    form.querySelectorAll('button, input[type=submit], input[type=image]').forEach((control) => {
        if (!isSubmitControl(control)) {
            return;
        }

        control.disabled = true;
    });
};

const preventDuplicateSubmissions = () => {
    const lockedForms = new WeakSet();

    const onSubmit = (event) => {
        const form = event.target;
        if (!(form instanceof HTMLFormElement)) {
            return;
        }

        if (lockedForms.has(form)) {
            event.preventDefault();
            return;
        }

        lockedForms.add(form);
        disableSubmitControls(form);
    };

    document.addEventListener('submit', onSubmit, true);
};

preventDuplicateSubmissions();
