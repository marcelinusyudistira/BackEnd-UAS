<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih Untuk Sudah Melakukan Registrasi</title>
    <style>
        p{
            font-family: sans-serif;
        }

        body {
            background-color: slategray;
        }

        .card{
            padding: 20px;
            width: 500px;
            background-color: whitesmoke;
            box-shadow: 0 3px 6px black;
            border-radius: 4px;
        }

        .mx-auto{
            margin-left: auto;
            margin-right: auto;
        }

        .mt-5{
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="card center mx-auto mt-5">
        <p>
        Hello, terimakasih sudah bergabung pada Tumbas E-Commerce. <br/>
        Untuk konfirmasi, silahkan klik <a href="{{$detail['activatelink']}}">link ini untuk aktivasi akun</a>
        </p>
    </div>
</body>
</html>