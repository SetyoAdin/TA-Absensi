<!DOCTYPE html>
<html>

<head>
    <title>Absen Test</title>
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

        .success {
            color: green;
            font-weight: bold;
        }

        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>Absen Test Results</h1>

    <div class="section">
        <h2>Test Date</h2>
        <p>The test date used: <strong>{{ $testDate }}</strong></p>
    </div>

    <div class="section">
        <h2>Insert Result</h2>
        @if ($inserted)
            <p class="success">Record was successfully inserted!</p>
        @else
            <p class="error">Failed to insert record.</p>
        @endif
    </div>

    <div class="section">
        <h2>Query Results ({{ count($results) }} records)</h2>
        @if (count($results) > 0)
            <pre>{{ json_encode($results, JSON_PRETTY_PRINT) }}</pre>
        @else
            <p class="error">No records found with the exact date format.</p>
        @endif
    </div>

    <div class="section">
        <h2>Formatted Date Query Results ({{ count($formattedResults) }} records)</h2>
        <p>Formatted date used: <strong>{{ date('Y-m-d', strtotime($testDate)) }}</strong></p>
        @if (count($formattedResults) > 0)
            <pre>{{ json_encode($formattedResults, JSON_PRETTY_PRINT) }}</pre>
        @else
            <p class="error">No records found with the formatted date.</p>
        @endif
    </div>

    <div class="section">
        <h2>All Records in Database ({{ count($allRecords) }} records)</h2>
        @if (count($allRecords) > 0)
            <pre>{{ json_encode($allRecords, JSON_PRETTY_PRINT) }}</pre>
        @else
            <p class="error">No records found in the database.</p>
        @endif
    </div>

    <div class="section">
        <h2>Next Steps</h2>
        <p>After reviewing these results, please try the following:</p>
        <ol>
            <li>Go to <a href="{{ url('/dataabsen?tanggal=2025-04-08') }}">Data Absen page with test date</a></li>
            <li>Check if the record we just inserted appears</li>
            <li>If it still doesn't work, we'll need to modify the AbsenController to handle the date format differently
            </li>
        </ol>
    </div>
</body>

</html>
