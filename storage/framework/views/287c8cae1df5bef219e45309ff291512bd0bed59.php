

<?php $__env->startSection('content'); ?>
    <!DOCTYPE html>
    <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo e(config('app.name', 'Laravel')); ?></title>
            <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
        </head>

        <body>
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    <div class="col-xl">
                        <div class="col-xl">
                            <div class="card mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h2 style="font-size: 2.0em;"><b>Tambah Surat Masuk</b></h2>
                                </div>
                                <hr>

                                <?php if($errors->any()): ?>
                                    <div class="alert alert-danger">
                                        <ul>
                                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><?php echo e($error); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>


                                <form action="<?php echo e(route('surat_masuk.store')); ?>" method="POST"
                                    enctype="multipart/form-data">
                                    <?php echo e(csrf_field()); ?>


                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-icon-default-fullname"
                                                for="tgl_surat_keluar">Tanggal Surat Masuk</label>
                                            <input type="date" name="tgl_surat_masuk" class="form-control" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label" for="id_instansi">Asal Surat</label>
                                            <select name="id_instansi" id="id_instansi" class="form-control">
                                                <option value="">--Pilih Instansi--</option>
                                                <?php $__currentLoopData = $instansi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($d->id_instansi); ?>"><?php echo e($d->nama_instansi); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label" for="basic-icon-default-fullname"
                                                for="sifatSurat">Sifat
                                                Surat</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <div class="form-check">
                                                <input name="sifat_surat" class="form-check-input" type="radio"
                                                    value="Formal" id="sifatSuratFormal" />
                                                <label class="form-label" for="basic-icon-default-fullname"
                                                    class="form-check-label" for="sifatSuratFormal">Formal</label>
                                            </div>
                                            <div class="form-check">
                                                <input name="sifat_surat" class="form-check-input" type="radio"
                                                    value="Bisnis" id="sifatSuratBisnis" />
                                                <label class="form-label" for="basic-icon-default-fullname"
                                                    class="form-check-label" for="sifatSuratBisnis">Bisnis</label>
                                            </div>
                                            <div class="form-check">
                                                <input name="sifat_surat" class="form-check-input" type="radio"
                                                    value="Resmi" id="sifatSuratResmi" />
                                                <label class="form-label" for="basic-icon-default-fullname"
                                                    class="form-check-label" for="sifatSuratResmi">Resmi</label>
                                            </div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label" for="basic-icon-default-fullname"
                                                for="perihal">Perihal</label>
                                            <input type="text" name="perihal" class="form-control" maxlength="100"
                                                required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label" for="basic-icon-default-fullname"
                                                for="tindak_lanjut">Tindak Lanjut</label>
                                            <input type="text" name="tindak_lanjut" class="form-control" maxlength="50"
                                                required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label" for="basic-icon-default-fullname"
                                                for="file_surat">File Dokumen (PDF, PPTX, DOC, DOCX, ZIP, RAR | max:
                                                10MB)</label>
                                            <input class="form-control" type="file" name="file_surat" id="file_surat" />
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label" for="basic-icon-default-fullname"
                                                for="catatan">Catatan</label>
                                            <input type="text" name="catatan" class="form-control" maxlength="100"
                                                required>
                                        </div>


                                        <div class="form-group mt-4">
                                            <button type="submit" class="btn btn-primary">Tambah Surat Masuk</button>
                                            <a href="<?php echo e(route('surat_masuk.index')); ?>"
                                                class="btn btn-secondary">Kembali</a>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
        </body>

    </html>

<?php $__env->stopSection(); ?>

<?php echo $__env->make(Auth::user()->role_as == '1' ? 'layouts.template' : 'layoutss.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\manajemen-kantor\resources\views/surat_masuk/create.blade.php ENDPATH**/ ?>