# Belajar cara membuat fungsi CRUD di Wordpress dan berinteraksi dengan databasenya

## Persiapan :

Pada settingan saya, saya menggunakan theme GeneratePress Free

1. Install plugin [simple table maanger](https://github.com/wp-plugins/simple-table-manager) untuk mudah memilih dan mengedit / update data table
2. Install Custom post type UI untuk memudahkan membuat post type selain (post dan page)

## Di PHPMyAdmin

Gunakan PhpMyAdmin untuk memudahkan berinteraksi dengan database wordpress.

> Tulis dalam huruf kapital tipe data table yang akan dibuat

Table yang dibuat bisa berupa apa saja :
- INT
- VARCHAR
- dll 

## Langkah-langkah :

1. Buatlah child theme
2. Gunakan file **function.php** pada repository ini pada child theme anda
3. Sesuaikan isi table yang ingin digunakan dengan form inputan yang ingin dibuat. Pelajari baris per baris kode yang ada di file function.php
4. Buatlah custom post type sesuai keinginan anda untuk menampilkan data
5. Tampilkan data pada website anda

Anda bisa menginput / **create data** dari frontend website

Anda bisa melihat / **read data** dari database lalu ditampilkan di halaman website

Anda **hanya bisa update** data jika masuk sebagai admin.

## Tambahan :

Copy file *single.php* dan *page.php* ke child theme untuk menghilangkan footernya dengan uncomment get_footer.
