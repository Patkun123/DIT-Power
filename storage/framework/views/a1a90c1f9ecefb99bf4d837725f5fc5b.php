<?php if(session()->has('sweetalert2')): ?>
  <script type="module">
    import Swal from 'https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.esm.all.min.js';

    Swal.fire(<?php echo json_encode(session('sweetalert2'), 15, 512) ?>);
  </script>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\systems\DIT-Power\DTI-Power\vendor\sweetalert2\laravel\src/../resources/views/index.blade.php ENDPATH**/ ?>