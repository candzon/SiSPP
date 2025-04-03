# Simawom

## Pendahuluan

Simawom adalah proyek yang memerlukan beberapa langkah instalasi dan konfigurasi agar dapat berjalan di lingkungan lokal Anda. Dokumen ini akan memandu Anda melalui proses tersebut.

## Persyaratan Sistem

* Laravel 11
* MySQL 8.0.30
* PHP 8.2.27

## Instalasi

1.  **Clone Repository:**
    Clone repositori GitHub menggunakan perintah berikut:

    ```bash
    git clone https://github.com/candzon/Simawom.git
    ```

2.  **Konfigurasi .env:**
    Konfigurasikan file `.env` untuk terhubung ke database `simawom_db`. Anda dapat melihat contoh konfigurasi di file `.env.example`.

3.  **Jalankan Laragon:**
    Jalankan Laragon dan arahkan ke direktori proyek Simawom:

    ```bash
    cd Simawom
    ```

4.  **Instal Dependensi Composer:**
    Instal semua dependensi yang diperlukan menggunakan Composer:

    ```bash
    composer install
    ```

5.  **Perbarui Dependensi Composer:**
    Perbarui dependensi Composer ke versi terbaru:

    ```bash
    composer update
    ```

6.  **Instal Laravel DOMPDF:**
    Instal paket Laravel DOMPDF untuk menghasilkan file PDF:

    ```bash
    composer require barryvdh/laravel-dompdf
    ```

## Catatan Tambahan

* Database `simawom_db` tersedia di dalam folder Simawom dengan nama `simawom_db_final`.

## Akses Login

Berikut adalah informasi login untuk berbagai peran:

* **Manager:**
    * Email: `manager@gmail.com`
    * Password: `12345678`
* **Operator:**
    * Email: `jayadi@gmail.com`
    * Password: `12345678`
* **Operator:**
    * Email: `fahri@gmail.com`
    * Password: `12345678`

## Screenshot UI

Berikut adalah beberapa screenshot UI dari aplikasi Simawom:

### Login Page

<img alt="Login Page" src="https://github.com/candzon/Simawom/blob/main/public/image/login.png?raw=true" width="50%">

### Dashboard Page

<img alt="Dashboard Page" src="https://github.com/candzon/Simawom/blob/main/public/image/dashboard.png?raw=true" width="50%">

### Manajemen WorkOrder Page

<img alt="Manajemen WorkOrder Page" src="https://github.com/candzon/Simawom/blob/main/public/image/manajemen-wo.png?raw=true" width="50%">

## Selamat Menggunakan Simawom!

Jika Anda memiliki pertanyaan atau memerlukan bantuan lebih lanjut, jangan ragu untuk menghubungi kami.
