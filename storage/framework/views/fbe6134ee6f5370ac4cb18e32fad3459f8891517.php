

<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-13 mb-4">
                <div class="card" style="background: url('assets/img/illustrations/Header.png') center/cover no-repeat;">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h3 class="card-title text-primary"><b>Halo, Selamat Datang! &#128516; &#10024;</b></h3>
                                <p class="mb-4">
                                    Anda telah menjadi, <span class="fw-bold">Mentor</span>
                                    <br>sekarang anda memiliki izin
                                    <br>untuk mengakses module pembelajaran
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140"
                                    alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>

                <?php if(session('notification')): ?>
                    <div class="alert alert-info">
                        <?php echo e(session('notification')); ?>

                    </div>
                <?php endif; ?>

                <pre></pre>
                <pre></pre>

                <!-- Form untuk pencarian dan filter -->
                <form method="GET" action="<?php echo e(route('user.dashboard')); ?>" class="mb-4">
                    <div class="row">
                        <!-- Dropdown filter berdasarkan id_jenjang -->
                        <div class="col-md-2 mb-3 mr-1">
                            <select name="id_jenjang" class="form-select" onchange="this.form.submit()">
                                <option value="">-- Pilih Jenjang --</option>
                                <?php $__currentLoopData = $jenjangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenjang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($jenjang->id_jenjang); ?>"
                                        <?php echo e(request('id_jenjang') == $jenjang->id_jenjang ? 'selected' : ''); ?>>
                                        <?php echo e($jenjang->nama_jenjang); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="col-md-2 mb-3 mr-1">
                            <select name="id_kategori" class="form-select" onchange="this.form.submit()">
                                <option value="">-- Pilih Kategori --</option>
                                <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($kategori->id_kategori); ?>"
                                        <?php echo e(request('id_kategori') == $kategori->id_kategori ? 'selected' : ''); ?>>
                                        <?php echo e($kategori->nama_kategori); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="col-md-2 mb-3 mr-1">
                            <select name="id_sub_kategori" class="form-select" onchange="this.form.submit()">
                                <option value="">-- Pilih Sub Kategori --</option>
                                <?php $__currentLoopData = $sub_kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($sub_kategori->id_sub_kategori); ?>"
                                        <?php echo e(request('id_sub_kategori') == $sub_kategori->id_sub_kategori ? 'selected' : ''); ?>>
                                        <?php echo e($sub_kategori->nama_sub_kategori); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <!-- Kolom pencarian -->
                        <div class="col-md-6 mb-3">
                            <div class="form-group d-flex">
                                <input type="text" name="search" value="<?php echo e(request()->input('search')); ?>"
                                    class="form-control" placeholder="Cari berdasarkan judul dan pertemuan ke berapa ...">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </div>

                    </div>
                </form>

                <!-- Tampilkan arsip pembelajaran dalam card -->
                <div class="row mb-5">
                    <?php $__currentLoopData = $arsips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arsip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-5 col-lg-3 mb-4 ms-0">
                            <div class="card h-100 arsip_pembelajaran-card"
                                data-arsip_pembelajaran-id="<?php echo e($arsip->id_arsip_pembelajaran); ?>">
                                <!-- Canvas untuk menampilkan cover PDF -->
                                <canvas id="pdf-canvas-<?php echo e($arsip->id_arsip_pembelajaran); ?>" class="mb-3" width="300"
                                    height="200"></canvas>

                                <div class="card-body d-flex flex-column justify-content-between">
                                    <h5 class="card-title text-primary"><?php echo e($arsip->judul_pembelajaran); ?></h5>
                                    <p class="card-text"><?php echo e($arsip->catatan); ?></p>
                                    <div class="mt-auto">
                                        <a href="<?php echo e(route('arsip_pembelajaran.show', $arsip->id_arsip_pembelajaran)); ?>"
                                            class="btn rounded-pill btn-primary mb-2 col-12">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- JavaScript untuk merender cover PDF -->
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const pdfUrl = "<?php echo e(asset('storage/' . $arsip->file_satu)); ?>"; // Pastikan path PDF sudah benar
                                const canvasId = "pdf-canvas-<?php echo e($arsip->id_arsip_pembelajaran); ?>";
                                const canvas = document.getElementById(canvasId);
                                const ctx = canvas.getContext('2d');

                                // Memuat file PDF
                                pdfjsLib.getDocument(pdfUrl).promise.then(function(pdf) {
                                    // Mengambil halaman pertama
                                    pdf.getPage(1).then(function(page) {
                                        const viewport = page.getViewport({
                                            scale: 1.0
                                        });
                                        canvas.height = viewport.height;
                                        canvas.width = viewport.width;

                                        const renderContext = {
                                            canvasContext: ctx,
                                            viewport: viewport
                                        };

                                        // Render halaman pertama PDF ke canvas
                                        page.render(renderContext);
                                    });
                                });
                            });
                        </script>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    <?php echo e($arsips->withQueryString()->links()); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layoutsss.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Aplikasi_Manajemen_Kantor_v.1.4\resources\views/user/dashboard.blade.php ENDPATH**/ ?>