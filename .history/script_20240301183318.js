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
  saveToDatabase();
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

    // TODO: Save data to the database using AJAX and update the server-side records
    saveToDatabase();
  }
}

function saveToDatabase() {
  var todoList = document.getElementById("todo-list");
  var inProgressList = document.getElementById("in-progress-list");
  var doneList = document.getElementById("done-list");

  // Extract task IDs from each list
  var todoTasks = getTaskIds(todoList);
  var inProgressTasks = getTaskIds(inProgressList);
  var doneTasks = getTaskIds(doneList);

  $.ajax({
    type: "POST",
    url: "save.php",
    data: {
      todoTasks: todoTasks,
      inProgressTasks: inProgressTasks,
      doneTasks: doneTasks,
    },
    success: function (response) {
      console.log(response);
    },
    error: function (xhr, status, error) {
      console.error("Error: " + xhr.responseText);
    },
  });
}

function getTaskIds(taskList) {
  // Extract task IDs from the task list
  var taskIds = [];
  var tasks = taskList.getElementsByClassName("task-item");
  for (var i = 0; i < tasks.length; i++) {
    taskIds.push(tasks[i].id);
  }
  return taskIds;
}
