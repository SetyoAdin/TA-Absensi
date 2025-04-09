<!DOCTYPE html>
<html>

<head>
    <title>Database Diagnostic</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }

        .section {
            margin-bottom: 30px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        h2 {
            color: #333;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        pre {
            background-color: #f5f5f5;
            padding: 10px;
            border-radius: 5px;
            overflow-x: auto;
        }

        .error {
            color: red;
            font-weight: bold;
        }

        .success {
            color: green;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>Database Diagnostic</h1>

    <div class="section">
        <h2>Table Existence</h2>
        @if ($tableExists)
            <p class="success">The 'absens' table exists in the database.</p>
        @else
            <p class="error">The 'absens' table does NOT exist in the database.</p>
        @endif
    </div>

    <div class="section">
        <h2>Table Structure</h2>
        <h3>Columns:</h3>
        <pre>{{ implode(', ', $columns) }}</pre>
    </div>

    <div class="section">
        <h2>Sample Record</h2>
        @if (count($sampleRecord) > 0)
            <pre>{{ json_encode($sampleRecord[0], JSON_PRETTY_PRINT) }}</pre>
        @else
            <p class="error">No records found in the absens table.</p>
        @endif
    </div>

    <div class="section">
        <h2>All Records ({{ count($allAbsens) }})</h2>
        @if (count($allAbsens) > 0)
            <pre>{{ json_encode($allAbsens, JSON_PRETTY_PRINT) }}</pre>
        @else
            <p class="error">No records found in the absens table.</p>
        @endif
    </div>

    <div class="section">
        <h2>Records for Date 2025-04-08 ({{ count($dateAbsens) }})</h2>
        @if (count($dateAbsens) > 0)
            <pre>{{ json_encode($dateAbsens, JSON_PRETTY_PRINT) }}</pre>
        @else
            <p class="error">No records found for date 2025-04-08.</p>
        @endif
    </div>
</body>

</html>
