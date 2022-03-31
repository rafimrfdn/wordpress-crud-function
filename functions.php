<?php
/**
 * GeneratePress child theme functions and definitions.
 *
 * Add your custom PHP in this file.
 * Only edit this file if you have direct access to it on your server (to fix errors if they happen).
 */


// avoid loading css file of child template 
add_action( 'wp_enqueue_scripts', function() {
    wp_dequeue_style( 'generate-child' );
}, 50 );

// create input form to insert data from frontend. 
// show this from using page, post or custom post type
// just by using single line of shortcode. read below. 
function elh_insert_into_db() {
    global $wpdb;
    // creates 'inputan' table in database if not exists
    $table = $wpdb->prefix . "inputan";
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE IF NOT EXISTS $table (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        nama VARCHAR(100) NOT NULL,
        nik INT(11) NOT NULL,
        keperluan VARCHAR(100) NOT NULL, 
    UNIQUE (id)
    ) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
    // starts output buffering
    ob_start();
    ?>
    <form action="#v_form" method="post" id="v_form">
        <label for="nama"><h3>Silahkan isi data anda</h3></label>
        <input type="text" name="nama" id="nama" placeholder="nama" />
		<input type="text" name="nik" id="nik" placeholder="nik" />
		<input type="text" name="keperluan" id="keperluan" placeholder="keperluan" />
        <input type="submit" name="submit_form" value="submit" />
    </form>
    <?php
    $html = ob_get_clean();
    // does the inserting, in case the form is filled and submitted
    if ( isset( $_POST["submit_form"] ) && $_POST ["nama"]["nik"]["keperluan"]!= "" ) {
        $table = $wpdb->prefix . "inputan";
        $nama = strip_tags($_POST["nama"],"");
        $nik = strip_tags($_POST["nik"],"");
        $keperluan = strip_tags($_POST["keperluan"],"");
        $wpdb->insert(
            $table,
            array(
                'nama' => $nama,
                'nik' => $nik,
                'keperluan' => $keperluan
            )
        );
        $html = "<p>Pemohon atas nama <strong>$nama</strong> sudah terdaftar. Thanks!!</p>";
    }
    // if the form is submitted but the name is empty
    if ( isset( $_POST["submit_form"] ) && $_POST["nama"] == "" )
        $html = "<p>data wajib diisi</p>";
    // outputs everything
    return $html;
     
}
// adds a shortcode you can use: [insert-into-db]
add_shortcode('elh-db-insert', 'elh_insert_into_db');




// create read data to show the database form to the frontend. 
// use shortcode to show them, read below.
function read_the_database() {
    
$db_host = 'localhost'; // Nama Server
$db_user = 'bMA8CxKd8Knjag'; // User Server
$db_pass = '8xxF41gqPj4Jnh'; // Password dari wp-config.php
$db_name = 'bMA8CxKd8Knjag'; // Nama Database

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
	die ('Gagal terhubung MySQL: ' . mysqli_connect_error());	
}

// select tertentu
// $sql = 'SELECT id, nama, nik, keperluan 

// select all
$sql = 'SELECT * 
		FROM wp_inputan';
		
$query = mysqli_query($conn, $sql);

if (!$query) {
	die ('SQL Error: ' . mysqli_error($conn));
}

// create table head
echo '<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Nama</th>
				<th>NIK</th>
				<th>Keperluan</th>
			</tr>
		</thead>
		<tbody>';
		
// create table data
while ($row = mysqli_fetch_assoc($query))
{
	echo '<tr>
			<td>'.$row['id'].'/2022</td>
			<td>'.$row['nama'].'</td>
			<td>'.$row['nik'].'</td>
			<td>'.$row['keperluan'].'</td>
		</tr>';
}
echo '
	</tbody>
</table>';

// Apakah kita perlu menjalankan fungsi mysqli_free_result() ini? baca bagian VII
mysqli_free_result($query);

// Apakah kita perlu menjalankan fungsi mysqli_close() ini? baca bagian VII
mysqli_close($conn);

}
// add shortcode [read-db] anywhere you want to show the data from 'inputan' database.
add_shortcode('read-db','read_the_database');
