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
    <style>
        #box-item {
            border: 2px solid #000; /* Add a border to the box */
            min-height: 100px; /* Set a minimum height for the box */
        }
    </style>
    <script>
        $(document).ready(function() {
            $('.draggable').on('dragstart', function(e) {
                var source_id = $(this).attr('id');
                e.originalEvent.dataTransfer.setData("source_id", source_id);
            });

            $("#box-item").on('dragenter dragover', function(e) {
                e.preventDefault();
                $(this).css('background', '#BBD5B8');
            });

            $("#box-item").on('dragleave', function(e) {
                e.preventDefault();
                $(this).css('background', '#FFFFFF');
            });

            $("#box-item").on('drop', function(e) {
                e.preventDefault();
                $(this).css('background', '#FFFFFF');
                var product_code = e.originalEvent.dataTransfer.getData('source_id');
                cartAction('add', product_code);
            });

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

        function cartAction(action, product_code) {
            // Implement cart action logic here
        }
    </script>
</head>

<body>
    <div id="product-grid">
        <div class="text-heading">Box</div>
        <?php
        $box_array = $db_handle->select("SELECT * FROM tblproduct");
        if (!empty($box_array)) {
            foreach ($box_array as $key => $value) {
        ?>
                <div class="item" data-name="<?php echo $box_array[$key]['name']; ?>">
                    <strong id="<?php echo $box_array[$key]['product_code']; ?>" class="draggable"><?php echo $box_array[$key]["name"]; ?></strong>
                </div>
        <?php
            }
        }
        ?>
    </div>
    <div class="clear-float"></div>
    <div class="box">
        <div class="text-heading">Box Big</div>
        <div id="box-item"></div>
    </div>
</body>

</html>
