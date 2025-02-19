
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
                                    <h2 style="font-size: 2.0em;"><b>Edit Kategori</b></h2>
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

                                <form action="<?php echo e(route('kategori.update', $kategori->id_kategori)); ?>" method="POST"
                                    enctype="multipart/form-data">
                                    <?php echo e(csrf_field()); ?>

                                    <input type="hidden" name="_method" value="put" />

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="nama_kategori">Nama kategori</label>
                                            <input type="text" name="nama_kategori" id="nama_kategori"
                                                class="form-control"
                                                value="<?php echo e(old('nama_kategori', $kategori->nama_kategori)); ?>" required>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        <a href="<?php echo e(route('kategori.index')); ?>" class="btn btn-secondary">Kembali</a>
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

<?php echo $__env->make(Auth::user()->role_as == '1' ? 'layouts.template' : 'layoutss.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\manajemen-kantor\resources\views/kategori/edit.blade.php ENDPATH**/ ?>