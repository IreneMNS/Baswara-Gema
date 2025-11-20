

<?php $__env->startSection('styles'); ?>
<style>
    .status-selesai {
        background: #2ECC71;
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 13px;
    }

    .status-booking {
        background: #F1C40F;
        color: black;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 13px;
    }

    .status-cancel {
        background: #E74C3C;
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 13px;
    }

    .table thead {
        background: #D5B46F;
        color: black;
    }

    .btn-edit {
        color: #3498DB;
        font-weight: bold;
        cursor: pointer;
    }

    .btn-delete {
        color: #E74C3C;
        font-weight: bold;
        cursor: pointer;
        margin-left: 10px;
    }

    .btn-cancel {
        color: #E67E22;
        cursor: pointer;
        font-weight: bold;
        margin-left: 10px;
    }

    #editModal {
        display: none;
        justify-content: center;
        align-items: center;
        position: fixed;
        z-index: 2000;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.6);
        animation: fadeIn .2s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
</style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<h1 style="font-weight:700;">List Reservasi</h1>

<div class="card shadow p-4 mt-3">
    <table class="table align-middle">
        <thead>
        <tr>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Ruangan</th>
            <th>Paket</th>
            <th>Jam</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        </thead>

        <tbody>
        <?php $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <tr>
                <td><?php echo e(\Carbon\Carbon::parse($r->tanggal)->format('d M Y')); ?></td>
                <td><strong><?php echo e($r->nama_customer); ?></strong></td>
                <td><?php echo e($r->ruangan->nama); ?></td>
                <td><?php echo e($r->paket ?? '-'); ?></td>
                <td><?php echo e($r->jam_mulai); ?> - <?php echo e($r->jam_selesai); ?></td>

                <td>
                    <?php if($r->status == 'selesai'): ?>
                        <span class="status-selesai">Selesai</span>
                    <?php elseif($r->status == 'batal'): ?>
                        <span class="status-cancel">Batal</span>
                    <?php else: ?>
                        <span class="status-booking">Sudah Booking</span>
                    <?php endif; ?>
                </td>

                <td>
                    <span class="btn-edit" onclick="openEditModal(<?php echo e($r->id); ?>)">✏ Edit</span>

                    <?php if($r->status != 'batal'): ?>
                    <form action="<?php echo e(route('reservation.cancel', $r->id)); ?>" method="POST" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                        <button type="submit" onclick="return confirm('Yakin mau batalkan?')" class="btn-cancel">⛔ Batal</button>
                    </form>
                    <?php endif; ?>

                    <form action="<?php echo e(route('reservation.destroy', $r->id)); ?>" method="POST" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" onclick="return confirm('Hapus permanen?')" class="btn-delete">🗑 Hapus</button>
                    </form>
                </td>
            </tr>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>



<div id="editModal">
    <div class="card p-4" style="width:450px;">

        <h3 class="mb-3">Edit Reservasi</h3>

        <form id="editForm" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <label>Nama Pemesan</label>
            <input id="editNama" type="text" name="nama_customer" class="form-control">

            <label>Tanggal</label>
            <input id="editTanggal" type="date" name="tanggal" class="form-control">

            <label>Ruangan</label>
            <select id="editRuangan" name="ruangan_id" class="form-control">
                <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($room->id); ?>"><?php echo e($room->nama); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <!-- <label>Paket</label>
            <select id="editPaket" name="paket" class="form-control">
                <option value="-">-</option>
                <option value="Reguler">Reguler</option>
                <option value="Premium">Premium</option>
                <option value="VIP">VIP</option>
            </select> -->

            <label>Jam Mulai</label>
            <input id="editJamMulai" type="time" name="jam_mulai" class="form-control">

            <label>Jam Selesai</label>
            <input id="editJamSelesai" type="time" name="jam_selesai" class="form-control">

            <button type="submit" class="btn btn-success mt-3 w-100">Update</button>
            <button type="button" class="btn btn-secondary mt-2 w-100" onclick="closeEditModal()">Batal</button>
        </form>

    </div>
</div>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('scripts'); ?>
<script>
    let reservations = <?php echo json_encode($reservations, 15, 512) ?>;

    function openEditModal(id) {
        let data = reservations.find(r => r.id === id);

        document.getElementById("editNama").value = data.nama_customer;
        document.getElementById("editTanggal").value = data.tanggal;
        document.getElementById("editRuangan").value = data.ruangan_id;
        document.getElementById("editJamMulai").value = data.jam_mulai;
        document.getElementById("editJamSelesai").value = data.jam_selesai;

        document.getElementById("editForm").action = `/reservation/${id}`;

        document.getElementById("editModal").style.display = "flex";
    }

    function closeEditModal() {
        document.getElementById("editModal").style.display = "none";
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\admusik\resources\views/listbook.blade.php ENDPATH**/ ?>