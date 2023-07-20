<?php include "./config/database.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/5139251f84.js" crossorigin="anonymous"></script>
</head>

<body class="bg-gray-800 text-gray-200">
  <div class="max-w-3xl mx-auto my-2 px-4">
    <header class="mb-4">
      <div class="flex justify-between items-center p-2 border-b-2 border-b-gray-900">
        <div>
          <a href="/views/src/index.php"></a>
          <h1 class="text-3xl uppercase font-bold transition-transform duration-200 cursor-pointer hover:translate-x-2">views</h1>
        </div>
        <div class="text-xl">
          <?php if (!str_ends_with($_SERVER["PHP_SELF"], "add.php")) : ?>
            <a href="/views/src/add.php">
              <button class="bg-gray-700 py-1 px-3 rounded-md transition-colors duration-200 cursor-pointer hover:bg-gray-900">Add New</button>
            </a>
          <?php endif; ?>
          <?php if (!str_ends_with($_SERVER["PHP_SELF"], "index.php")) : ?>
            <a href="/views/src/index.php">
              <button class="bg-gray-700 py-1 px-3 rounded-md transition-colors duration-200 cursor-pointer hover:bg-gray-900">Return to Homepage</button>
            </a>
          <?php endif; ?>
        </div>
      </div>
    </header>