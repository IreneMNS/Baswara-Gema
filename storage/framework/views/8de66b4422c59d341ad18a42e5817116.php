

<?php $__env->startSection('content'); ?>
<div class="container">
    
    <h1 class="mb-3 fw-bold">Kelola Ruangan</h1>

    <!-- FORM -->
    <div class="card p-4 mb-4 shadow-sm">
        <?php if($room): ?>
            <h4>Edit Ruangan</h4>
            <form action="<?php echo e(url('/room/'.$room->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
        <?php else: ?>
            <h4>Tambah Ruangan</h4>
            <form action="<?php echo e(url('/room')); ?>" method="POST">
                <?php echo csrf_field(); ?>
        <?php endif; ?>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Ruangan</label>
                        <input type="text" name="nama" class="form-control" 
                        value="<?php echo e($room->nama ?? ''); ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">URL Gambar</label>
                        <input type="text" name="gambar_url" class="form-control" 
                        placeholder="https://example.com/img.jpg"
                        value="<?php echo e($room->gambar_url ?? ''); ?>">
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control"><?php echo e($room->deskripsi ?? ''); ?></textarea>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Harga / Jam</label>
                        <input type="number" name="harga" class="form-control"
                        value="<?php echo e($room->harga ?? ''); ?>" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Kapasitas</label>
                        <input type="number" name="kapasitas" class="form-control"
                        value="<?php echo e($room->kapasitas ?? ''); ?>" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Fasilitas</label>
                        <input type="text" name="fasilitas" class="form-control"
                        value="<?php echo e($room->fasilitas ?? ''); ?>">
                    </div>
                </div>

                <button class="btn btn-primary mt-3" type="submit">
                    <?php echo e($room ? 'Update' : 'Tambah'); ?>

                </button>
            </form>
    </div>

    <?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <!-- CARD LIST -->
    <div class="row">
        <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    
                    <img src="<?php echo e($r->gambar_url ?: 'https://via.placeholder.com/400x250?text=No+Image'); ?>" 
                         class="card-img-top" style="height: 200px; object-fit: cover;">

                    <div class="card-body">
                        <h5 class="fw-bold"><?php echo e($r->nama); ?></h5>
                        <p class="text-muted mb-1"><?php echo e($r->deskripsi); ?></p>
                        <p class="mb-1"><strong>Harga:</strong> Rp<?php echo e(number_format($r->harga,0,',','.')); ?>/jam</p>
                        <p class="mb-1"><strong>Kapasitas:</strong> <?php echo e($r->kapasitas); ?> orang</p>
                        <p><strong>Fasilitas:</strong> <?php echo e($r->fasilitas); ?></p>

                        <div class="d-flex gap-2 mt-3">
                            <a href="<?php echo e(url('/room/'.$r->id.'/edit')); ?>" class="btn btn-warning btn-sm">Edit</a>
                            
                            <form action="<?php echo e(url('/room/'.$r->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" onclick="return confirm('Yakin hapus?')" 
                                class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\admusik\resources\views/room.blade.php ENDPATH**/ ?>