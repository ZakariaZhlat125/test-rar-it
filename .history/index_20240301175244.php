<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="script.js" defer></script>
</head>
<body>
    <div id="container">
        <div id="left-container" class="container">
            <div class="draggable" draggable="true" id="drag1">Item 1</div>
            <div class="draggable" draggable="true" id="drag2">Item 2</div>
            <!-- Add more draggable items as needed -->
        </div>
        <div id="right-container" class="container" ondrop="drop(event)" ondragover="allowDrop(event)">
            <!-- Drop area on the right side -->
            <table id="data-table">
                <tr>
                    <td id="box1" class="droppable" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td id="box2" class="droppable" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td id="box3" class="droppable" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                </tr>
                <tr>
                    <td id="box4" class="droppable" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td id="box5" class="droppable" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td id="box6" class="droppable" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                </tr>
                <tr>
                    <td id="box7" class="droppable" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td id="box8" class="droppable" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td id="box9" class="droppable" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
