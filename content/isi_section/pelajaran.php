<?php include 'action/pelajaran/fetchData.php'; ?>

<style>
.timeline-image {
    width: 100px; /* Sesuaikan dengan ukuran diameter lingkaran */
    height: 100px; /* Sesuaikan dengan ukuran diameter lingkaran */
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%; /* Agar lingkaran */
    border: 2px solid #fff; /* Optional: jika ingin ada border putih */
    box-shadow: 0 0 0 2px #fff; /* Optional: shadow untuk memberi efek terang */
    background-color: #f8f9fa; /* Optional: background warna abu-abu untuk background dalam lingkaran */
    background-size: cover; /* Agar gambar background menutupi sepenuhnya */
    background-position: center; /* Agar gambar background tetap di tengah */
}

</style>
<!-- About-->
<section class="page-section" id="about">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Pelajaran</h2>
            <h3 class="section-subheading text-muted">Alur pembelajaran dari pembukaan hingga doa penutup</h3>
        </div>
        <ul class="timeline">
            <?php foreach ($pelajaran as $index => $lesson): ?>
            <li class="<?php echo $index % 2 === 1 ? 'timeline-inverted' : ''; ?>">
            <div class="timeline-image" style="background-image: url('assets/img/alur/<?php echo htmlspecialchars($lesson['gambar']); ?>');"></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4><?php echo htmlspecialchars($lesson['judul']); ?></h4>
                        <!-- <h4 class="subheading"><?php echo htmlspecialchars($lesson['judul']); ?></h4> -->
                    </div>
                    <div class="timeline-body">
                        <p class="text-muted"><?php echo htmlspecialchars($lesson['ket']); ?></p>
                    </div>
                </div>
            </li>
            <?php endforeach; ?>
            <li class="timeline-inverted">
            <div class="timeline-image">
                <h4 style="margin-top: 10px;">
                    Come
                    <br />
                    Join Us
                    <br />
                    Together
                </h4>
            </div>
            </li>
        </ul>
    </div>
</section>
