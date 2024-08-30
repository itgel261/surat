<?php
// Start the session as the very first thing
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Include your database connection file
include "koneksi.php";

// Query untuk mendapatkan data user
$sqluser = mysqli_query($connect, "SELECT * FROM user");

// Cek apakah ada data dari hasil query
$a = mysqli_fetch_array($sqluser);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nosurat = mysqli_real_escape_string($connect, $_POST['nosurat']);
    $tanggal = mysqli_real_escape_string($connect, $_POST['tanggal']);
    $tandatangan = mysqli_real_escape_string($connect, $_POST['tandatangan']);
    $perihal = mysqli_real_escape_string($connect, $_POST['perihal']);
    $isisurat = mysqli_real_escape_string($connect, $_POST['isisurat']);
    $hasilsurat = mysqli_real_escape_string($connect, $_POST['hasilsurat']);

    $simpan = mysqli_query($connect, "INSERT INTO datasurat (nosurat, tanggal, tandatangan, perihal, isisurat, hasilsurat)
                VALUES ('$nosurat', '$tanggal', '$tandatangan', '$perihal', '$isisurat', '$hasilsurat')");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/GEL.png" type="image/x-icon"/>
    <title>Penomeran Surat PT.GEL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/docx/7.1.1/docx.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <style>
            /* Existing styles */
            body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #00c6ff, #0072ff);
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
           
            flex-direction: column;
            box-sizing: border-box;
        }
        h1 {
            color: #fff;
            margin-bottom: 30px;
            font-size: 36px;
            text-align: center;
            width: 100%;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }
            label {
                font-size: 18px;
                color: #fff;
                margin-right: 10px;
                display: block;
                margin-bottom: 5px;
            }
            input[type="text"], select, input[type="date"], textarea {
                padding: 10px;
                font-size: 16px;
                border: 2px solid #fff;
                border-radius: 5px;
                width: 100%;
                max-width: 300px;
                margin-bottom: 20px;
                box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
                transition: box-shadow 0.3s ease, border-color 0.3s ease;
                background-color: rgba(255, 255, 255, 0.8);
                color: #333;
            }
            input[type="text"]:focus, select:focus, input[type="date"]:focus, textarea:focus {
                box-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
                border-color: #00c6ff;
                outline: none;
            }
            button {
                padding: 10px 20px;
                font-size: 16px;
                cursor: pointer;
                background-color: #fff;
                color: #0072ff;
                border: none;
                border-radius: 5px;
                box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
                transition: background-color 0.3s ease, transform 0.3s ease, color 0.3s ease;
                margin-top: 20px;
            }
            button:hover {
                background-color: #0072ff;
                color: #fff;
                transform: scale(1.05);
            }
            #nomorSurat {
                font-size: 24px;
                margin-top: 20px;
                color: #27ae60;
                font-weight: bold;
                background-color: #ecf0f1;
                padding: 15px;
                border-radius: 5px;
                box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
                width: fit-content;
                text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
            }
            #history {
                margin-top: 40px;
                width: 100%;
            }
            .history-item {
                font-size: 18px;
                color: #fff;
                margin-bottom: 10px;
                background-color: rgba(255, 255, 255, 0.1);
                padding: 10px;
                border-radius: 5px;
                box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
                transition: transform 0.3s ease;
                text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
            }
            .history-item:hover {
                transform: scale(1.02);
            }
            .form-group {
                margin-bottom: 15px;
            }
            #hasilSurat {
                margin-top: 30px;
                padding: 20px;
                border: 1px solid #ccc;
                background-color: #fff;
                box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
                display: none;
                max-width: 800px;
                border-radius: 10px;
                transition: box-shadow 0.3s ease, transform 0.3s ease;
            }
            #hasilSurat:hover {
                box-shadow: 4px 4px 15px rgba(0, 0, 0, 0.2);
                transform: scale(1.01);
            }
            .surat-header, .surat-footer {
                text-align: center;
                margin-bottom: 20px;
                color: #34495e;
                font-weight: bold;
                text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
            }
            .surat-body {
                text-align: left;
                margin-bottom: 20px;
                color: #34495e;
                line-height: 1.6;
            }
            .logout-button {
                position: absolute;
                top: 20px;
                right: 20px;
                padding: 10px 20px;
                font-size: 16px;
                cursor: pointer;
                background-color: #e74c3c;
                color: #fff;
                border: none;
                border-radius: 5px;
                box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
                transition: background-color 0.3s ease, transform 0.3s ease;
            }
            .logout-button:hover {
                background-color: #c0392b;
                transform: scale(1.05);
            }
        </style>
</head>
<body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">App Surat PT GEL</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo htmlspecialchars($a['divisi']); ?>
                </a>

                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
                </li>
            </ul>
            </div>
        </div>
        </nav>
    
<h1>Nomer Surat PT.GEL</h1>

