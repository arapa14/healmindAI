<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Dashboard Profesional</h1>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
            Logout
        </button>
    </form>

</body>

</html>
