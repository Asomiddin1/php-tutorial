<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topshiriqlar</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  </head>
</head>
<body>
    <nav class="flex justify-between bg-gray-500 px-8 py-4 text-white">

        <h1 class='text-[22px] font-semibold '><a href="/">Laravel</a></h1>
      <ul class="flex space-x-4 ">
        <li><a href="/about">About</a></li>
        <li><a href="/students">Students</a></li>
        <li><a href="/users">Users</a></li>
        <li><a href="/jobs">Jobs</a></li>
        <li><a href="/contact">Contact</a></li>
      </ul>
    </nav>
    {{ $slot }} 
</body>
</html>