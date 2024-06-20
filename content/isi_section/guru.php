<?php include 'action/guru/fetchData.php'; ?>

<!-- Team -->
<section class="page-section bg-light" id="team">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Pengajar</h2>
            <h3 class="section-subheading text-muted">Guru yang sudah bersertifikasi</h3>
        </div>
        <div class="row">
            <?php foreach ($guru as $teacher): ?>
            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="team-member">
                    <img class="mx-auto rounded-circle" src="assets/img/guru/<?php echo htmlspecialchars($teacher['foto']); ?>" alt="<?php echo htmlspecialchars($teacher['nama']); ?>" />
                    <h4><?php echo htmlspecialchars($teacher['nama']); ?></h4>
                    <p class="text-muted"><?php echo htmlspecialchars($teacher['jabatan']); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <p class="large text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
            </div>
        </div>
    </div>
</section>
