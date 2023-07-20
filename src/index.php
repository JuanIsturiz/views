<?php include "./inc/header.php"; ?>

<?php
$sql = "SELECT * FROM views";
$result = mysqli_query($conn, $sql);
$views = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<h1 class="text-4xl text-center text-gray-300 font-semibold mb-4 underline underline-offset-4">Your Views</h1>
<div class="flex flex-col gap-4 items-center">
  <?php foreach ($views as $view) : ?>
    <div class="relative flex flex-col w-60 sm:w-full sm:flex-row gap-2 p-3 shadow-lg bg-gray-700 rounded-md">
      <div class="mx-auto sm:mx-0">
        <img class="rounded-md aspect-square object-cover" src="<?= $view["base64"]; ?>" alt="<?= $view["description"]; ?>" width="200px" height="200px">
      </div>
      <div>
        <div class="flex flex-col items-start mb-2 sm:flex-row sm:gap-2">
          <p class="text-xl"><?= $view["title"]; ?></p>
          <p class="hidden text-xl text-gray-400 sm:inline">·</p>
          <p class="text-xl text-gray-400"><?= explode(" ", $view["date"])[0]; ?></p>
        </div>
        <p class="text-xl font-light"><?= $view["description"] ?></p>
      </div>
      <div class="sm:absolute sm:bottom-4 sm:right-4 flex items-center gap-4">
        <a href="/views/src/edit.php?view_id=<?= $view["id"]; ?>">
          <button class="w-24 bg-green-500 text-md text-gray-950 px-4 py-2 rounded hover:animate-pulse active:scale-105">
            <p>Edit <i class="fa-regular fa-pen-to-square"></i></p>
          </button>
        </a>
        <a href="/views/src/delete.php?view_id=<?= $view["id"]; ?>&file_name=<?= $view["file_name"]; ?>">
          <button class="w-24 bg-red-500 text-md text-gray-950 px-4 py-2 rounded hover:animate-pulse active:scale-105">
            <p>Delete <i class="fa-solid fa-trash"></i></p>
          </button>
        </a>
      </div>
    </div>
  <?php endforeach; ?>
</div>
<?php include "./inc/footer.php"; ?>