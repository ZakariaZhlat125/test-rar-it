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

  // Get the target task list
  var targetList = event.target.closest(".task-list");

  // Append the dragged element to the target task list
  if (targetList) {
    targetList.appendChild(draggedElement);
  }

  // TODO: Check if the target list is the "Add Task" box and handle accordingly
  if (targetList.id === "add-task") {
    // Add task handling logic here
    addTask(draggedElement.textContent);
  }

  // TODO: Save data to the database using AJAX and update the server-side records
  saveTaskToDatabase();
}

function addTask(taskText) {
	var taskInput = document.getElementById("taskInput");
	var taskText = taskInput.value.trim();
  
	if (taskText !== "") {
	  // Create a new task item
	  var newTask = document.createElement("div");
	  newTask.textContent = taskText;
	  newTask.className = "task-item";
	  newTask.draggable = true;
	  newTask.id = "task" + Math.floor(Math.random() * 1000);
	  // Make the newly added task draggable
	  newTask.setAttribute("draggable", true);
	  newTask.setAttribute("ondragstart", "drag(event)");
  
	  // Append the new task to the "Add Task" box
	  var addTaskBox = document.getElementById("add-task");
	  addTaskBox.appendChild(newTask);
  
	  // Clear the input field
	  taskInput.value = "";
  
	  // Save the task to the database
	  saveTaskToDatabase(newTask.textContent);
	}
  }
  
  function saveTaskToDatabase(taskText) {
	// TODO: Implement AJAX to save the task to the database
	$.ajax({
	  type: "POST",
	  url: "save.php",
	  data: {
		taskText: taskText,
		action: "addTask", // Indicate that this is an add task action
	  },
	  success: function (response) {
		console.log(response);
	  },
	  error: function (xhr, status, error) {
		console.error("Error: " + xhr.responseText);
	  },
	});
  }
  


