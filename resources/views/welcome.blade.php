<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Vue Datasource with Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/app.css">
        <style>
            body {
                font-family: 'Roboto Condensed', sans-serif !important;
            }
        </style>
    </head>
    <body>
        <div id="app">
            <div class="container">
                <h2 class="text-center">Using vue-datasource with Laravel Pagination (Server Side)</h2>
                <h4 class="text-center">Created by <a href="https://github.com/coderdiaz/vue-datasource">@coderdiaz</a></h4>
                <div class="text-center">Powered by <img src="images/algolia_logotype.svg" width="70"></div>
                <br>
                <datasource
                    language="en"
                    :table-data="users.data"
                    :columns="columns"
                    :pagination="users.pagination"
                    :actions="actions"
                    v-on:change="changePage"
                    v-on:searching="onSearch"></datasource>
            </div>
        </div>

        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token()
            ]); ?>
        </script>
        <script type="text/javascript" src="js/app.js"></script>
    </body>
</html>
