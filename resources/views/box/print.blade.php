<!doctype html>
<html>

<head>
    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Regsosek Control">
    <meta name="author" content="Ahmad Irfansyah">
    <meta name="keywords"
        content="admin, dashboard, dashboard ui, admin dashboard template, admin panel dashboard, admin panel html, admin panel html template, admin panel template, admin ui templates, administrative templates, best admin dashboard, best admin templates, bootstrap 4 admin template, bootstrap admin dashboard, bootstrap admin panel, html css admin templates, html5 admin template, premium bootstrap templates, responsive admin template, template admin bootstrap 4, themeforest html">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('assets/images/brand/favicon.ico') }}" />

    <!-- TITLE -->
    <title>Regsosek Control</title>
    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{ url('assets/css/bootstrap-print.css') }}" media="all" rel="stylesheet" />
    <link id="style" href="{{ url('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"
        media="all" />

    <style>
        .page-break {
            page-break-after: always;
        }

        .border-dark thead tr th,
        .border-dark tbody tr td,
        .border-dark tbody tr th,
        .border-dark tr td {
            border-width: 1px !important;
            border-style: solid !important;
            border-color: black !important;
            -webkit-print-color-adjust: exact;
        }

        @media print {
            .col-print-1 {
                width: 8%;
                float: left;
            }

            .col-print-2 {
                width: 16%;
                float: left;
            }

            .col-print-3 {
                width: 25%;
                float: left;
            }

            .col-print-4 {
                width: 33%;
                float: left;
            }

            .col-print-5 {
                width: 42%;
                float: left;
            }

            .col-print-6 {
                width: 50%;
                float: left;
            }

            .col-print-7 {
                width: 58%;
                float: left;
            }

            .col-print-8 {
                width: 66%;
                float: left;
            }

            .col-print-9 {
                width: 75%;
                float: left;
            }

            .col-print-10 {
                width: 83%;
                float: left;
            }

            .col-print-11 {
                width: 92%;
                float: left;
            }

            .col-print-12 {
                width: 100%;
                float: left;
            }
        }
    </style>
</head>

<body>
    <h1 class="text-center h1" style="font-size: 50; font-family:Arial, Helvetica, sans-serif">
        <b>{{ $box->nama }}</b>
    </h1>
    <div class="container-fluid" style=" font-family:Arial, Helvetica, sans-serif">
        <div class="row">
            <div class="col-print-6 me-3" style="">
                <table class="table border-dark table-bordered text-nowrap text-md-nowrap mg-b-0 table-sm">
                    <thead>
                        <tr class="text-center align-middle">
                            <th class=" align-middle">No</th>
                            <th class="align-middle">ID SLS</th>
                            <th class="align-middle">Tipe Dok</th>
                            <th class="align-middle">Set </th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($data as $key => $dt)
                            <tr class="text-center align-middle">
                                <td class="align-middle" rowspan="{{ count($dt->dok) }}">
                                    {{ ++$key }}</td>
                                <td class="align-middle" rowspan="{{ count($dt->dok) }}">
                                    {{ $dt['id_sls'] }}
                                </td>
                                <td>{{ $dt->dok[0]['kues'] }}</td>
                                <td>{{ $dt->dok[0]['set'] }}</td>
                            </tr>
                            @for ($dok = 1; $dok <= count($dt->dok) - 1; $dok++)
                                <tr class="text-center">
                                    <td>{{ $dt->dok[$dok]['kues'] }}</td>
                                    <td>{{ $dt->dok[$dok]['set'] }}</td>
                                </tr>
                            @endfor
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</body>

</html>
