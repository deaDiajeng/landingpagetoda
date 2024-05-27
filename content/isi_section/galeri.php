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
                                        <img class="img-fluid" src="assets/img/portfolio/<?php echo htmlspecialchars($item['gambar']); ?>" alt="..." />
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
