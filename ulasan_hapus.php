<?php
$id = $_GET['id'];
$query =  mysqli_query($koneksi, "DELETE FROM ulasan where id_ulasan = $id");
?>

<script>
location.href = "index.php?page=ulasan";
</script>