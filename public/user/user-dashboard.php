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
  <div class="flex bg-gray-800 text-white w-full justify-center pt-[2%]">
    <h1 class="font-bold text-5xl text-center">K4</h1>
  </div>
  <div class="flex justify-between flex-1 bg-gray-800 text-white w-full h-full p-[7%] max-md:flex-col">
    <!-- this is name of flat -->

    <div class="user-table w-3/5 max-md:w-full max-md:bg-red-900">
      <h2 class="font-bold text-2xl py-5">Members</h2>
      <table class="min-w-full border-2 border-red-100">
        <thead>
          <tr>
            <th class="py-2 px-4 border-b">ID</th>
            <th class="py-2 px-4 border-b">Name</th>
            <th class="py-2 px-4 border-b">Job</th>
            <th class="py-2 px-4 border-b">Contact</th>
            <th class="py-2 px-4 border-b">Actions</th>
          </tr>
        </thead>
        <tbody>
          <!-- Repeat this <tr> for each tenant -->
          <tr class="text-center py-6">
            <td class="py-2 px-4 border-b">1</td>
            <td class="py-2 px-4 border-b">John Doe</td>
            <td class="py-2 px-4 border-b">Software Engineer</td>
            <td class="py-2 px-4 border-b">123-456-7890</td>
            <td class="py-2 px-4 border-b">
              <a href="edit-user.php" class="cursor-pointer bg-yellow-500 text-black py-1 px-5 rounded hover:bg-yellow-600 transition duration-300">
                Edit
              </a>
            </td>
          </tr>
          <tr class="text-center">
            <td class="py-2 px-4 border-b">2</td>
            <td class="py-2 px-4 border-b">John Doe</td>
            <td class="py-2 px-4 border-b">Software Engineer</td>
            <td class="py-2 px-4 border-b">123-456-7890</td>
            <td class="py-2 px-4 border-b">
              <a href="edit-user.php" class="cursor-pointer bg-yellow-500 text-black py-1 px-5 rounded hover:bg-yellow-600 transition duration-300">
                Edit
              </a>
            </td>
          </tr>
          <tr class="text-center">
            <td class="py-2 px-4 border-b">3</td>
            <td class="py-2 px-4 border-b">John Doe</td>
            <td class="py-2 px-4 border-b">Software Engineer</td>
            <td class="py-2 px-4 border-b">123-456-7890</td>
            <td class="py-2 px-4 border-b">
              <a href="edit-user.php" class="cursor-pointer bg-yellow-500 text-black py-1 px-5 rounded hover:bg-yellow-600 transition duration-300">
                Edit
              </a>
            </td>
          </tr>
          <tr class="text-center">
            <td class="py-2 px-4 border-b">4</td>
            <td class="py-2 px-4 border-b">John Doe</td>
            <td class="py-2 px-4 border-b">Software Engineer</td>
            <td class="py-2 px-4 border-b">123-456-7890</td>
            <td class="py-2 px-4 border-b">
              <a href="edit-user.php" class="cursor-pointer bg-yellow-500 text-black py-1 px-5 rounded hover:bg-yellow-600 transition duration-300">
                Edit
              </a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="w-2/5 text-gray-800 bg-white m-[5%] rounded-md py-[3%] text-center">
      <div class="flex justify-center">
        <svg class="svg-icon items-center mt-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
          <path d="M0 64C0 46.3 14.3 32 32 32H96h16H288c17.7 0 32 14.3 32 32s-14.3 32-32 32H231.8c9.6 14.4 16.7 30.6 20.7 48H288c17.7 0 32 14.3 32 32s-14.3 32-32 32H252.4c-13.2 58.3-61.9 103.2-122.2 110.9L274.6 422c14.4 10.3 17.7 30.3 7.4 44.6s-30.3 17.7-44.6 7.4L13.4 314C2.1 306-2.7 291.5 1.5 278.2S18.1 256 32 256h80c32.8 0 61-19.7 73.3-48H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H185.3C173 115.7 144.8 96 112 96H96 32C14.3 96 0 81.7 0 64z" />
        </svg>
        <h1 class="text-4xl font-bold">Rent!</h1>
      </div>

      <h1 class="text-4xl bg-white rounded-sm py-1 px-9">January</h1>
      <p class="mt-2 mb-6 text-gray-600">Due date:</p>

      <!--- ********************** PopUp *************************** -->
      <div class="pop-bg duration-200 ease-in fixed z-10 inset-0 hidden" id="pop-bg">
        <div class="pop-up duration-200 ease-in flex items-center justify-center min-h-screen backdrop-blur-sm text-white rounded bg-opacity-75 transition-all">
          <div class="bg-white duration-200 ease-in p-8 shadow-md rounded-lg w-full sm:w-[600px]">
            <svg id="pop-cross" class="w-[20px] float-end cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
              <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
            </svg>
            <h2 class="text-2xl font-bold mb-4 text-center text-black">
              K4 Rent
            </h2>
            <form>
              <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 float-start">Rent</label>
                <input type="text" id="email" name="email" placeholder="Rent" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
              </div>

              <div class="readings flex gap-2">
                <div class="mb-4">
                  <label for="password" class="block text-sm font-medium text-gray-700 float-start">Current Reading
                  </label>
                  <input type="password" id="password" name="password" placeholder="Cu Reading" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
                </div>
                <div class="mb-4">
                  <label for="password" class="block text-sm font-medium text-gray-700 float-start">Last Reading</label>
                  <input type="password" id="password" name="password" placeholder="La Reading" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
                </div>
              </div>
              <div class="readings-cal flex justify-between gap-2">
                <div class="mb-4">
                  <label for="password" class="block text-sm font-medium text-gray-700 float-start">Rate (per unit)
                  </label>
                  <input type="password" id="password" name="password" placeholder="Rate" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
                </div>

                <div class="mb-4">
                  <label for="password" class="block text-sm font-medium text-gray-700 float-start">Energy Bill</label>
                  <input type="password" id="password" name="password" placeholder="Energy Bill" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
                </div>
              </div>
              <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 float-start">Total</label>
                <input type="password" id="password" name="password" placeholder="Total" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
              </div>
              <button type="submit" class="w-full bg-gray-500 text-white py-2 px-4 rounded-md focus:outline-none border-gray-600 border-[1.5px] duration-300 ease-in-out hover:text-white hover:bg-black hover:border-black">
                Pay Now!
              </button>
            </form>
          </div>
          <input type="checkbox" class="hidden" />
        </div>
      </div>

      <!--- ********************** PopUp *************************** -->

      <a href="#" id="pay-rent" class="text-center text-white mt-1 text-2xl bg-gray-800 py-3 px-9 rounded hover:bg-gray-700 hover:shadow-md outline-none transition duration-300">Pay now.
      </a>
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
  <!--- **********************Script*************************** -->
  <script>
    document.getElementById("pay-rent").addEventListener("click", () => {
      document.getElementById("pop-bg").classList.remove("hidden");
    });
    document.getElementById("pop-cross").addEventListener("click", () => {
      document.getElementById("pop-bg").classList.add("hidden");
    });
  </script>
  <!--- **********************Script*************************** -->
</body>

</html>