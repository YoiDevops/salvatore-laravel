(() => {
    const confirmedForms = new WeakSet();
    let modalQueue = Promise.resolve();
    let dialog;
    let title;
    let message;
    let cancelButton;
    let confirmButton;
    let resolveCurrent;

    const createDialog = () => {
        if (dialog) return dialog;
        if (!document.body) {
            throw new Error('The confirmation dialog requires a document body.');
        }

        dialog = document.createElement('dialog');
        dialog.className = 'app-confirmation-dialog';
        dialog.setAttribute('aria-labelledby', 'app-confirmation-title');
        dialog.setAttribute('aria-describedby', 'app-confirmation-message');

        const content = document.createElement('div');
        content.className = 'app-confirmation-dialog__content';

        const icon = document.createElement('span');
        icon.className = 'app-confirmation-dialog__icon';
        icon.setAttribute('aria-hidden', 'true');
        icon.textContent = '!';

        title = document.createElement('h2');
        title.className = 'app-confirmation-dialog__title';
        title.id = 'app-confirmation-title';

        message = document.createElement('p');
        message.className = 'app-confirmation-dialog__message';
        message.id = 'app-confirmation-message';

        const actions = document.createElement('div');
        actions.className = 'app-confirmation-dialog__actions';

        cancelButton = document.createElement('button');
        cancelButton.className = 'app-confirmation-dialog__button app-confirmation-dialog__button--cancel';
        cancelButton.type = 'button';
        cancelButton.dataset.confirmationCancel = '';

        confirmButton = document.createElement('button');
        confirmButton.className = 'app-confirmation-dialog__button app-confirmation-dialog__button--confirm';
        confirmButton.type = 'button';
        confirmButton.dataset.confirmationAccept = '';

        actions.append(cancelButton, confirmButton);
        content.append(icon, title, message, actions);
        dialog.append(content);
        document.body.append(dialog);

        const finish = (accepted) => {
            if (!resolveCurrent) return;

            const resolve = resolveCurrent;
            resolveCurrent = null;
            dialog.close();
            resolve(accepted);
        };

        cancelButton.addEventListener('click', () => finish(false));
        confirmButton.addEventListener('click', () => finish(true));
        dialog.addEventListener('cancel', (event) => {
            event.preventDefault();
            finish(false);
        });
        dialog.addEventListener('click', (event) => {
            if (event.target === dialog) finish(false);
        });

        return dialog;
    };

    const showDialog = (options, mode) => {
        if (!options || typeof options.message !== 'string' || !options.message.trim()) {
            return Promise.reject(new TypeError('A confirmation message is required.'));
        }

        return new Promise((resolve) => {
            const modal = createDialog();
            resolveCurrent = resolve;
            modal.dataset.tone = options.tone === 'danger' ? 'danger' : 'neutral';
            title.textContent = options.title || (mode === 'confirm' ? '¿Confirmas esta acción?' : 'Información');
            message.textContent = options.message;
            cancelButton.textContent = options.cancelLabel || 'Cancelar';
            confirmButton.textContent = options.confirmLabel || (mode === 'confirm' ? 'Confirmar' : 'Entendido');
            cancelButton.hidden = mode !== 'confirm';

            modal.showModal();
            (mode === 'confirm' ? cancelButton : confirmButton).focus();
        });
    };

    const queueDialog = (options, mode) => {
        const result = modalQueue.then(() => showDialog(options, mode));
        modalQueue = result.then(
            () => undefined,
            (error) => {
                console.error('No se pudo mostrar el diálogo de confirmación.', error);
            },
        );

        return result;
    };

    window.confirmWithAppModal = (options) => queueDialog(options, 'confirm');
    window.showAppNotice = (options) => queueDialog(options, 'notice');

    document.addEventListener('submit', (event) => {
        const form = event.target;
        if (!(form instanceof HTMLFormElement) || !form.hasAttribute('data-confirm-message')) return;

        if (confirmedForms.has(form)) {
            confirmedForms.delete(form);
            return;
        }

        event.preventDefault();
        event.stopImmediatePropagation();

        const submitter = event.submitter;
        window.confirmWithAppModal({
            title: form.dataset.confirmTitle || 'Confirmar eliminación',
            message: form.dataset.confirmMessage,
            confirmLabel: form.dataset.confirmLabel || 'Eliminar',
            tone: form.dataset.confirmTone || 'danger',
        }).then((accepted) => {
            if (!accepted || !form.isConnected || !form.reportValidity()) return;

            confirmedForms.add(form);
            if (submitter instanceof HTMLElement && submitter.form === form) {
                form.requestSubmit(submitter);
            } else {
                form.requestSubmit();
            }
        }).catch((error) => {
            console.error('No se pudo completar la confirmación del formulario.', error);
        });
    }, true);
})();
