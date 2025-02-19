

<?php $__env->startSection('content'); ?>
    <div id="app">
        <div class="container-xxl flex-grow-1 container-p-y">
            <main class="py-4">
                <div class="d-flex justify-content-between mb-2">
                    <h2 class="fw-bold py-3 mb-1">
                        <b>Data Divisi</b>
                        <span class="text-muted fw-light">/ Manajemen Divisi Perusahaan</span>
                    </h2>
                </div>
                <div class="card mb-4">
                    <div class="container">
                        <div class="d-flex justify-content-between mb-3">
                            <a href="<?php echo e(route('divisi.create')); ?>">
                                <button type="button" class="btn rounded-pill btn-primary mt-3 align-content-center">
                                    <i class="menu-icon tf-icons bx bxs-plus-circle"></i>Tambah
                                </button>
                            </a>
                        </div>
                        <?php if(session('success')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session('success')); ?>

                            </div>
                        <?php endif; ?>

                        <form action="<?php echo e(route('divisi.index')); ?>" method="GET" class="mb-3">
                            <div class="form-group d-flex">
                                <input type="text" name="search" alue="<?php echo e(request()->input('search')); ?>"
                                    class="form-control" placeholder="Cari divisi...">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </form>

                        <?php if($divisis->count() > 0): ?>
                            <div class="table-responsive text-nowrap">
                                <br>
                                <table class="table table-hover align-content-center">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Divisi</th>
                                            <th>Kode Divisi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody class="table-border-bottom-0 align-content-center">
                                        <?php $__currentLoopData = $divisis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $divisi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                    <strong><?php echo e($loop->iteration); ?></strong>
                                                </td>
                                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                    <strong><?php echo e($divisi->nama_divisi); ?></strong>
                                                </td>
                                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                    <strong><?php echo e($divisi->kode_divisi); ?></strong>
                                                </td>
                                                <td>
                                                    <a href="<?php echo e(route('divisi.edit', $divisi->id_divisi)); ?>"
                                                        class="btn btn-warning btn-sm">&nbsp;
                                                        <i class="menu-icon tf-icons bx bx-edit"></i>
                                                    </a>&nbsp;&nbsp;
                                                    <form action="<?php echo e(route('divisi.destroy', $divisi->id_divisi)); ?>"
                                                        method="POST" style="display:inline;"
                                                        onsubmit="return confirm('Yakin ingin menghapus?');">
                                                        <input type="hidden" name="_method" value="delete" />
                                                        <?php echo e(csrf_field()); ?>

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
                                <?php echo e($divisis->appends(['search' => request()->input('search')])->links('pagination::bootstrap-4')); ?>

                            </div>
                        <?php else: ?>
                            <div class="alert alert-info">
                                Tidak ada data divisi ditemukan.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </main>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\manajemen-kantor\resources\views/divisi/index.blade.php ENDPATH**/ ?>