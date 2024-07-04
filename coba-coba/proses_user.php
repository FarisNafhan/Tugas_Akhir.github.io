<?php
include 'koneksi.php';

// Proses Tambah

if (isset($_POST['simpan'])) {
    // Ambil data dari form
    $level = $_POST['level'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mendapatkan id_role berdasarkan level
    $query_role = mysqli_query($konek, "SELECT id_role FROM tb_role WHERE level = '$level'");
    
    // Periksa apakah query berhasil dijalankan
    if ($query_role) {
        // Ambil id_role dari hasil kueri
        $result = mysqli_fetch_assoc($query_role);
        $id_role = $result['id_role'];
        
        // Sisipkan data ke dalam tabel tb_user
        $ganti = mysqli_query($konek, "INSERT INTO tb_user (id_role, nama, username, password) VALUES ('$id_role', '$nama', '$username', '$password')");
        
        if ($ganti) {
            echo "
            <script>
            alert('Data user berhasil ditambah');
            window.location.href='user.php';
            </script>";
        } else {
            echo "
            <script>
            alert('Gagal menambahkan data user');
            window.location.href='user.php';
            </script>";
        }
    } else {
        echo "
        <script>
        alert('Gagal mendapatkan id_role');
        window.location.href='user.php';
        </script>";
    }
}
?>

<?php
// Proses Edit

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data pengguna dari database berdasarkan ID
    $query = mysqli_query($konek, "SELECT * FROM tb_user WHERE id_user = $id");

    // Periksa apakah pengguna ditemukan
    if (mysqli_num_rows($query) > 0) {
        $user = mysqli_fetch_assoc($query);

        // Bentuk array asosiatif untuk dikirim sebagai respons JSON
        $response = array(
            'id_user' => $user['id_user'],
            'level' => $user['level'],
            'nama' => $user['nama'],
            'username' => $user['username']
        );

        // Mengembalikan data pengguna sebagai JSON
        echo json_encode($response);
    } else {
        // Jika pengguna tidak ditemukan, kirimkan pesan kesalahan
        http_response_code(404);
        echo json_encode(array('message' => 'Pengguna tidak ditemukan.'));
    }
} else {
    // Jika ID pengguna tidak disediakan, kirimkan pesan kesalahan
    http_response_code(400);
    echo json_encode(array('message' => 'ID pengguna tidak diberikan.'));
}
?>


<!-- Bagian loop while untuk membuat modal edit -->
<?php
$edit = mysqli_query($konek, "SELECT * FROM tb_user");
$count = 1; // Gunakan variabel ini untuk menghasilkan ID unik untuk setiap modal
while ($user = mysqli_fetch_array($edit)) {
?>

    <div class="modal fade" id="modalEdit<?php echo $count; ?>" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
        <!-- Isi modal edit di sini -->
    </div>

<?php
    $count++; // Tingkatkan nilai count agar mendapatkan ID modal yang unik
}
?>

<!-- Bagian loop while untuk menambahkan tombol Edit -->
<?php
$user = mysqli_query($konek, "SELECT tb_user.*, tb_role.level FROM tb_user INNER JOIN tb_role ON tb_role.id_role = tb_user.id_role");
while ($data = mysqli_fetch_array($user)) {
?>
    <button type="button" class="btn btn-sm btn-info" onclick="fillEditModal(<?php echo $data['id_user']; ?>, <?php echo $data['id_user']; ?>)">Edit</button>
<?php } ?>

<!-- JavaScript untuk mengisi modal edit -->
<script>
    function fillEditModal(id, modalId) {
        // Mengambil data pengguna dari server menggunakan AJAX
        $.ajax({
            url: 'proses_user.php', // Ganti dengan URL yang sesuai untuk mengambil data pengguna dari server
            method: 'GET',
            data: {
                id: id
            }, // Kirim ID pengguna ke server
            dataType: 'json', // Mengharapkan data JSON dari server
            success: function(response) {
                // Mengisi nilai-nilai input dalam modal edit dengan data yang diterima dari server
                $('#modalEdit' + modalId + ' #level').val(response.level);
                $('#modalEdit' + modalId + ' #nama').val(response.nama);
                $('#modalEdit' + modalId + ' #username').val(response.username);

                // Tampilkan modal edit
                $('#modalEdit' + modalId).modal('show');
            },
            error: function(xhr, status, error) {
                // Tampilkan pesan kesalahan jika terjadi masalah saat mengambil data
                console.error(xhr.responseText);
            }
        });
    }
</script>

