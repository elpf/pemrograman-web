<?php
function cetakBilangan($n) {
    for ($i = 1; $i <= $n; $i++) {
        if ($i % 4 == 0 && $i % 6 == 0) {
            echo "Pemrograman Website 2024\n";
        } elseif ($i % 5 == 0) {
            echo "2024\n";
        } elseif ($i % 4 == 0) {
            echo "Pemrograman\n";
        } elseif ($i % 6 == 0) {
            echo "Website\n";
        } else {
            echo $i . "\n";
        }
    }
}

while (true) {
    // Meminta input dari user
    $input = readline("Masukkan bilangan positif (atau ketik 'keluar' untuk berhenti): ");
    
    // Periksa apakah pengguna ingin keluar
    if (strtolower(trim($input)) === "keluar") {
        echo "Program dihentikan.\n";
        break;
    }

    // Memastikan input adalah bilangan bulat positif
    if (is_numeric($input) && $input > 0 && intval($input) == $input) {
        cetakBilangan(intval($input));
    } else {
        echo "Masukkan bilangan bulat positif yang valid.\n";
    }
}
?>
