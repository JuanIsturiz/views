<?php include "./inc/header.php"; ?>

<?php
$view_id = $_GET["view_id"];
$file_name = $_GET["file_name"];
unlink("images/$file_name");
$sql = "DELETE FROM views WHERE id='$view_id'";
$result = mysqli_query($conn, $sql);
if ($result) {
  echo "<script language='JavaScript'>alert('View deleted successfully!');
        location.assign('index.php');</script>";
} else {
  echo "Error: " . mysqli_error($conn);
}
?>
<div class="text-center mx-auto p-4">
  <h1 class="text-2xl">Deleting...</h1>
</div>
<?php include "./inc/footer.php"; ?>