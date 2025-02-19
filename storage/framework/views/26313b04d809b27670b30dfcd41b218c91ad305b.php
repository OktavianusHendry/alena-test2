
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
                                    <h2 style="font-size: 2.0em;"><b>Tambah Divisi Baru</b></h2>
                                </div>

                                <?php if($errors->any()): ?>
                                    <div class="alert alert-danger">
                                        <ul>
                                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><?php echo e($error); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <form action="<?php echo e(route('divisi.store')); ?>" method="POST" enctype="multipart/form-data">
                                    <?php echo e(csrf_field()); ?>


                                    <hr>

                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="nama_divisi">Nama Divisi</label>
                                            <input type="text" name="nama_divisi" id="nama_divisi"
                                                placeholder="Masukkan Nama Divisi" class="form-control"
                                                value="<?php echo e(old('nama_divisi')); ?>" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label" for="kode_divisi">Kode Divisi</label>
                                            <input type="text" name="kode_divisi" id="kode_divisi"
                                                placeholder="Masukkan Kode Divisi" class="form-control"
                                                value="<?php echo e(old('kode_divisi')); ?>" required>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="<?php echo e(route('divisi.index')); ?>" class="btn btn-secondary">Kembali</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </body>

    </html>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\manajemen-kantor\resources\views/divisi/create.blade.php ENDPATH**/ ?>