<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="check" method="post">
        {{csrf_field()}}
        user:
        <input type="text" name="username" id="">
        pass:
        <input type="text" name="password" id="">
        <input type="submit" value="提交">
        <input type="reset" value="重置">
    </form>
</body>
</html>