<!DOCTYPE html>
<html>
<head>
    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>

<table>
    <thead>

    <tr class="answers">
        @foreach($answers as $key=> $answer)
            <th>{{($answer)}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    <tr class="data">
        <td>January</td>
        <td>$100</td>
        <td>January</td>
        <td>$100</td>
    </tr>
    </tbody>
</table>

</body>
</html>
