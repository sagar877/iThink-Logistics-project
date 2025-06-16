<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel connection</title>
</head>
<body>
    @php
        // Check if the database connection is established
        if (DB::connection()->getPdo()) {
            echo "Connected to the database: " . DB::connection()->getDatabaseName();
        } else {
            echo "Not connected to any database";
        }
    @endphp
</body>
</html>