<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cryptocurrencies</title>

        <link rel="stylesheet" 
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" 
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" 
          crossorigin="anonymous">
    </head>
    <body>
        <h1 class="display-4 text-center">Cryptocurrencies</h1>
        
        <table class="table table-striped" style="width:500px; margin:25px auto 0;">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Current price, USD</th>
                    <th scope="col">Current price date</th>
                    <th scope="col">Active</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($currencies as $currency)
                    <tr>
                        <td>
                            <span>{{ $currency['id'] }}</span>
                        </td>
                        <td>
                            <span>{{ $currency['name'] }} ({{ $currency['short_name'] }})</span>
                        </td>
                        <td>
                            <span>{{ $currency['actual_course'] }}</span>
                        </td>
                        <td>
                            <span>{{ $currency['actual_course_date'] }}</span>
                        </td>
                        <td>
                            <span>{{ $currency['active'] ? 'Yes' : 'No' }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
