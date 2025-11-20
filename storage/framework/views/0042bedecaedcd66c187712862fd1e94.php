

<?php $__env->startSection('styles'); ?>
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet" />

<style>
#calendar {
    min-height: 600px;
}
</style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 style="font-weight:700;">Reservasi Studio</h1>

    <button id="openForm" class="btn btn-warning">+ Tambah Reservasi</button>
</div>


<div id="formBox" class="card shadow p-4 mb-4" style="display:none; max-width:500px;">
    <form action="<?php echo e(route('reservation.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <input type="text" name="nama_customer" placeholder="Nama Customer" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="telepon" placeholder="Telepon" required>

        <select name="ruangan_id" required>
            <option value="">-- Pilih Ruangan --</option>
            <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($r->id); ?>"><?php echo e($r->nama); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <input type="date" name="tanggal" required>
        <input type="time" name="jam_mulai" required>
        <input type="time" name="jam_selesai" required>

        <button type="submit" class="btn btn-warning w-100 mt-3">Simpan Reservasi</button>
    </form>
</div>


<div class="card shadow p-4">
    <div id="calendar"></div>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function(){

    document.getElementById('openForm').addEventListener('click', () => {
        document.getElementById('formBox').style.display = 'block';
    });

    const calendarEl = document.getElementById('calendar');
    const events = <?php echo json_encode($events, 15, 512) ?>;

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: "650px",
        events: events
    });

    calendar.render();
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\admusik\resources\views/reservation.blade.php ENDPATH**/ ?>