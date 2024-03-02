function allowDrop(event) {
    event.preventDefault();
}

function drop(event) {
    event.preventDefault();
    const data = event.dataTransfer.getData("text");
    const draggedElement = document.getElementById(data).cloneNode(true);

    // Customize the ID or any other properties as needed
    draggedElement.id = "newId"; 

    // Append the cloned element to the right container
    document.getElementById("right-container").appendChild(draggedElement);
}

document.addEventListener("DOMContentLoaded", function () {
    const draggables = document.querySelectorAll(".draggable");

    draggables.forEach(draggable => {
        draggable.addEventListener("dragstart", function (event) {
            event.dataTransfer.setData("text", event.target.id);
        });
    });
});
