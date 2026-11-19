<?php
session_start();

// P7: Memproses data formulir dan menyimpannya ke dalam session.
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST["kirim_seminar"])) {
    $nama = trim((string) ($_POST["nama"] ?? ""));
	$email = trim((string) ($_POST["email"] ?? ""));
	$semesterForm = trim((string) ($_POST["semester"] ?? ""));
	$tanggal = trim((string) ($_POST["tanggal"] ?? ""));
	$jenisPesan = trim((string) ($_POST["jenis_pesan"] ?? ""));
	$minat = $_POST["minat"] ?? [];
	$prodi = trim((string) ($_POST["prodi"] ?? ""));
	$pesan = trim((string) ($_POST["pesan"] ?? ""));

	// Checkbox dapat mengirimkan lebih dari satu nilai.
	if (!is_array($minat)) {
		$minat = [];
	}

	// Menyimpan setiap nilai formulir ke dalam session secara terpisah.
	$_SESSION["nama"] = $nama;
	$_SESSION["email"] = $email;
	$_SESSION["semester"] = $semesterForm;
	$_SESSION["tanggal"] = $tanggal;
	$_SESSION["jenis_pesan"] = $jenisPesan;
	$_SESSION["minat"] = $minat;
	$_SESSION["prodi"] = $prodi;
	$_SESSION["pesan"] = $pesan;

	// PRG: mencegah pengiriman POST berulang ketika halaman dimuat ulang.
	header("Location: index.php#contact");
	exit;
}
// Pendaftaran Seminar Teknologi - POST + PRG + Session + htmlspecialchars
$seminar_error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["kirim_seminar"])) {
    $nama_peserta = trim((string) ($_POST["nama_peserta"] ?? ""));
    $nim_seminar = trim((string) ($_POST["nim"] ?? ""));
    $prodi_seminar = trim((string) ($_POST["prodi"] ?? ""));
    $pilihan_seminar = trim((string) ($_POST["pilihan_seminar"] ?? ""));
    $alasan_seminar = trim((string) ($_POST["alasan"] ?? ""));

    if ($nama_peserta === "" || $nim_seminar === "" || $prodi_seminar === "" || $pilihan_seminar === "" || $alasan_seminar === "") {
        $seminar_error = "Semua field wajib diisi!";
    } else {
        $_SESSION["seminar_data"] = [
            "nama" => htmlspecialchars($nama_peserta, ENT_QUOTES, "UTF-8"),
            "nim" => htmlspecialchars($nim_seminar, ENT_QUOTES, "UTF-8"),
            "prodi" => htmlspecialchars($prodi_seminar, ENT_QUOTES, "UTF-8"),
            "pilihan" => htmlspecialchars($pilihan_seminar, ENT_QUOTES, "UTF-8"),
            "alasan" => htmlspecialchars($alasan_seminar, ENT_QUOTES, "UTF-8")
        ];
        header("Location: index.php#seminar");
        exit;
    }
}
// Mengamankan data sebelum ditampilkan kembali ke halaman HTML.
// P6: PHP dasar dan pemrograman sisi peladen
// Bagian 1: Variabel dan konstanta
$nim = "2611510017";
$namaMahasiswa = "Muhammad Zakie Ziyadatullah";
$programStudi = "TI";
$tahunAkademik = "2026/2027";
$semester = 1;
$ipk = 3.75;
$statusAktif = true;
$catatanTambahan = null;

const NAMA_MATA_KULIAH = "Pemrograman Web Dasar";
const PROFIL_GITHUB = "ziyadatullahor";

// Bagian 2: Operator
$batasSemester = 8;
$sisaSemester = $batasSemester - $semester;
$semesterValid = $semester >= 1 && $semester <= $batasSemester;
$statusSemester = ($semesterValid && $statusAktif) ? "Sesuai rentang" : "Perlu diperiksa";

// Bagian 3: Percabangan if-elseif-else
if ($semester < 3) {
	$keteranganSemester = "Semester awal";
} elseif ($semester <= 6) {
	$keteranganSemester = "Semester menengah";
} else {
	$keteranganSemester = "Semester akhir";
}

$namaProdi = ($programStudi == "SI") ? "Sistem Informasi" : (($programStudi == "TI") ? "Teknik Informatika" : "Lainnya");

// Bagian 4: Percabangan switch-case-default
switch ($programStudi) {
	case "SI":
		$fokusProgramStudi = "Sistem informasi dan proses bisnis";
		break;
	case "TI":
		$fokusProgramStudi = "Komputasi dan pengembangan perangkat lunak";
		break;
	default:
		$fokusProgramStudi = "Belum ditentukan";
}
?>
<!doctype html>
<html lang="id">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Profil Mahasiswa</title>
	<link rel="stylesheet" href="style.css" />
</head>

