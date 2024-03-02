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
    event.target.appendChild(draggedElement);

    // Send data to the server (PHP) for storage
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "process.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Customize the data to be sent to the server
    const sendData = "id=" + encodeURIComponent(data);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Handle the response from the server if needed
            console.log(xhr.responseText);
        }
    };

    xhr.send(sendData);
}

document.addEventListener("DOMContentLoaded", function () {
    const draggables = document.querySelectorAll(".draggable");

	draggables.forEach(draggable => {
		draggable.addEventListener("dragstart", function (event) {
			event.dataTransfer.setData("text", event.target.id);
		});
	});
});
