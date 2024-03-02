function allowDrop(event) {
  event.preventDefault();
}

function drag(event) {
  event.dataTransfer.setData("text", event.target.id);
}

function drop(event) {
  event.preventDefault();
  var data = event.dataTransfer.getData("text");
  var draggedElement = document.getElementById(data);

  // Clone the dragged element
  var clone = draggedElement.cloneNode(true);
  clone.id = data + "-clone";

  // Append the clone to the large square on the left
  document.getElementById("large-square").appendChild(clone);
}
