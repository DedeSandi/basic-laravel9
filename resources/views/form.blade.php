<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CSRF</title>
</head>
<body>
    <form action="/form" method="post">
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
        <input type="submit" value="Say Hello">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {{-- dilaravel setiap submit form harus kirim csrf_token yg name inputnya harus _token --}}
        {{-- jika menggunakan AJAX csrf token harus dikirim menggunakan header X-CSRF-TOKEN --}}
    </form>
</body>
</html>