<form method="POST" action="">
    <button class="logout-button" type="button" onclick="logout()">Logout</button>

    <div class="form-group">
        <?php
            if ($a) {
                $prefix = isset($a['prefix']) ? htmlspecialchars($a['prefix']) : '';
                echo '<input type="hidden" id="prefix" value="' . $prefix . '">';
            } else {
                echo '<input type="hidden" id="prefix" value="">';
            }
        ?>
    </div>

    <div class="form-group">
        <label for="divisi">Divisi: </label>
        <select id="divisi" name="divisi">
            <?php
                mysqli_data_seek($sqluser, 0); // Reset pointer to start
                while ($a = mysqli_fetch_array($sqluser)) {
                    echo '<option value="' . htmlspecialchars($a['divisi']) . '">' . htmlspecialchars($a['divisi']) . '</option>';
                }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="perihal">Perihal: </label>
        <input type="text" name="perihal" id="perihal" placeholder="Masukkan Perihal Surat">
    </div>

    <div class="form-group">
        <label for="tanggal">Tanggal: </label>
        <input name="tanggal" type="date" id="tanggal">
    </div>

    <div class="form-group">
        <label for="tandaTangan">Tanda Tangan: </label>
        <input type="text" name="tandatangan" id="tandaTangan" placeholder="Masukkan Nama Penanda Tangan">
    </div>

    <div class="form-group">
        <label for="manualCounter">Nomor Surat: </label>
        <input type="text" name="manualCounter" id="manualCounter" placeholder="Masukkan Nomor Surat (Opsional)">
    </div>

    <div class="form-group">
        <label for="isiSurat">Isi Surat: </label>
        <textarea name="isisurat" id="isiSurat" rows="5" placeholder="Masukkan isi surat di sini..."></textarea>
    </div>

    <button type="submit" name="Simpan">Simpan</button>
    <button type="button" onclick="generateNomorSurat()">Buat Nomor Surat</button>
</form>

<p id="nomorSurat"></p>

<div id="history">
    <h2>Riwayat Nomor Surat</h2>
    <div id="historyList"></div>
</div>

<div id="hasilSurat">
    <div class="surat-header">
        <h2>PT. GEL</h2>
        <p>Jl. SCBD JAKARTA SELANTAN</p>
    </div>
    <div class="surat-body">
        <p id="hasilNomorSurat"></p>
        <p id="hasilTanggal"></p>
        <p id="hasilPerihal"></p>
        <br><br>
        <p>Dengan hormat,</p>
        <p>IBU/BAPAK DITEMPAT.</p>
        <div id="hasilIsiSurat"></div>
    </div>
    <div class="surat-footer">
        <p id="hasilTandaTangan"></p>
        <p>Penanda Tangan</p>
    </div>
    <button onclick="exportToWord()">Ekspor ke Word</button>
</div>

<script>
function logout() {
    // Redirect to the logout.php page to handle session destruction
    window.location.href = "logout.php";
}
</script>


<script>
    let counter = 0;
    const historyList = document.getElementById('historyList');
    const usedCombinations = [];

    function generateNomorSurat() {
        const prefix = document.getElementById('prefix').value || 'PT.GEL';
        const divisi = document.getElementById('divisi').value;
        const perihal = document.getElementById('perihal').value;
        const tanggal = document.getElementById('tanggal').value;
        const tandaTangan = document.getElementById('tandaTangan').value;
        const isiSurat = document.getElementById('isiSurat').value;
        const manualCounter = document.getElementById('manualCounter').value;

        counter = manualCounter ? parseInt(manualCounter) : ++counter;

        const today = tanggal ? new Date(tanggal) : new Date();
        const year = today.getFullYear();
        const month = today.getMonth() + 1;
        const romanMonths = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        const romanMonth = romanMonths[month - 1];
        const dateStr = `${romanMonth}/${year}`;

        const nomorSurat = `${String(counter).padStart(3, '0')}/${divisi}/${prefix}/${dateStr}`;

        const combination = `${nomorSurat}-${prefix}-${divisi}`;
        if (usedCombinations.includes(combination)) {
            alert('Nomor surat dengan kombinasi tersebut sudah digunakan');
            return;
        }

        usedCombinations.push(combination);

        document.getElementById('nomorSurat').innerText = `Nomor Surat: ${nomorSurat}\nPerihal: ${perihal}\nTanggal: ${tanggal}\nTanda Tangan: ${tandaTangan}`;

        const historyItem = document.createElement('div');
        historyItem.className = 'history-item';
        historyItem.innerText = `Nomor Surat: ${nomorSurat}\nPerihal: ${perihal}\nTanggal: ${tanggal}\nTanda Tangan: ${tandaTangan}`;
        historyList.appendChild(historyItem);

        document.getElementById('hasilNomorSurat').innerText = `Nomor: ${nomorSurat}`;
        document.getElementById('hasilTanggal').innerText = `Tanggal: ${tanggal}`;
        document.getElementById('hasilPerihal').innerText = `Perihal: ${perihal}`;
        document.getElementById('hasilIsiSurat').innerHTML = isiSurat.replace(/\n/g, '<br>');
        document.getElementById('hasilTandaTangan').innerText = tandaTangan;

        document.getElementById('hasilSurat').style.display = 'block';
    }

    function exportToWord() {
        const hasilSurat = document.getElementById('hasilSurat').innerHTML;

        const doc = new docx.Document({
            sections: [{
                properties: {},
                children: [
                    new docx.Paragraph({
                        children: [
                            new docx.TextRun({
                                text: hasilSurat.replace(/<[^>]*>/g, ''), // Remove HTML tags
                                break: 1,
                            }),
                        ],
                    }),
                ],
            }],
        });

        docx.Packer.toBlob(doc).then(blob => {
            saveAs(blob, "surat.docx");
        });
    }
</script>

</body>
</html>