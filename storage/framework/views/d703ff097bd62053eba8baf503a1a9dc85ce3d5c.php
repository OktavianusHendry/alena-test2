

<?php $__env->startSection('content'); ?>
    <div id="app">
        <main class="py-4">
            <div class="container">

                <div class="row">
                    <!-- Detail Karyawan Section -->
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-header bg-primary text-white">
                                Detail Info User&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;<?php echo e($user->role_name); ?>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <tbody>
                                            <br>
                                            <tr>
                                                <th scope="row"><b>Nama</b></th>
                                                <td><?php echo e($user->name); ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><b>Alamat</b></th>
                                                <td><?php echo e($user->alamat); ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><b>No. Telepon</b></th>
                                                <td><?php echo e($user->no_telepon); ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><b>Email</b></th>
                                                <td><?php echo e($user->email); ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><b>Jabatan</b></th>
                                                <?php if($user->divisi): ?>
                                                    <td><?php echo e($user->jabatan->nama_jabatan); ?></td>
                                                <?php else: ?>
                                                    <td>-</td>
                                                <?php endif; ?>
                                            </tr>
                                            <tr>
                                                <th scope="row"><b>Divisi</b></th>
                                                <?php if($user->divisi): ?>
                                                    <td><?php echo e($user->divisi->nama_divisi); ?>&nbsp;&nbsp;(<?php echo e($user->divisi->kode_divisi); ?>)
                                                    </td>
                                                <?php else: ?>
                                                    <td>-</td>
                                                <?php endif; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><b>Surat Tugas (Mentor)</b></th>
                                                <td>
                                                    <?php if($user->surat_tugas): ?>
                                                        <!-- Check if surat_tugas exists -->
                                                        <a href="<?php echo e(asset('storage/' . $user->surat_tugas)); ?>"
                                                            target="_blank"
                                                            class="btn btn-success btn-sm">Lihat</a>&nbsp;&nbsp;
                                                    <?php else: ?>
                                                        Tidak ada dokumen
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><b>Bergabung Pada</b></th>
                                                <td><?php echo e($user->created_at->setTimezone('Asia/Jakarta')->format('d M Y H:i')); ?>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <p class="muted">Diperbarui pada :
                                        <?php echo e($user->updated_at->setTimezone('Asia/Jakarta')->format('d M Y H:i')); ?></p>
                                </div>
                                <br>
                                <div class="d-flex justify-content-between">
                                    <a href="<?php echo e(route('users.index')); ?>" class="btn btn-warning">Kembali</a>
                                    <a href="<?php echo e(route('users.edit', $user->id)); ?>" class="btn btn-info">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Foto Pegawai Section -->
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header bg-success text-white">
                                Foto
                            </div>
                            <div class="card-body text-center mt-3">
                                <img class="img-fluid mb-3" src="<?php echo e(asset('storage/' . $user->foto_diri)); ?>"
                                    alt="Foto Diri">
                                <p><?php echo e($user->name); ?></p>
                                <br>
                                <img class="img-fluid" src="<?php echo e(asset('storage/' . $user->foto_ktp)); ?>" alt="Foto KTP">
                                <p class="mt-2">KTP</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
<?php $__env->stopSection(); ?>

<style>
    .table th,
    .table td {
        border-top: none;
    }

    .card-header {
        font-size: 1.25rem;
        font-weight: bold;
    }

    .card-body p {
        margin-bottom: 0.5rem;
    }
</style>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\manajemen-kantor\resources\views/users/show.blade.php ENDPATH**/ ?>