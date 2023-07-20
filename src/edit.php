<?php include "./inc/header.php"; ?>

<?php
$view_id = $_GET["view_id"];

$sql = "SELECT * FROM views WHERE id = $view_id";
$result = mysqli_query($conn, $sql);
$view_info = mysqli_fetch_row($result);

if (isset($_POST["submit"])) {
  $new_title = filter_input(INPUT_POST, "new_title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $new_description = filter_input(INPUT_POST, "new_description", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  if (empty($new_title) && empty($new_description)) {
    header("Location: /views/src/index.php");
  } else {
    if (!empty($new_title) && !empty($new_description)) {
      $sql = "UPDATE views SET title='$new_title' description='$new_description' WHERE id=$view_id";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        header("Location: /views/src/index.php");
      } else {
        echo "Error: " . mysqli_error($conn);
      }
    }
    if (!empty($new_title)) {
      $sql = "UPDATE views SET title='$new_title' WHERE id=$view_id";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        header("Location: /views/src/index.php");
      } else {
        echo "Error: " . mysqli_error($conn);
      }
    }
    if (!empty($new_description)) {
      $sql = "UPDATE views SET description='$new_description' WHERE id=$view_id";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        header("Location: /views/src/index.php");
      } else {
        echo "Error: " . mysqli_error($conn);
      }
    }
  }
}
?>

<h1 class="text-2xl font-semibold underline underline-offset-4 mb-6">Edit View</h1>
<form action="" method="post" enctype="multipart/form-data">
  <div class="flex flex-col gap-4">
    <div class="flex flex-col gap-2">
      <div>
        <label for="new_title" class="text-lg font-semibold">New title:</label>
      </div>
      <input placeholder="<?= $view_info["3"]; ?>" type="text" name="new_title" id="new_title" class="text-xl  p-2 bg-gray-950 rounded-sm outline-none"></input>
    </div>
    <div class="flex flex-col gap-2">
      <div>
        <label for="new_description" class="text-lg font-semibold">New description:</label>
      </div>
      <textarea placeholder="<?= $view_info["4"]; ?>" name="new_description" id="new_description" cols="30" rows="10" class="text-xl p-2 bg-gray-950 rounded-sm outline-none"></textarea>
    </div>
    <div class="flex gap-6 mx-auto">
      <a href="/views/src/index.php">
        <button class="text-xl uppercase mx-auto bg-gray-900 py-1 px-3 rounded-md transition-colors duration-200 cursor-pointer hover:bg-gray-700" type="button" name="submit">
          Cancel
          <i class="fa-solid fa-x"></i>
        </button>
      </a>
      <button class="text-xl uppercase mx-auto bg-gray-900 py-1 px-3 rounded-md transition-colors duration-200 cursor-pointer hover:bg-gray-700" type="submit" name="submit">
        Update
        <i class="fa-solid fa-check"></i>
      </button>
    </div>
  </div>
</form>
<?php include "./inc/footer.php"; ?>