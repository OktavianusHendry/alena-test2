

<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 style="font-size: 2.0em;"><b>Profil Anda</b></h2>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label class="form-label">Nama</label>
                            <p><?php echo e($user->name); ?></p>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Email</label>
                            <p><?php echo e($user->email); ?></p>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Role</label>
                            <p><?php echo e($user->role_as == 1 ? 'Admin' : ($user->role_as == 2 ? 'Karyawan' : 'Mentor')); ?></p>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Foto Diri</label>
                            <?php if($user->foto_diri): ?>
                                <img src="<?php echo e(asset('storage/' . $user->foto_diri)); ?>" alt="Foto Diri" class="img-fluid">
                            <?php else: ?>
                                <p>Belum diunggah</p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Foto KTP</label>
                            <?php if($user->foto_ktp): ?>
                                <img src="<?php echo e(asset('storage/' . $user->foto_ktp)); ?>" alt="Foto KTP" class="img-fluid">
                            <?php else: ?>
                                <p>Belum diunggah</p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Alamat</label>
                            <p><?php echo e($user->alamat); ?></p>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Jabatan</label>
                            <p><?php echo e($user->jabatan->nama_jabatan ?? 'Belum diatur'); ?></p>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Divisi</label>
                            <p><?php echo e($user->divisi->nama_divisi ?? 'Belum diatur'); ?></p>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">No. Telepon</label>
                            <p><?php echo e($user->no_telepon ?? 'Belum diisi'); ?></p>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Tanggal Bergabung</label>
                            <p><?php echo e($user->tanggal_bergabung ?? 'Belum diisi'); ?></p>
                        </div>
                        <a href="<?php echo e(route('users.edit', $user->id)); ?>" class="btn btn-primary">Lengkapi Profil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Aplikasi_Manajemen_Kantor_v.1.4\resources\views/profile/hover.blade.php ENDPATH**/ ?>