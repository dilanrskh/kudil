<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header" style="background-color:#f38fa9; color: black;">
                <h3 class="text-center">Doa Harian</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Doa</th>
                            <th scope="col">Ayat</th>
                            <th scope="col">Latin</th>
                            <th scope="col">Arti</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data_doa as $doa)
                        <tr>
                            <td> {{ $doa->id }}</td>
                            <td> {{ $doa->doa }} </td>
                            <td> {{ $doa->ayat }} </td>
                            <td> {{ $doa->latin }} </td>
                            <td> {{ $doa->artinya }} </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>