

<?php $__env->startSection('content'); ?>
    <div id="app">
        <div class="container-xxl flex-grow-1 container-p-y">
            <main class="py-4">
                <div class="d-flex justify-content-between mb-2">
                    <h2 class="fw-bold py-3 mb-1">
                        <b>Data Unit Penempatan</b>
                        <span class="text-muted fw-light">/ Manajemen Data Unit Penempatan</span>
                    </h2>
                </div>
                <div class="card mb-4">
                    <div class="container">
                        <div class="d-flex justify-content-between mb-3">
                            <a href="<?php echo e(route('unit_penempatan.create')); ?>">
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

                        <form action="<?php echo e(route('unit_penempatan.index')); ?>" method="GET" class="mb-3">
                            <div class="form-group d-flex">
                                <input type="text" name="search" value="<?php echo e(request()->input('search')); ?>"
                                    class="form-control" placeholder="Cari unit penempatan...">
                                <input type="date" name="mulai_tanggal" value="<?php echo e(request()->input('mulai_tanggal')); ?>"
                                    class="form-control mx-2" placeholder="Mulai Tanggal">
                                <input type="date" name="sampai_tanggal" value="<?php echo e(request()->input('sampai_tanggal')); ?>"
                                    class="form-control mx-2" placeholder="Sampai Tanggal">
                                <button type="submit" class="btn btn-primary">Cari</button>
                                <a href="<?php echo e(route('unit_penempatan.index')); ?>" class="btn btn-secondary ms-2">Ulang</a>
                            </div>
                        </form>

                        <?php if($unitPenempatans->count() > 0): ?>
                            <div class="table-responsive text-nowrap">
                                <br>
                                <table class="table table-hover align-content-center table-striped table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Mentor</th>
                                            <th>Mentoring di Sekolah</th>
                                            <th>Kategori</th>
                                            <th>Sub Kategori</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-1 align-content-center">
                                        <?php $__currentLoopData = $unitPenempatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unitPenempatan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td class="text-truncate" style="max-width: auto;">
                                                    <?php echo e($unitPenempatan->user->name); ?>

                                                </td>
                                                <td class="text-truncate" style="max-width: auto;">
                                                    <?php echo e($unitPenempatan->sekolah->nama_sekolah); ?>

                                                </td>
                                                <td class="text-truncate" style="max-width: auto;">
                                                    <?php echo e($unitPenempatan->kategori->nama_kategori); ?>

                                                </td>
                                                <td class="text-truncate" style="max-width: auto;">
                                                    <?php echo e($unitPenempatan->sub_kategori->nama_sub_kategori); ?>

                                                </td>
                                                <td>
                                                    <a href="<?php echo e(route('unit_penempatan.show', $unitPenempatan->id_unit_penempatan)); ?>"
                                                        class="btn btn-info btn-sm">
                                                        <i class="menu-icon tf-icons bx bxs-detail"></i>
                                                    </a>
                                                    <a href="<?php echo e(route('unit_penempatan.edit', $unitPenempatan->id_unit_penempatan)); ?>"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="menu-icon tf-icons bx bx-edit"></i>
                                                    </a>
                                                    <form
                                                        action="<?php echo e(route('unit_penempatan.destroy', $unitPenempatan->id_unit_penempatan)); ?>"
                                                        method="POST" style="display:inline;"
                                                        onsubmit="return confirm('Yakin ingin menghapus?');">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="menu-icon tf-icons bx bx-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center my-4 pagination-wrapper">
                                <?php echo e($unitPenempatans->appends(['search' => request()->input('search')])->links('pagination::bootstrap-4')); ?>

                            </div>
                        <?php else: ?>
                            <div class="alert alert-info">
                                Tidak ada data users ditemukan.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </main>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<style>
    .table th,
    .table td {
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }

    .pagination-wrapper .pagination {
        display: flex;
        justify-content: center;
        padding: 1rem 0;
    }

    .pagination-wrapper .pagination li {
        margin: 0 0.25rem;
    }

    .pagination-wrapper .pagination li a,
    .pagination-wrapper .pagination li span {
        color: #007bff;
        padding: 0.5rem 0.75rem;
        text-decoration: none;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
    }

    .pagination-wrapper .pagination li a:hover,
    .pagination-wrapper .pagination li span:hover {
        background-color: #e9ecef;
    }

    .pagination-wrapper .pagination li.active span {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }

    .pagination-wrapper .pagination li.disabled span {
        color: #6c757d;
    }
</style>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\manajemen-kantor\resources\views/unit_penempatan/index.blade.php ENDPATH**/ ?>