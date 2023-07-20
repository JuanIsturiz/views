<?php include "./inc/header.php"; ?>

<?php
$image_error = $title_error = $description_error = "";

if (isset($_POST["submit"])) {
  if (!empty($_FILES["upload"]["name"])) {
    $allowed_ext = array("png", "jpg", "jpeg", "gif");
    $file_name = $_FILES["upload"]["name"];
    $file_size = $_FILES["upload"]["size"];
    $file_tmp = $_FILES["upload"]["tmp_name"];
    $target_dir = "images/$file_name";
    // get file ext
    $file_ext = explode(".", $file_name);
    $file_ext = strtolower(end($file_ext));
    $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);;
    $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_FULL_SPECIAL_CHARS);;
    // check duplicate
    $file = "images/$file_name";

    if (file_exists($file)) {
      $image_error = "File already added";
    } else {
      // validate file ext
      if (in_array($file_ext, $allowed_ext)) {
        if (empty($description)) {
          $title_error = "Title is Required";
        } else if (empty($description)) {
          $description_error = "Description is Required";
        } else {
          move_uploaded_file($file_tmp, $target_dir);
          $path = "images/$file_name";
          $type = pathinfo($path, PATHINFO_EXTENSION);
          $data = file_get_contents($path);
          $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
          $sql = "INSERT INTO views (base64, file_name, title, description) VALUES ('$base64', '$file_name', '$title', '$description')";
          if (mysqli_query($conn, $sql)) {
            // success
            echo "<script language='JavaScript'>alert('View added successfully!');
        location.assign('index.php');</script>";
          } else {
            echo "Error: " . mysqli_error($conn);
          }
        }
      } else {
        $image_error = "Invalid file type";
      }
    }
  } else {
    $image_error = "No file submited";
  }
}
?>

<div class="mx-2">
  <form action="" method="post" enctype="multipart/form-data">
    <div class="flex flex-col gap-4">
      <div class="flex flex-col gap-2">
        <div>
          <label for="image" class="text-lg font-semibold">Choose your image:</label>
          <p class="font-semibold text-red-500">
            <?= empty($image_error) ? null : $image_error ?>
          </p>
        </div>
        <input type="file" name="upload" id="image" class="cursor-pointer">
      </div>
      <div class="flex flex-col gap-2">
        <div>
          <label for="title" class="text-lg font-semibold">Write a title:</label>
          <p class="font-semibold text-red-500">
            <?= empty($title_error) ? null : $title_error ?>
          </p>
        </div>
        <input placeholder="What an amaxing view!" type="text" name="title" id="title" class="text-xl  p-2 bg-gray-950 rounded-sm outline-none"></input>
      </div>
      <div class="flex flex-col gap-2">
        <div>
          <label for="description" class="text-lg font-semibold">Write a description:</label>
          <p class="font-semibold text-red-500">
            <?= empty($description_error) ? null : $description_error ?>
          </p>
        </div>
        <textarea placeholder="A picture of my backyard" name="description" id="description" cols="30" rows="10" class="text-xl  p-2 bg-gray-950 rounded-sm outline-none"></textarea>
      </div>
      <button class="text-xl uppercase mx-auto bg-gray-900 py-1 px-3 rounded-md transition-colors duration-200 cursor-pointer hover:bg-gray-700" type="submit" name="submit">
        Submit
        <i class="fa-solid fa-check"></i>
      </button>
    </div>
  </form>
</div>
<?php include "./inc/footer.php"; ?>