$(document).ready(function () {
  // Fetch and display tasks from the database on page load
  fetchAndDisplayTasks("todo", "todo-tasks-container");
  fetchAndDisplayTasks("in-progress", "in-progress-tasks-container");
  fetchAndDisplayTasks("done", "done-tasks-container");
});

function fetchAndDisplayTasks(listId, containerId) {
  $.ajax({
    type: "GET",
    url: "fetch_tasks.php", // Adjust the URL based on your server-side implementation
    data: { status: listId },
    success: function (response) {
      // Append tasks to the specified container
      $("#" + containerId).html(response);
      addDragListeners();
    },
    error: function (xhr, status, error) {
      console.error("Error fetching tasks: " + xhr.responseText);
    },
  });
}

function addDragListeners() {
  // Add dragstart event listener to each task
  $(".task-item").on("dragstart", function (event) {
    event.originalEvent.dataTransfer.setData("text", event.target.id);
  });

  // Add drop event listener to each task list
  $(".task-list").on("drop", function (event) {
    event.preventDefault();
    var data = event.originalEvent.dataTransfer.getData("text");
    console.log(data);
    var draggedElement = $("#" + data);

    // Get the target task list
    var targetList = $(event.target).closest(".task-list");

    // Append the dragged element to the target task list
    if (targetList) {
      targetList.append(draggedElement);
      // Update the status in the database
      updateTaskStatus(draggedElement.attr("id"), targetList.attr("id"));
    }
  });

  // Add dragover event listener to each task list
  $(".task-list").on("dragover", function (event) {
    event.preventDefault();
  });
}
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
    var newTask = document.createElement("div");
    newTask.innerHTML =
      '<div class="task-item" draggable="true" id="task' +
      Math.floor(Math.random() * 1000) +
      '">' +
      taskText +
      '<button class="delete-btn" onclick="deleteTask(this)">x</button>' +
      "</div>";
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
  addDragListeners();
}

function updateTaskStatus(taskId, status) {
  $.ajax({
    type: "POST",
    url: "update_status.php",
    data: {
      taskId: taskId,
      status: status,
    },
    success: function (response) {
      console.log(response);
    },
    error: function (xhr, status, error) {
      console.error("Error updating task status: " + xhr.responseText);
    },
  });
}
