const draggables = document.querySelectorAll('.draggable');
const dropArea = document.getElementById('drop-area');

draggables.forEach(draggable => {
    draggable.addEventListener('dragstart', () => {
        draggable.classList.add('dragging');
    });

    draggable.addEventListener('dragend', () => {
        draggable.classList.remove('dragging');
    });
});

dropArea.addEventListener('dragover', e => {
    e.preventDefault();
    const draggable = document.querySelector('.dragging');
    dropArea.appendChild(draggable.cloneNode(true)); // Clones the draggable element
});

dropArea.addEventListener('drop', e => {
    e.preventDefault();
    const draggable = document.querySelector('.dragging');
    dropArea.appendChild(draggable.cloneNode(true)); // Clones the draggable element
});

dropArea.addEventListener('dragenter', e => {
    e.preventDefault();
    const draggable = document.querySelector('.dragging');
    dropArea.appendChild(draggable.cloneNode(true)); // Clones the draggable element
});
