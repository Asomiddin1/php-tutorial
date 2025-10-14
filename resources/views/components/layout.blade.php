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
    <nav class="flex items-center justify-between py-4 px-8 bg-gray-700 text-white">
        <h1 class="text-[22px] font-semibold"><a href="/">Larevel</a></h1>
       <ul class="flex space-x-4">
        <li class="{{ request()->is('about') ? ' bg-slate-800 text-white px-4 py-2 rounded-md' : 'px-4 py-2 hover:text-white' }}"><a href="/about">About</a></li>
        <li  class="{{ request()->is('students') ? 'bg-slate-800 text-white px-4 py-2 rounded-md' : 'px-4 py-2 hover:text-white' }}"><a href="/students">Students</a></li>
        <li  class="{{ request()->is('users') ? 'bg-slate-800 text-white px-4 py-2 rounded-md' : 'px-4 py-2 hover:text-white' }}"><a href="/users">Users</a></li>
        <li  class="{{ request()->is('jobs') ? 'bg-slate-800 text-white px-4 py-2 rounded-md' : 'px-4 py-2 hover:text-white' }}"><a href="/jobs">Jobs</a></li>
        <li  class="{{ request()->is('contact') ? 'bg-slate-800 text-white px-4 py-2 rounded-md' : 'px-4 py-2 hover:text-white' }}"><a href="/contact">Contact</a></li>
       </ul>
    </nav>
    <div class="bg-gray-200 p-4 text-start text-[20px] font-semibold">
              {{ $heading }}
    </div>
    {{ $slot }} 
</body>
</html>