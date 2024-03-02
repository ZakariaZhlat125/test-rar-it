<?php 
require_once('DataSource.php');
$db_handle = new DataSource;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Box</title>
    <script>
        $(document).ready(function() {

        })
    </script>
</head>
<body>
    <div id="product-grid">
        <div class="text-heading"> Box</div>
        <?php 
        $box_array = $db_handle->select("SELECT $")
        ?>
    </div>
</body>
</html>