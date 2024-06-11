<!-- Portfolio Grid-->
<section class="page-section bg-light" id="portfolio">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Galeri</h2>
            <h3 class="section-subheading text-muted">Dokumentasi kegiatan belajar sehari-hari</h3>
        </div>
        <div class="row">
            <?php foreach ($galeri as $item): ?>
            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="portfolio-item">
                    <a class="portfolio-link" data-bs-toggle="modal">
                        <div class="portfolio-img-wrapper">
                            <img class="img-fluid equal-img" src="assets/img/gallery/<?php echo htmlspecialchars($item['gambar']); ?>" alt="<?php echo htmlspecialchars($item['kegiatan']); ?>" />
                        </div>
                    </a>
                    <div class="portfolio-caption">
                        <div class="portfolio-caption-heading"><?php echo htmlspecialchars($item['kegiatan']); ?></div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
    /* CSS untuk gambar dengan ukuran yang sama */
    .portfolio-img-wrapper {
        height: 200px; /* Atur tinggi gambar sesuai kebutuhan */
        overflow: hidden; /* Pastikan gambar tidak keluar dari parent */
    }

    .equal-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
