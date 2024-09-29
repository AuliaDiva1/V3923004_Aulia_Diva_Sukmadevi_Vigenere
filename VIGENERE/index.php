<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vigenere Cipher</title>
    <link rel="stylesheet" href="index.css">  
    <style>
        /* Gaya untuk salam cinta */
        .salutation {
            text-align: center;
            color: #D8BFD8; /* Warna pink nude */
            font-size: 20px; /* Ukuran font */
            margin-top: 20px; /* Jarak atas */
            font-weight: bold; /* Menebalkan teks */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4><b>VIGENERE CIPHER</b></h4>
            </div>
            <div class="card-body">
                <?php
                // Fungsi untuk mengenkripsi atau mendekripsi satu karakter menggunakan cipher Vigenere
                function vigenere_cipher($char, $key_char, $encrypt = true)
                {
                    $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; // Alfabet yang digunakan
                    $char = strtoupper($char); // Mengubah karakter menjadi huruf kapital
                    $key_char = strtoupper($key_char); // Mengubah karakter kunci menjadi huruf kapital
                    
                    if (ctype_alpha($char)) { // Cek jika karakter adalah huruf
                        $char_pos = strpos($alphabet, $char); // Posisi karakter dalam alfabet
                        $key_pos = strpos($alphabet, $key_char); // Posisi karakter kunci dalam alfabet
                        
                        if ($encrypt) {
                            // Enkripsi: geser karakter berdasarkan posisi kunci
                            $new_pos = ($char_pos + $key_pos) % 26; // Menghitung posisi baru untuk enkripsi
                        } else {
                            // Dekripsi: balik geseran berdasarkan posisi kunci
                            $new_pos = ($char_pos - $key_pos + 26) % 26; // Menghitung posisi baru untuk dekripsi
                        }

                        return $alphabet[$new_pos]; // Mengembalikan karakter baru
                    } else {
                        return $char; // Mengembalikan karakter non-huruf apa adanya
                    }
                }

                // Fungsi untuk mengenkripsi teks menggunakan cipher Vigenere
                function vigenere_encrypt($input, $key)
                {
                    $output = ""; // Inisialisasi output
                    $key_len = strlen($key); // Panjang kunci
                    $input = strtoupper($input); // Mengubah input menjadi huruf kapital
                    $key = strtoupper($key); // Mengubah kunci menjadi huruf kapital
                    
                    $key_index = 0; // Indeks untuk karakter kunci
                    
                    // Iterasi setiap karakter dalam input
                    foreach (str_split($input) as $char) {
                        if (ctype_alpha($char)) { // Cek jika karakter adalah huruf
                            $output .= vigenere_cipher($char, $key[$key_index % $key_len]); // Enkripsi karakter
                            $key_index++; // Naikkan indeks kunci
                        } else {
                            $output .= $char; // Jika bukan huruf, tambahkan karakter apa adanya
                        }
                    }
                    return $output; // Kembalikan hasil enkripsi
                }

                // Fungsi untuk mendekripsi teks menggunakan cipher Vigenere
                function vigenere_decrypt($input, $key)
                {
                    $output = ""; // Inisialisasi output
                    $key_len = strlen($key); // Panjang kunci
                    $input = strtoupper($input); // Mengubah input menjadi huruf kapital
                    $key = strtoupper($key); // Mengubah kunci menjadi huruf kapital
                    
                    $key_index = 0; // Indeks untuk karakter kunci

                    // Iterasi setiap karakter dalam input
                    foreach (str_split($input) as $char) {
                        if (ctype_alpha($char)) { // Cek jika karakter adalah huruf
                            $output .= vigenere_cipher($char, $key[$key_index % $key_len], false); // Dekripsi karakter
                            $key_index++; // Naikkan indeks kunci
                        } else {
                            $output .= $char; // Jika bukan huruf, tambahkan karakter apa adanya
                        }
                    }
                    return $output; // Kembalikan hasil dekripsi
                }

                // Cek apakah pengguna mengirimkan form untuk enkripsi atau dekripsi
                if (isset($_POST['enkripsi'])) {
                    // Jika tombol enkripsi ditekan, panggil fungsi enkripsi
                    $hasil = vigenere_encrypt($_POST['plain'], $_POST['key']);
                } else if (isset($_POST['dekripsi'])) {
                    // Jika tombol dekripsi ditekan, panggil fungsi dekripsi
                    $hasil = vigenere_decrypt($_POST['plain'], $_POST['key']);
                }
                ?>

                <!-- Form input untuk Vigenere Cipher -->
                <form name="vigenere" method="post">
                    <div class="input-group">
                        <input type="text" name="plain" class="form-control" placeholder="Input Text" value="<?php echo isset($_POST['plain']) ? $_POST['plain'] : ''; ?>" required>
                    </div>
                    <div class="input-group">
                        <input type="text" name="key" class="form-control" placeholder="Input Key (Word)" value="<?php echo isset($_POST['key']) ? $_POST['key'] : ''; ?>" required>
                    </div>
                    <div class="box-footer">
                        <input class="btn btn-success" type="submit" name="enkripsi" value="Enkripsi">
                        <input class="btn btn-danger" type="submit" name="dekripsi" value="Dekripsi">
                    </div>
                </form>
            </div>
            <!-- Bagian untuk menampilkan hasil enkripsi atau dekripsi -->
            <div class="card-header output">
                <h4><b>HASIL</b></h4>
            </div>
            <div class="card-body result">
                <table>
                    <tr>
                        <td>Output yang dihasilkan:</td>
                        <td><b><?php if (isset($hasil)) { echo $hasil; } ?></b></td>
                    </tr>
                    <tr>
                        <td>Text yang dimasukkan:</td>
                        <td><b><?php if (isset($_POST['plain'])) { echo strtoupper($_POST['plain']); } ?></b></td>
                    </tr>
                    <tr>
                        <td>Key:</td>
                        <td><b><?php if (isset($_POST['key'])) { echo strtoupper($_POST['key']); } ?></b></td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- Menambahkan salam cinta di bawah card -->
        <div class="salutation">
            Salam Cinta Devina ❤️
        </div>
    </div>
</body>
</html>