<body>
	<header>
		<div class="header-top">
			<h1>Profil Mahasiswa</h1>

			<button
				class="nav-toggle"
				id="navToggle"
				type="button"
				aria-label="Buka navigasi"
				aria-controls="navMenu"
				aria-expanded="false">
				&#9776;
			</button>
		</div>

		<nav>
			<ul id="navMenu">
				<li><a href="#home">Beranda</a></li>
				<li><a href="#about">Tentang</a></li>
								<li><a href="#seminar">Pendaftaran Seminar</a></li>
				<li><a href="#contact">Kontak</a></li>

			</ul>
		</nav>
	</header>
	<main>
		<section id="home">
			<h2>Selamat Datang</h2>
			<p>Halo, saya <strong><?php echo $namaMahasiswa; ?></strong>. Saya sedang mempelajari matakuliah <strong><?php print NAMA_MATA_KULIAH; ?></strong> pada tahun akademik <?php echo $tahunAkademik; ?>.</p>

			<img src="img/foto-profil.jpg" alt="Foto profil Nama Mahasiswa" />
		</section>

		<section id="about">
			<h2>Tentang Saya</h2>

			<article>
				<h3>Profil Singkat</h3>
				<p>Program Studi: <?php echo $namaProdi . " (" . $programStudi . ")"; ?></p>
				<p>Fokus program studi: <?php echo $fokusProgramStudi; ?></p>
				<p>Status mahasiswa: <?php echo $statusAktif ? "Aktif" : "Tidak aktif"; ?></p>
				<p>Semester: <?php echo $semester . " (" . $keteranganSemester . ")"; ?></p>
				<p>Sisa semester hingga batas: <?php echo $sisaSemester; ?></p>
				<p>Pemeriksaan rentang semester: <?php echo $statusSemester; ?></p>
				<p>IPK: <?php echo number_format($ipk, 2, ',', '.'); ?></p>
				<p>Catatan tambahan: <?php echo $catatanTambahan === null ? "Belum ada" : $catatanTambahan; ?></p>

				<h3>Target Belajar (Perulangan for)</h3>
				<ol>
					<?php
					// Perulangan for tanpa array; materi larik dibahas pada P9.
					for ($i = 1; $i <= 5; $i++) {
						echo "<li>Target belajar ke-" . $i . ": ";
						switch ($i) {
							case 1:
								echo "Memahami sintaks dasar PHP.";
								break;
							case 2:
								echo "Menggunakan variabel dan konstanta.";
								break;
							case 3:
								echo "Menerapkan operator dan percabangan.";
								break;
							case 4:
								echo "Menggunakan perulangan for dan while.";
								break;
							default:
								echo "Belum dipetakan";
								break;
						}
						echo "</li>";
					}
					?>
				</ol>

				<h3>Semester (Perulangan while):</h3>
				<ol>
					<?php
					$nomorSemester = 1;
					while ($nomorSemester <= 3) {
						echo "<li>Semester " . $nomorSemester . "</li>";
						$nomorSemester++; // operator penugasan
					}
					?>
				</ol>
			</article>
		</section>

		<section id="contact">
			<h2>Kontak</h2>

			<p>
				Kunjungi
				<a target="_blank" href="https://github.com/<?= PROFIL_GITHUB ?>">profil GitHub saya</a>.
			</p>

			<form id="contactForm" class="js-contact-form" data-validation="contact" action="index.php" method="post" novalidate>
				<div class="form-group">
					<label for="nama">Nama Lengkap</label><br />

					<input
						class="input-form"
						type="text"
						id="nama"
						name="nama"
						placeholder="Masukkan nama lengkap"
						minlength="3"
						maxlength="50"
						required />
				</div>

				<div class="form-group">
					<label for="email">Email</label><br />

					<input class="input-form" type="email" id="email" name="email" placeholder="nama@email.com" required />
				</div>

				<div class="form-group">
					<label for="semester">Semester</label><br />

					<input class="input-form" type="number" id="semester" name="semester" min="1" max="14" required />
				</div>

				<div class="form-group">
					<label for="tanggal">Tanggal Kunjungan</label><br />

					<input class="input-form" type="date" id="tanggal" name="tanggal" required />
				</div>

				<div class="form-group">
					<p>Jenis Pesan</p>

					<input type="radio" id="pertanyaan" name="jenis_pesan" value="pertanyaan" required />
					<label for="pertanyaan">Pertanyaan</label>

					<input type="radio" id="saran" name="jenis_pesan" value="saran" />
					<label for="saran">Saran</label>
				</div>

				<div class="form-group">
					<p>Topik yang Diminati</p>

					<input type="checkbox" id="minat-html" name="minat[]" value="HTML" />
					<label for="minat-html">HTML</label>

					<input type="checkbox" id="minat-css" name="minat[]" value="CSS" />
					<label for="minat-css">CSS</label>
				</div>

				<div class="form-group">
					<label for="prodi">Program Studi</label><br />

					<select class="input-form" id="prodi" name="prodi" required>
						<option value="">-- Pilih Program Studi --</option>
						<option value="SI">Sistem Informasi</option>
						<option value="TI">Teknik Informatika</option>
					</select>
				</div>

				<div class="form-group">
					<label for="pesan">Pesan</label><br />

					<textarea
						class="input-form"
						id="pesan"
						name="pesan"
						maxlength="300"
						placeholder="Tulis pesan Anda"
						required></textarea>
				</div>

				<button type="submit">Kirim</button>
				<button type="reset">Batal</button>
				<p class="form-feedback" data-form-feedback aria-live="polite"></p>
			</form>

			<?php if (isset($_SESSION["nama"])): ?>
				<article id="hasilKontak" class="submission-result" aria-live="polite">
					<h3>Data Formulir yang Dikirim</h3>
					<p><strong>Nama Lengkap:</strong> <?= htmlspecialchars($_SESSION["nama"] ?? "", ENT_QUOTES, "UTF-8") ?></p>
					<p><strong>Email:</strong> <?= htmlspecialchars($_SESSION["email"] ?? "", ENT_QUOTES, "UTF-8") ?></p>
					<p><strong>Semester:</strong> <?= htmlspecialchars($_SESSION["semester"] ?? "", ENT_QUOTES, "UTF-8") ?></p>
					<p><strong>Tanggal Kunjungan:</strong> <?= htmlspecialchars($_SESSION["tanggal"] ?? "", ENT_QUOTES, "UTF-8") ?></p>
					<p><strong>Jenis Pesan:</strong> <?= htmlspecialchars($_SESSION["jenis_pesan"] ?? "", ENT_QUOTES, "UTF-8") ?></p>
					<p><strong>Topik yang Diminati:</strong>
						<?= htmlspecialchars(implode(", ", $_SESSION["minat"] ?? []), ENT_QUOTES, "UTF-8") ?>
					</p>
					<p><strong>Program Studi:</strong> <?= htmlspecialchars($_SESSION["prodi"] ?? "", ENT_QUOTES, "UTF-8") ?></p>
					<p><strong>Pesan:</strong> <?= nl2br(htmlspecialchars($_SESSION["pesan"] ?? "", ENT_QUOTES, "UTF-8")) ?></p>
				</article>
			<?php endif; ?>
		</section>
		<section id="seminar">
        <h2>Pendaftaran Seminar Teknologi</h2>
        <p>Silakan isi form berikut untuk mendaftar seminar.</p>
        <?php if (!empty($_SESSION['seminar_data'])): ?>
    <article>
      <h3>Data Pendaftaran Seminar</h3>
      <p><strong>Nama Peserta:</strong> <?= $_SESSION['seminar_data']['nama'] ?></p>
      <p><strong>NIM:</strong> <?= $_SESSION['seminar_data']['nim'] ?></p>
      <p><strong>Program Studi:</strong> <?= $_SESSION['seminar_data']['prodi'] ?></p>
      <p><strong>Pilihan Seminar:</strong> <?= $_SESSION['seminar_data']['pilihan'] ?></p>
      <p><strong>Alasan Mengikuti Seminar:</strong> <?= $_SESSION['seminar_data']['alasan'] ?></p>
    </article>
    <?php unset($_SESSION['seminar_data']); ?>
  <?php endif; ?>

  <?php if (!empty($seminar_error)): ?>
    <p><?= $seminar_error ?></p>
  <?php endif; ?>

  <form method="post" action="#seminar" onsubmit="return validasiSeminar()">
    <div>
      <label>Nama Peserta</label><br>
      <input type="text" id="nama_peserta" name="nama_peserta" required>
    </div><br>
    <div>
      <label>NIM</label><br>
      <input type="text" id="nim" name="nim" required>
    </div><br>
    <div>
      <label>Program Studi</label><br>
  <select id="prodi_seminar" name="prodi" required>
        <option value="">-- Pilih Program Studi --</option>
        <option value="TI">TI</option>
        <option value="SI">SI</option>
      </select>
    </div><br>
    <div>
      <label>Pilihan Seminar</label><br>
      <select id="pilihan_seminar" name="pilihan_seminar" required>
        <option value="">-- Pilih Seminar --</option>
        <option value="Artificial Intelligence">Artificial Intelligence</option>
        <option value="Web Development">Web Development</option>
        <option value="Cyber Security">Cyber Security</option>
        <option value="Data Analytics">Data Analytics</option>
      </select>
    </div><br>
    <div>
      <label>Alasan Mengikuti Seminar</label><br>
      <textarea id="alasan" name="alasan" rows="4" required></textarea>
    </div><br>
    <button type="submit" name="kirim_seminar">Kirim</button>
    <button type="reset">Batal</button>
  </form>
  <script>function validasiSeminar() {
    const nama = document.getElementById('nama_peserta').value.trim();
    const nim = document.getElementById('nim').value.trim();
   const prodi = document.getElementById('prodi_seminar').value;
    const pilihan = document.getElementById('pilihan_seminar').value;
    const alasan = document.getElementById('alasan').value.trim();
    if (!nama || !nim || !prodi || !pilihan || !alasan) {
      alert('Semua field wajib diisi!');
      return false;
    }
    return true;
  }
  </script>
    </section>
	</main>

	<footer>
		<p>&copy; <?= date("Y") ?> <?php echo $namaMahasiswa; ?> [<?= $nim ?>]</p>
	</footer>
	<script src="script.js"></script>
</body>

</html>