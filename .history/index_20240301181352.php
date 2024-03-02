<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
  <title>Drag and Drop To-Do List</title>
</head>
<body>

<div class="container">
  <div class="row">
    <div class="col-md-4">
      <div id="todo-list" class="task-list" ondrop="drop(event)" ondragover="allowDrop(event)">
        <h2>To Do</h2>
      </div>
    </div>
    <div class="col-md-4">
      <div id="in-progress-list" class="task-list" ondrop="drop(event)" ondragover="allowDrop(event)">
        <h2>In Progress</h2>
      </div>
    </div>
    <div class="col-md-4">
      <div id="done-list" class="task-list" ondrop="drop(event)" ondragover="allowDrop(event)">
        <h2>Done</h2>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="script.js"></script>
</body>
</html>
