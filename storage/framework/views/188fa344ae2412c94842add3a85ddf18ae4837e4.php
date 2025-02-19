

<?php $__env->startSection('content'); ?>
    <div id="app">
        <div class="container-xxl flex-grow-1 container-p-y">
            <main class="py-4">
                <div class="d-flex justify-content-between mb-2">
                    <h2 class="fw-bold py-3 mb-1">
                        <b>Data Arsip File Release</b>
                        <span class="text-muted fw-light">/ Manajemen File Release</span>
                    </h2>
                </div>

                <div class="card mb-4">
                    <div class="container">
                        <div class="d-flex justify-content-between mb-3">
                            <a href="<?php echo e(route('release.create')); ?>">
                                <button type="button" class="btn rounded-pill btn-primary mt-3 align-content-center">
                                    <i class="menu-icon tf-icons bx bxs-plus-circle"></i> Tambah
                                </button>
                            </a>
                        </div>
                        <?php if(session('success')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session('success')); ?>

                            </div>
                        <?php endif; ?>

                        <form action="<?php echo e(route('release.index')); ?>" method="GET" class="mb-3">
                            <div class="form-group d-flex">
                                <input type="text" name="search" value="<?php echo e(request()->input('search')); ?>"
                                    class="form-control" placeholder="Cari laporan cuti...">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </form>

                        <?php if($releases->count() > 0): ?>
                            <div class="table-responsive text-nowrap">
                                <br>
                                <table class="table table-hover align-content-center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Isi</th>
                                            <th>File</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $releases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $release): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e($release->judul_release); ?></td>
                                                <td><?php echo e(\Illuminate\Support\Str::limit($release->isi_release, 12)); ?></td>
                                                <td>
                                                    <?php if($release->file): ?>
                                                        <a href="<?php echo e(Storage::url($release->file)); ?>" target="_blank"
                                                            class="btn btn-primary btn-sm">Lihat
                                                            File</a>
                                                    <?php else: ?>
                                                        Tidak ada file
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <a href="<?php echo e(route('release.show', $release->id_release)); ?>"
                                                        class="btn btn-info btn-sm">
                                                        &nbsp;<i
                                                            class="menu-icon tf-icons bx bxs-detail"></i></a>&nbsp;&nbsp;
                                                    <a href="<?php echo e(route('release.edit', $release->id_release)); ?>"
                                                        class="btn btn-warning btn-sm">
                                                        &nbsp;<i class="menu-icon tf-icons bx bx-edit"></i>
                                                    </a>&nbsp;&nbsp;
                                                    <form action="<?php echo e(route('release.destroy', $release->id_release)); ?>"
                                                        method="POST" style="display:inline;"
                                                        onsubmit="return confirm('Yakin ingin menghapus?');">
                                                        <input type="hidden" name="_method" value="delete" />
                                                        <?php echo e(csrf_field()); ?>

                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            &nbsp; <i class="menu-icon tf-icons bx bx-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center my-4 pagination-wrapper">
                                <?php echo e($releases->appends(['search' => request()->input('search')])->links('pagination::bootstrap-4')); ?>

                            </div>
                        <?php else: ?>
                            <div class="alert alert-info">
                                Tidak ada data release ditemukan.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </main>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(Auth::user()->role_as == '1' ? 'layouts.template' : 'layoutss.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\manajemen-kantor\resources\views/release/index.blade.php ENDPATH**/ ?>