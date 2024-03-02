<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drag and Drop Example</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div id="left-container" class="left-container">
            <!-- Large square divided into 9 sections -->
            <div id="drop-area" class="drop-area">
                <!-- Drop area for small squares -->
            </div>
        </div>
        <div id="right-container" class="right-container">
            <!-- Small squares for dragging -->
            <div class="draggable" id="item1" draggable="true">1</div>
            <div class="draggable" id="item2" draggable="true">2</div>
            <!-- Add more small squares as needed -->
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
