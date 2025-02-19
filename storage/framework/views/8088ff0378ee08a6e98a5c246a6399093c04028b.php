

<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 style="font-size: 2.0em;"><b>Tambah Pembelajaran Baru</b></h2>
                    </div>
                    <hr />
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('arsip_pembelajaran.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label class="form-label" for="judul_pembelajaran">Judul Pembelajaran</label>
                                <input type="text" name="judul_pembelajaran" class="form-control" required>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label class="form-label" for="id_jenjang">Jenjang</label>
                                    <select name="id_jenjang" id="id_jenjang" class="form-control" required>
                                        <option value="">--Pilih jenjang--</option>
                                        <?php $__currentLoopData = $jenjang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($d->id_jenjang); ?>"><?php echo e($d->nama_jenjang); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="col-sm-4">
                                    <label class="form-label" for="kelas">Kelas</label>
                                    <input type="text" name="kelas" class="form-control" required>
                                </div>

                                <div class="col-sm-4">
                                    <label class="form-label" for="pertemuan_ke">Pertemuan Ke-</label>
                                    <input type="text" name="pertemuan_ke" class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label" for="id_kategori">Kategori</label>
                                    <select name="id_kategori" id="id_kategori" class="form-control" required>
                                        <option value="">--Pilih Kategori--</option>
                                        <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($k->id_kategori); ?>"><?php echo e($k->nama_kategori); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label" for="id_sub_kategori">Sub Kategori</label>
                                    <select name="id_sub_kategori" id="id_sub_kategori" class="form-control" required>
                                        <option value="">--Pilih Sub Kategori--</option>
                                        <?php $__currentLoopData = $subkategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($s->id_sub_kategori); ?>"><?php echo e($s->nama_sub_kategori); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Bagian Input File -->
                            <div id="file-input-container" class="form-group mb-3">
                                <label class="form-label" for="file_satu">File Pembelajaran 1 (ZIP, RAR, PDF, DOCX, DOC,
                                    SB3 | max: 30MB)</label>
                                <input class="form-control" type="file" name="file_satu" id="file_satu" />
                            </div>
                            <button type="button" id="addFileBtn" class="btn btn-primary">
                                <i class="menu-icon tf-icons bx bxs-plus-circle"></i> Tambah File
                            </button>

                            <div class="form-group mb-3 mt-3">
                                <label class="form-label" for="catatan">Catatan</label>
                                <input type="text" name="catatan" class="form-control" required>
                            </div>

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary">Tambah Pembelajaran</button>
                                <a href="<?php echo e(route('arsip_pembelajaran.index')); ?>" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk Menambahkan Input File -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let fileInputContainer = document.getElementById('file-input-container');
            let addFileBtn = document.getElementById('addFileBtn');
            let fileCount = 1;

            addFileBtn.addEventListener('click', function() {
                fileCount++;
                if (fileCount <= 5) { // Batasi maksimal 5 file
                    let newFileInput = document.createElement('div');
                    newFileInput.classList.add('form-group', 'mb-3');
                    newFileInput.innerHTML = `
                        <label class="form-label" for="file_${fileCount}">File Pembelajaran ${fileCount} (ZIP, RAR, PDF, DOCX, DOC, PPT, SB3, XLSX | max: 30MB)</label>
                        <input class="form-control" type="file" name="file_${fileCount}" id="file_${fileCount}" />
                    `;
                    fileInputContainer.appendChild(newFileInput);

                    if (fileCount === 5) {
                        addFileBtn.style.display = 'none'; // Sembunyikan tombol jika mencapai 5 file
                    }
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(Auth::user()->role_as == '0' ? 'layoutsss.template' : 'layoutss.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\manajemen-kantor\resources\views/arsip_pembelajaran/create.blade.php ENDPATH**/ ?>