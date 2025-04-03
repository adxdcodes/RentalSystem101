<?php
session_start();
if (isset($_SESSION['is_ad_logged_in'])) {
  $_SESSION['owner_id'] = 2;
  header("Location: dashboard.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../style.css" />
  <link rel="stylesheet" href="../../src/input.css" />
  <title>Rental system</title>
</head>

<body class="flex flex-col min-h-screen select-none">
  <!--- **********************nav*************************** -->
  <div class="flex justify-between border-b border-solid border-gray-500 text-gray-600">
    <h1 class="mx-[7%] my-[40px] text-2xl font-bold text-gray-900">
      Rental System
    </h1>
    <ul class="flex mx-[7%]">
      <a class="my-[33px] mx-[5px] px-5 py-[7px] text-[18px] font-medium duration-300 no-underline hover:text-black hover:border-b-2 hover:border-black ease-in-out" href="/public/">KrushnaKunj</a>
      <!-- <a
          class="my-[33px] mx-[5px] px-5 py-[7px] text-[18px] font-medium duration-300 hover:text-black hover:border-b-2 hover:border-black ease-in-out"
          href="#"
          >Documents</a
        >
        <a
          class="my-[33px] mx-[5px] px-5 py-[7px] text-[18px] font-medium duration-300 hover:text-black hover:border-b-2 hover:border-black ease-in-out"
          href="#"
          >History</a
        > -->
    </ul>
  </div>
  <!--- **********************nav*************************** -->
  <?php
  include '../partials/config.php';
  ?>

  <?php


  include '../partials/dbconnect.php';

  // TO INSERT THE DATA


  ?>

  <!--- ********************** Login Form *************************** -->

  <div class="flex justify-center items-center flex-1 bg-gray-800">
    <div class="bg-white p-8 shadow-md rounded-lg w-full sm:w-96">
      <h2 class="text-2xl font-bold mb-4 text-center">Admin</h2>
      <form method="POST" action="login-process.php">
        <div class="mb-4">
          <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
          <input type="text" id="username" name="username" placeholder="Email or Username" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
        </div>

        <div class="mb-6">
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input type="password" id="password" name="password" placeholder="Password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
        </div>
        <button type="submit" class="w-full bg-gray-500 text-white py-2 px-4 rounded-md focus:outline-none border-gray-600 border-[1.5px] duration-300 ease-in-out hover:text-white hover:bg-black hover:border-black">
          Sign In
        </button>
      </form>
    </div>
  </div>
  <!--- ********************** Login Form *************************** -->
  <!--- **********************Footer*************************** -->
  <div class="flex justify-between border-t border-solid border-gray-500 text-gray-600">
    <h1 class="mx-[7%] my-[20px] text-2xl font-bold text-gray-900">
      Rental System
    </h1>

    <h3 class="my-[20px]">-@adxd all right reserved!</h3>
    <ul class="flex mx-[7%]">
      <!-- <a
          class="my-[13px] mx-[5px] px-5 py-[7px] text-[18px] font-medium duration-300 no-underline hover:text-black hover:border-b-2 hover:border-black ease-in-out"
          href="#"
          >Home</a
        >
        <a
          class="my-[13px] mx-[5px] px-5 py-[7px] text-[18px] font-medium duration-300 hover:text-black hover:border-b-2 hover:border-black ease-in-out"
          href="#"
          >Documents</a
        >
        <a
          class="my-[13px] mx-[5px] px-5 py-[7px] text-[18px] font-medium duration-300 hover:text-black hover:border-b-2 hover:border-black ease-in-out"
          href="#"
          >History</a
        > -->

      <a class="my-[13px] mx-[5px] px-5 py-[7px] text-[18px] font-normal duration-300 ease-in-out hover:text-black" href="/rental-system/public/index.php">Not admin?</a>
    </ul>
  </div>
  <!--- **********************Footer*************************** -->
</body>

</html>