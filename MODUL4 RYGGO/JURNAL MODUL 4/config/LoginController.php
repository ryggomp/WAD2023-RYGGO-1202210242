<?php

require 'connect.php';

// function untuk melakukan login
function login($input) {

    // (1) Panggil variabel global $db dari file config
    global $connection;
    // 

    // (2) Ambil nilai input dari form login
        // a. Ambil nilai input email
    $email = $_POST['email'];
        // b. Ambil nilai input password
    $password = $_POST['password'];
    // 

    // (3) Buat dan lakukan query untuk mencari data dengan email yang sama
    $read = "SELECT * FROM users WHERE email = '$email'";
    $query = mysqli_query($connection,$read);
    // 

    // (4) Buatlah perkondisian ketika email ditemukan ( gunakan mysqli_num_rows == 1 )
    if (mysqli_num_rows($query) == 1) {
        
    
        // a. Simpan hasil query menjadi array asosiatif menggunakan fungsi mysqli_fetch_assoc
        $result = mysqli_fetch_assoc($query);
        // 
        // password_verify($password, $result['password'])
        // b. Lakukan verifikasi password menggunakan fungsi password_verify
        if (password_verify($password, $result['password'])) {
            
            
            // c. Set variabel session dengan key login untuk menyimpan status login
            $_SESSION['login'] = true;
            // d. Set variabel session dengan key id untuk menyimpan id user
            $_SESSION['id'] = $result['id'];
        
            //

            // e. Buat kondisi untuk mengecek apakah checkbox "remember me" terisi kemudian set cookie dan isi dengan id
            if (isset($input['remember'])) {
                setcookie('id', $result['id'], time()+3600);
            }
        }
            // 
        // f. Buat kondisi else dan isi dengan variabel session dengan key message untuk meanmpilkan pesan error ketika password tidak sesuai
        else {
            $_SESSION['message'] = 'Login Gagal, Silahkan coba lagi';
            $_SESSION['color'] = 'danger';
        }
    }
        // 
    // 

    // (5) Buat kondisi else, kemudian di dalamnya
    //     Buat variabel session dengan key message untuk menampilkan pesan error ketika email tidak ditemukan
    else {
        $_SESSION['message'] = 'Login Gagal, email tidak terdeteksi';
        $_SESSION['color'] = 'danger';
    }
    // 
}
// 

// function untuk fitur "Remember Me"
function rememberMe($cookie)
{
    // (6) Panggil variabel global $db dari file config
    global $connection;
    // 

    // (7) Ambil nilai cookie yang ada
    $id = $cookie['id'];
    // 

    // (8) Buat dan lakukan query untuk mencari data dengan id yang sama
    $read = "SELECT * FROM users WHERE id = '$id'";
    $query = mysqli_query($connection,$read);
    // 

    // (9) Buatlah perkondisian ketika id ditemukan ( gunakan mysqli_num_rows == 1 )
    if (mysqli_num_rows($query) == 1) {
    
        // a. Simpan hasil query menjadi array asosiatif menggunakan fungsi mysqli_fetch_assoc
        $result = mysqli_fetch_assoc($query);
        // b. Set variabel session dengan key login untuk menyimpan status login
        $_SESSION['login'] = true;
        // c. Set variabel session dengan key id untuk menyimpan id user
        $_SESSION['id'] = $result['id'];
    }
    // 
}
// 

?>