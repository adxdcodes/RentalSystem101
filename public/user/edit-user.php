<?php
session_start();
if (!isset($_SESSION['is_logged_in'])) {
  header("Location: ../index.php");
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
      <a class="my-[33px] mx-[5px] px-5 py-[7px] text-[18px] font-medium duration-300 no-underline hover:text-black hover:border-b-2 hover:border-gray-700 ease-in-out" href="#">Home</a>
      <a class="my-[33px] mx-[5px] px-5 py-[7px] text-[18px] font-medium duration-300 hover:text-black hover:border-b-2 hover:border-gray-700 ease-in-out" href="#">Documents</a>
      <a class="my-[33px] mx-[5px] px-5 py-[7px] text-[18px] font-medium duration-300 hover:text-black hover:border-b-2 hover:border-gray-700 ease-in-out" href="#">History</a>
      <a class="my-[33px] mx-[5px] px-5 py-[7px] text-[18px] font-medium text-red-700 border-gray-600 border-[1.5px] rounded-[1px] duration-300 ease-in-out hover:text-red hover:bg-black hover:border-black focus:outline-none" href="logout.php">Logout</a>
    </ul>
  </div>
  <!--- **********************nav*************************** -->

  <!--- ********************** Main Body *************************** -->
  <div class="flex bg-gray-800 w-full justify-center pt-[2%]">
    <h1 class="font-bold text-5xl text-center text-white">K4</h1>
  </div>
  <div class="flex justify-center flex-1 bg-gray-800 w-full h-full form-padding max-md:flex-col">
    <div class="bg-white p-8 shadow-md rounded-lg w-full sm:w-[550px]">
      <h2 class="text-2xl font-bold mb-4 text-center text-black">Add Info</h2>
      <form>
        <div class="mb-4">
          <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
          <input type="text" id="name" name="name" placeholder="Full Name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
        </div>

        <div class="mb-6">
          <label for="address" class="block text-sm font-medium text-gray-700">Full Address</label>
          <input type="text" id="address" name="address" placeholder="Full Address" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
        </div>
        <div class="mb-4">
          <label for="Occupation" class="block text-sm font-medium text-gray-700">Occupation</label>
          <input type="text" id="Occupation" name="Occupation" placeholder="Occupation" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
        </div>

        <div class="mb-6">
          <label for="contact" class="block text-sm font-medium text-gray-700">Contact No</label>
          <input pattern="[0-9]{10}" type="tel" id="contact" name="contact" placeholder="98765-43210" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
        </div>
        <div class="mb-4">
          <label for="parentname" class="block text-sm font-medium text-gray-700">Parent Name</label>
          <input type="text" id="parentname" name="parentname" placeholder="Father name or Mother name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
        </div>
        <div class="mb-6">
          <label for="parentcontact" class="block text-sm font-medium text-gray-700">Parent's Contact No</label>
          <input pattern="[0-9]{10}" type="tel" id="parentcontact" name="parentcontact" placeholder="Parent's Contact No" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
        </div>

        <div class="mb-6">
          <label for="id1" class="block text-sm font-medium text-gray-700">Your ID 1 (Aadhar Card)</label>
          <input type="file" id="id1" name="id1" placeholder="Aadhar Card" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
        </div>
        <div class="mb-6">
          <label for="id2" class="block text-sm font-medium text-gray-700">Your ID 2 (Corporate Or Educational!)</label>
          <input type="file" id="id2" name="id2" placeholder="Occupational ID" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
        </div>
        <button type="submit" class="w-full bg-gray-500 text-white py-2 px-4 rounded-md focus:outline-none border-gray-600 border-[1.5px] duration-300 ease-in-out hover:text-white hover:bg-black hover:border-black">
          Submit
        </button>
        <p class="text-right pt-2 text-red-700 font-medium">All mandatory.</p>
      </form>
    </div>
  </div>
  <!--- ********************** Main Body *************************** -->

  <!--- **********************Footer*************************** -->
  <div class="flex justify-between border-t border-solid border-gray-500 text-gray-600">
    <h1 class="mx-[7%] my-[20px] text-2xl font-bold text-gray-900">
      Rental System
    </h1>

    <h3 class="my-[20px]">-@adxd all right reserved!</h3>
    <ul class="flex mx-[7%]">
      <a class="my-[13px] mx-[5px] px-5 py-[7px] text-[18px] font-medium duration-300 no-underline hover:text-black ease-in-out" href="#">Home</a>
      <a class="my-[13px] mx-[5px] px-5 py-[7px] text-[18px] font-medium duration-300 hover:text-black ease-in-out" href="#">Documents</a>
      <a class="my-[13px] mx-[5px] px-5 py-[7px] text-[18px] font-medium duration-300 hover:text-black ease-in-out" href="#">History</a>
      <a class="my-[13px] mx-[5px] px-5 py-[7px] text-[18px] font-medium border-gray-600 border-[1.5px] rounded-[1px] duration-300 ease-in-out hover:text-white hover:bg-black hover:border-black focus:outline-none" href="#">Logout</a>
    </ul>
  </div>
  <!--- **********************Footer*************************** -->
</body>

</html>