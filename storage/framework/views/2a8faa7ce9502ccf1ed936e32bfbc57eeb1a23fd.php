

<?php $__env->startSection('content'); ?>
    <div id="app">
        <div class="container-xxl flex-grow-1 container-p-y">
            <main class="py-4">
                <div class="d-flex justify-content-between mb-2">
                    <h2 class="fw-bold py-3 mb-1">
                        <b>Data Surat Keluar</b>
                        <span class="text-muted fw-light">/ Untuk instansi luar</span>
                    </h2>
                </div>
                <div class="card mb-4">
                    <div class="container">
                        <div class="d-flex justify-content-between mb-3">
                        </div>
                        <?php if(Auth::user()->role_as == '2'): ?>
                            <div class="d-flex justify-content-between mb-3">
                                <a href="<?php echo e(route('surat_keluar.create')); ?>">
                                    <button type="button" class="btn rounded-pill btn-primary mt-3 align-content-center">
                                        <i class="menu-icon tf-icons bx bxs-plus-circle"></i>Tambah
                                    </button>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if(session('success')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session('success')); ?>

                            </div>
                        <?php endif; ?>

                        <form action="<?php echo e(route('surat_keluar.index')); ?>" method="GET" class="mb-3">
                            <div class="form-group d-flex">
                                <input type="text" name="search" value="<?php echo e(request()->input('search')); ?>"
                                    class="form-control" placeholder="Cari asal surat keluar...">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                            <div class="form-group d-flex mt-3">
                                <button type="submit" name="sifat_surat" value="Formal"
                                    class="btn btn-secondary <?php echo e(request()->input('sifat_surat') === 'Formal' ? 'active' : ''); ?>">
                                    Formal
                                </button>&nbsp;&nbsp;
                                <button type="submit" name="sifat_surat" value="Bisnis"
                                    class="btn btn-secondary <?php echo e(request()->input('sifat_surat') === 'Bisnis' ? 'active' : ''); ?>">
                                    Bisnis
                                </button>&nbsp;&nbsp;
                                <button type="submit" name="sifat_surat" value="Resmi"
                                    class="btn btn-secondary <?php echo e(request()->input('sifat_surat') === 'Resmi' ? 'active' : ''); ?>">
                                    Resmi
                                </button>&nbsp;&nbsp;
                                <a href="<?php echo e(route('surat_keluar.index')); ?>" class="btn btn-danger ml-2">
                                    &nbsp;<i class="menu-icon tf-icons bx bx-arrow-back"></i>
                                </a>
                            </div>
                        </form>

                        <?php if($surat_keluars->count() > 0): ?>
                            <div class="table-responsive text-nowrap">
                                <br>
                                <table class="table table-hover align-content-center">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kirim Surat ke-</th>
                                            <th>Sifat Surat</th>
                                            <th>Status Surat</th>
                                            <th>Catatan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0 align-content-center">
                                        <?php $__currentLoopData = $surat_keluars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $surat_keluar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e(strlen($surat_keluar->instansi->nama_instansi) > 20 ? substr($surat_keluar->instansi->nama_instansi, 0, 20) . '...' : $surat_keluar->instansi->nama_instansi); ?>

                                                </td>
                                                <td><?php echo e($surat_keluar->sifat_surat_keluar); ?></td>
                                                <td>
                                                    <?php if($surat_keluar->status_surat == 'Approved'): ?>
                                                        <button class="btn btn-success btn-sm disabled">Telah
                                                            Disetujui</button>
                                                    <?php elseif($surat_keluar->status_surat == 'Rejected'): ?>
                                                        <button class="btn btn-danger btn-sm disabled">Ditolak</button>
                                                    <?php elseif($surat_keluar->status_surat == 'Pending'): ?>
                                                        <button class="btn btn-warning btn-sm disabled">Pending</button>
                                                    <?php endif; ?>
                                                </td>

                                                <?php if($surat_keluar->status_surat == 'Rejected'): ?>
                                                    <td><b><?php echo e($surat_keluar->catatan_surat); ?></b></td>
                                                <?php else: ?>
                                                    <td> - </td>
                                                <?php endif; ?>

                                                <td>
                                                    <?php if($surat_keluar->file_surat): ?>
                                                        <a href="<?php echo e(asset('storage/' . $surat_keluar->file_surat)); ?>"
                                                            target="_blank"
                                                            class="btn btn-success btn-sm">Unduh</a>&nbsp;&nbsp;
                                                    <?php else: ?>
                                                        Tidak ada dokumen
                                                    <?php endif; ?>
                                                    <a href="<?php echo e(route('surat_keluar.show', $surat_keluar->id_surat_keluar)); ?>"
                                                        class="btn btn-info btn-sm">Detail</a>&nbsp;&nbsp;
                                                    <a href="<?php echo e(route('surat_keluar.edit', $surat_keluar->id_surat_keluar)); ?>"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="menu-icon tf-icons bx bx-edit"></i>
                                                    </a>

                                                    &nbsp;&nbsp;
                                                    <form
                                                        action="<?php echo e(route('surat_keluar.destroy', $surat_keluar->id_surat_keluar)); ?>"
                                                        method="POST" style="display:inline;"
                                                        onsubmit="return confirm('Yakin ingin menghapus?');">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            &nbsp;<i class="menu-icon tf-icons bx bx-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center my-4 pagination-wrapper">
                                <?php echo e($surat_keluars->appends(['search' => request()->input('search')])->links('pagination::bootstrap-4')); ?>

                            </div>
                        <?php else: ?>
                            <div class="alert alert-info">
                                Tidak ada data surat keluar ditemukan.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </main>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(Auth::user()->role_as == '1' ? 'layouts.template' : 'layoutss.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\manajemen-kantor\resources\views/surat_keluar/index.blade.php ENDPATH**/ ?>