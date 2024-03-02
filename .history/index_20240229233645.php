<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Drag and Drop</title>
</head>
<body>
    <div class="container">
        <div id="left-container" class="left-container" ondrop="drop(event)" ondragover="allowDrop(event)">
            <!-- Large square on the left -->
            <div id="large-square" class="large-square" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
        </div>
        <div id="right-container" class="right-container">
            <!-- Small squares on the right -->
            <?php
                for ($i = 1; $i <= 9; $i++) {
                    echo "<div id='small-square-$i' class='small-square' draggable='true' ondragstart='drag(event)'></div>";
                }
            ?>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
