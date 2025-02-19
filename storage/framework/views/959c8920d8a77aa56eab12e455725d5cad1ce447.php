
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
                                    <h2 style="font-size: 2.0em;"><b>Tambah Instansi Baru</b></h2>
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

                                <form action="<?php echo e(route('instansi.store')); ?>" method="POST" enctype="multipart/form-data">
                                    <?php echo e(csrf_field()); ?>


                                    <hr>

                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="nama_instansi">Nama instansi</label>
                                            <input type="text" name="nama_instansi" id="nama_instansi"
                                                placeholder="Masukkan Nama instansi" class="form-control"
                                                value="<?php echo e(old('nama_instansi')); ?>" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label" for="id_tujuan">tujuan</label>
                                            <select name="id_tujuan" id="id_tujuan" class="form-control">
                                                <option value="">-- Pilih tujuan --</option>
                                                <?php $__currentLoopData = $tujuans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tujuan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($tujuan->id_tujuan); ?>"><?php echo e($tujuan->nama_tujuan); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label" for="alamat">Alamat</label>
                                            <textarea name="alamat" id="alamat" placeholder="Masukkan Alamat" class="form-control" required><?php echo e(old('alamat')); ?></textarea>
                                        </div>


                                        <div class="form-group mb-3">
                                            <label class="form-label" for="no_telepon">No Telepon</label>
                                            <input type="text" name="no_telepon" id="no_telepon"
                                                placeholder="Masukkan No. Telepon" class="form-control"
                                                value="<?php echo e(old('no_telepon')); ?>" required pattern="[0-9]{1,14}"
                                                maxlength="14">
                                        </div>


                                        <div class="form-group mb-3">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" name="email" id="email" placeholder="Masukkan Email"
                                                class="form-control" value="<?php echo e(old('email')); ?>" required>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="<?php echo e(route('instansi.index')); ?>" class="btn btn-secondary">Kembali</a>
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

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\manajemen-kantor\resources\views/instansi/create.blade.php ENDPATH**/ ?>