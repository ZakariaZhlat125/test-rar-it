<?php
session_start();
require_once("DataSource.php");
$db_handle = new DataSource();

if (!empty($_POST["action"])) {
	switch ($_POST["action"]) {
		case "add":
			$query = "SELECT * FROM tblproduct WHERE code=?";
			$paramType = "s";
			$paramArray = array($_POST["code"]);
			$productByCode = $db_handle->select($query, $paramType, $paramArray);
			$itemArray = array($productByCode[0]["code"] => array('name' => $productByCode[0]["name"], 'code' => $productByCode[0]["code"], 'quantity' => '1', 'price' => $productByCode[0]["price"]));

			if (!empty($_SESSION["cart_item"])) {
				if (in_array($productByCode[0]["code"], $_SESSION["cart_item"])) {
					foreach ($_SESSION["cart_item"] as $k => $v) {
						if ($productByCode[0]["code"] == $k)
							$_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
			break;
		case "remove":
			if (!empty($_SESSION["cart_item"])) {
				foreach ($_SESSION["cart_item"] as $k => $v) {
					if ($_POST["code"] == $k)
						unset($_SESSION["cart_item"][$k]);
					if (empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
				}
			}
			break;
		case "empty":
			unset($_SESSION["cart_item"]);
			break;
	}
}
?>
<?php
if (isset($_SESSION["cart_item"])) {
	$item_total = 0;
?>
	<table cellpadding="10" cellspacing="1">
		<tbody>
			<tr>
				<th><strong>Name</strong></th>
				<th><strong>Code</strong></th>
				<th><strong>Quantity</strong></th>
				<th><strong>Price</strong></th>
				<th><strong>Action</strong></th>
			</tr>
			<?php
			foreach ($_SESSION["cart_item"] as $item) {
			?>
				<tr>
					<td><strong><?php echo $item["name"]; ?></strong></td>
					<td><?php echo $item["code"]; ?></td>
					<td><input name="quantity" value="<?php echo $item["quantity"]; ?>" size=3 onChange="calculateTotal(<?php echo $item["quantity"]; ?>,this.value,<?php echo $item["price"]; ?>);" /></td>
					<td align=right><?php echo "$" . $item["price"]; ?></td>
					<td><a onClick="cartAction('remove','<?php echo $item["code"]; ?>')" class="btnRemoveAction cart-action">Remove Item</a></td>
				</tr>
			<?php
				$item_total += ($item["price"] * $item["quantity"]);
			}
			?>

			<tr>
				<td colspan="5" align=right><strong>Total: </strong> $<div id="totalAmount" style="float:right;"><?php echo $item_total; ?></div>
				</td>
			</tr>
		</tbody>
	</table>
<?php
}
?>