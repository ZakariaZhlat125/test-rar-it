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
            $
            boxAction('');
        });

        function boxAction(action) {
            var queryString = "action=" + action;

            jQuery.ajax({
                url: 'ajax_action.php',
                data: queryString,
                type: "POST",
                success: function(data) {
                    // Handle success
                },
                error: function() {
                    // Handle error
                }
            });
        }
    </script>
</head>

<body>
    <div id="product-grid">
        <div class="text-heading">Box</div>
        <?php
        $box_array = $db_handle->select("SELECT * FROM tblproduct"); // Replace 'your_table_name' with your actual table name
        if (!empty($box_array)) {
            foreach ($box_array as $key => $value) {
        ?>
                <div class="item" data-name="<?php echo $box_array[$key]['name']; ?>">
                    <strong><?php echo $box_array[$key]["name"]; ?></strong>
                </div>
        <?php
            }
        }
        ?>
    </div>
    <div class="clear-float"></div>
    <div class="box">
        <div class="text-heading">Box Big</div>
        <div class="box"></div>
    </div>
</body>

</html>