// Take all elements
const deleteForms = document.querySelectorAll('.delete-form');
const modal = document.getElementById('modal');
const modalTitle = document.querySelector('.modal-title');
const modalBody = document.querySelector('.modal-body');
const confirmationButton = document.getElementById('modal-confirmation-button');

// Active form flag
let activeForm = null;

// Add submit action on form deletes
deleteForms.forEach(form => {
    form.addEventListener('submit', e => {
        e.preventDefault();

        activeForm = form;

        const wordTerm = form.dataset.word;

        // Insert contents
        confirmationButton.innerText = 'Delete Confirmation';
        confirmationButton.className = 'btn btn-danger';
        modalTitle.innerText = 'Delete word';
        modalBody.innerText = `Are you sure to delete ${wordTerm}?`;
    })
})

// Confirmation action
confirmationButton.addEventListener('click', () => {
    if (activeForm) activeForm.submit();
});

modal.addEventListener('hidden.bs.modal', () => {
    activeForm = null;
})