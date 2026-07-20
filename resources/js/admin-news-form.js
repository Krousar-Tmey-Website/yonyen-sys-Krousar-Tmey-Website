function clearAjaxErrors(form) {
    form.querySelectorAll('.form-error.ajax-error').forEach((error) => error.remove());
    form.querySelectorAll('.form-control.error').forEach((field) => field.classList.remove('error'));
}

function setStatus(form, message, state = 'idle') {
    const status = form.querySelector('[data-news-form-status]');
    if (!status) return;

    const colors = {
        idle: '#6b7280',
        saving: '#2d6fa3',
        success: '#15803d',
        error: '#b91c1c',
    };

    status.innerHTML = `<span class="dot"></span>${message}`;
    status.style.color = colors[state] || colors.idle;
}

function fieldByName(form, name) {
    const escaped = CSS.escape(name);
    return form.querySelector(`[name="${escaped}"], [name="${escaped}[]"]`);
}

function showAjaxErrors(form, errors) {
    Object.entries(errors || {}).forEach(([name, messages]) => {
        const field = fieldByName(form, name.replace(/\.\d+$/, '[]')) || fieldByName(form, name);
        if (!field) return;

        field.classList.add('error');

        const error = document.createElement('div');
        error.className = 'form-error ajax-error';
        error.textContent = Array.isArray(messages) ? messages[0] : messages;

        const group = field.closest('.form-group') || field.parentElement;
        group?.appendChild(error);
    });
}

function resetUploadedPreviews(form) {
    form.querySelectorAll('input[type="file"]').forEach((input) => {
        input.value = '';
    });
}

function updateCreateFormAfterSave(form, news) {
    if (!news?.update_url || form.dataset.savedOnce === 'true') return;

    form.dataset.savedOnce = 'true';
    form.action = news.update_url;

    let method = form.querySelector('input[name="_method"]');
    if (!method) {
        method = document.createElement('input');
        method.type = 'hidden';
        method.name = '_method';
        form.appendChild(method);
    }
    method.value = 'PUT';

    const submitLabel = form.querySelector('button[type="submit"]');
    if (submitLabel) {
        submitLabel.lastChild.textContent = ' Update Article';
    }
}

async function submitNewsForm(form) {
    clearAjaxErrors(form);
    setStatus(form, 'Saving...', 'saving');

    const isEditingExisting = form.querySelector('input[name="_method"]')?.value === 'PUT';

    const submitButton = form.querySelector('button[type="submit"]');
    if (submitButton) {
        submitButton.disabled = true;
        submitButton.style.opacity = '0.65';
    }

    try {
        const response = await fetch(form.action, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: new FormData(form),
        });

        const data = await response.json().catch(() => ({}));

        if (response.status === 422) {
            showAjaxErrors(form, data.errors || {});
            setStatus(form, 'Please fix the highlighted fields.', 'error');
            return;
        }

        if (!response.ok) {
            throw new Error(data.message || 'Save failed.');
        }

        updateCreateFormAfterSave(form, data.news);
        resetUploadedPreviews(form);
        setStatus(form, data.message || 'Saved successfully.', 'success');

        // Editing an existing article goes back to the article list once saved;
        // a brand-new article stays on the page (now in edit mode) so uploads
        // like gallery/video attach to a real record instead of being lost.
        if (isEditingExisting && data.news?.index_url) {
            window.location.href = data.news.index_url;
            return;
        }
    } catch (error) {
        setStatus(form, error.message || 'Save failed. Please try again.', 'error');
    } finally {
        if (submitButton) {
            submitButton.disabled = false;
            submitButton.style.opacity = '';
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-news-ajax-form]').forEach((form) => {
        form.addEventListener('submit', (event) => {
            event.preventDefault();
            submitNewsForm(form);
        });
    });
});
