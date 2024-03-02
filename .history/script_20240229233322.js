function allowDrop(event) {
  event.preventDefault();
}

function drop(event) {
    event.preventDefault();
    const data = event.dataTransfer.getData("text");
  
    // Create a new div element for the dropped item
    const droppedElement = document.createElement("div");
    droppedElement.className = "dropped-item"; // You can add additional classes or styles here
    droppedElement.textContent = document.getElementById(data).textContent; // Copy text content
  
    // Customize the ID or any other properties as needed
    droppedElement.id = "newId";
  
    // Append the new div element to the right container
    event.target.appendChild(droppedElement);
  
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

  draggables.forEach((draggable) => {
    draggable.addEventListener("dragstart", function (event) {
      event.dataTransfer.setData("text", event.target.id);
    });
  });
});
