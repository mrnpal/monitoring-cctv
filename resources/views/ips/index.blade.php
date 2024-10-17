<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring CCTV</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .timeout {
            color: red;
            font-weight: bold;
        }
        .connected {
            color: green;
            font-weight: bold;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
        button:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <h1>Monitoring CCTV</h1>
    <table>
        <tr>
            <th>IP Address</th>
            <th>Port</th>
            <th>Status</th>
            <th>Last Updated</th> <!-- Kolom baru untuk waktu terakhir diperbarui -->
            <th>Action</th>
        </tr>
        @foreach($ips as $ip)
        <tr>
            <td>{{ $ip->ip_address }}</td>
            <td>{{ $ip->port }}</td>
            <td>
                @if($ip->is_timeout)
                    <span class="timeout">Timeout</span>
                @else
                    <span class="connected">Connected</span>
                @endif
            </td>
            <td>{{ $ip->updated_at->timezone('Asia/Jakarta')->format('d-m-Y H:i:s') }}</td> <!-- Tampilkan waktu -->
            <td>
                <button onclick="pingIp({{ $ip->id }})">Ping</button>
            </td>
        </tr>
        @endforeach
    </table>

    <script>
        function pingIp(ipId) {
            $.ajax({
                url: `/ping/${ipId}`,
                method: 'GET',
                success: function() {
                    window.location.reload();
                }
            });
        }

        // Jalankan ping otomatis setiap 1 menit
        setInterval(function() {
            $('button').each(function() {
                $(this).click();
            });
        }, 60000); // 1 menit = 60.000 milidetik
    </script>
</body>
</html>
