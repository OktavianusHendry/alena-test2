

<?php $__env->startSection('content'); ?>
    <div id="app">
        <div class="container-xxl flex-grow-1 container-p-y">
            <main class="py-4">
                <div class="d-flex justify-content-between mb-2">
                    <h2 class="fw-bold py-3 mb-1">
                        <b>Data User</b>
                        <span class="text-muted fw-light">/ Manajemen Data User</span>
                    </h2>
                </div>
                <div class="card mb-4">
                    <br>
                    <div class="container">
                        <?php if(session('success')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session('success')); ?>

                            </div>
                        <?php endif; ?>

                        <form action="<?php echo e(route('users.index')); ?>" method="GET" class="mb-3">
                            <div class="form-group d-flex">
                                <input type="text" name="search" value="<?php echo e(request()->input('search')); ?>"
                                    class="form-control" placeholder="Cari users...">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </form>

                        <?php if($users->count() > 0): ?>
                            <div class="table-responsive text-nowrap">
                                <br>
                                <table class="table table-hover align-content-center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Divisi</th>
                                            <th>Role</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-1 align-content-center">
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                    <strong><?php echo e($loop->iteration); ?></strong>
                                                </td>
                                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                    <strong><?php echo e($user->name); ?></strong>
                                                </td>
                                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                    <strong><?php echo e($user->divisi->kode_divisi ?? 'Divisi tidak tersedia'); ?></strong>
                                                </td>
                                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                    <strong>
                                                        <?php if($user->role_as == '1'): ?>
                                                            <button
                                                                class="btn btn-success btn-sm disabled">&nbsp;&nbsp;&nbsp;&nbsp;Admin&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                                        <?php elseif($user->role_as == '2'): ?>
                                                            <button
                                                                class="btn btn-warning btn-sm disabled">Karyawan</button>
                                                        <?php elseif($user->role_as == '0'): ?>
                                                            <button
                                                                class="btn btn-primary btn-sm disabled">&nbsp;&nbsp;&nbsp;Mentor&nbsp;&nbsp;&nbsp;</button>
                                                        <?php endif; ?>
                                                    </strong>
                                                </td>
                                                <td>
                                                    <a href="<?php echo e(route('users.show', $user->id)); ?>"
                                                        class="btn btn-info btn-sm">
                                                        &nbsp;<i
                                                            class="menu-icon tf-icons bx bxs-detail"></i></a>&nbsp;&nbsp;
                                                    <a href="<?php echo e(route('users.edit', $user->id)); ?>"
                                                        class="btn btn-warning btn-sm">
                                                        &nbsp;<i class="menu-icon tf-icons bx bx-edit"></i>
                                                    </a>&nbsp;&nbsp;
                                                    <form action="<?php echo e(route('users.destroy', $user->id)); ?>" method="POST"
                                                        style="display:inline;"
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
                                <?php echo e($users->appends(['search' => request()->input('search')])->links('pagination::bootstrap-4')); ?>

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

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\manajemen-kantor\resources\views/users/index.blade.php ENDPATH**/ ?>