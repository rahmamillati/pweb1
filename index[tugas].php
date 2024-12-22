<?php
$file = 'data_alumni.txt';
$data = [];

// Memeriksa apakah file ada dan dapat dibaca
if (file_exists($file)) {
    // Membaca file dan mengabaikan baris kosong
    $data = file($file, FILE_IGNORE_NEW_LINES);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracer Alumni</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 30px;
            font-weight: bold;
            text-transform: uppercase;
        }

        main {
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            max-width: 800px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 24px;
            color: #007bff;
            margin-bottom: 10px;
        }

        form {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 10px;
            margin-bottom: 20px;
        }

        label {
            font-size: 16px;
            color: #333;
            padding-top: 10px;
            font-weight: bold;
        }

        input {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
            color: #333;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #fafafa;
        }

        tr:hover {
            background-color: #e9ecef;
        }

        .btn-hapus {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-hapus:hover {
            background-color: #c82333;
        }

        .no-data {
            text-align: center;
            color: #666;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            form {
                grid-template-columns: 1fr;
            }

            table {
                font-size: 14px;
            }

            button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <header>
        Tracer Alumni
    </header>

    <main>
        <h2>Input Data Alumni</h2>
        <form action="proses.php" method="POST">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="tahun_lulus">Tahun Lulus:</label>
            <input type="number" id="tahun_lulus" name="tahun_lulus" required>

            <label for="pekerjaan">Pekerjaan:</label>
            <input type="text" id="pekerjaan" name="pekerjaan" required>

            <button type="submit">Simpan Data</button>
        </form>

        <h2>Data Alumni</h2>
        <table>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tahun Lulus</th>
                <th>Pekerjaan</th>
                <th>Aksi</th>
            </tr>
            <?php
            // Memeriksa jika data ada dan tidak kosong
            if (!empty($data)) {
                $no = 1;
                foreach ($data as $index => $row) {
                    // Memeriksa apakah data pada baris dapat diproses dengan benar
                    if (!empty($row)) {
                        list($nama, $tahun_lulus, $pekerjaan) = explode('|', $row);
                        echo "<tr>
                                <td>{$no}</td>
                                <td>{$nama}</td>
                                <td>{$tahun_lulus}</td>
                                <td>{$pekerjaan}</td>
                                <td>
                                    <form action='hapus.php' method='POST'>
                                        <input type='hidden' name='index' value='{$index}'>
                                        <button type='submit' class='btn-hapus'>Hapus</button>
                                    </form>
                                </td>
                              </tr>";
                        $no++;
                    }
                }
            } else {
                echo "<tr><td colspan='5' class='no-data'>Belum ada data.</td></tr>";
            }
            ?>
        </table>
    </main>
</body>
</html>