</main>
    <div class="copyright fw-bold d-flex justify-content-center">
        <?= $pengaturan['copyright']; ?>
    </div>
    </footer>

<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h5>Anda yakin ingin logout?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                <a href="<?= $base_url; ?>logout.php" class="btn btn-primary">Yes</a>
            </div>
        </div>
    </div>
</div>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>


<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- data tables -->
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>

  <!-- Vendor JS Files -->
  <script src="<?= $base_url; ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= $base_url; ?>assets/vendor/php-email-form/validate.js"></script>
  <script src="<?= $base_url; ?>assets/vendor/aos/aos.js"></script>
  <script src="<?= $base_url; ?>assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="<?= $base_url; ?>assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?= $base_url; ?>assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?= $base_url; ?>assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="<?= $base_url; ?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="<?= $base_url; ?>assets/js/main.js"></script>

<script>
    $('#form').parsley({
        errorClass: 'is-invalid text-red',
        successClass: 'is-valid',
        errorsWrapper: '<span class="invalid-feedback"></span>',
        errorTemplate: '<span></span>',
        trigger: 'change'
    });

    let pesanBerhasil = $('#pesan-berhasil').data('pesan')
    if (pesanBerhasil) {
        Swal.fire({
            title: "Good job!",
            text: pesanBerhasil,
            icon: "success"
        });
    }

    let pesanGagal = $('#pesan-gagal').data('pesan')
    if (pesanGagal) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: pesanGagal,
        });
    }

    $('#data-table').on('click', '.button-delete', function(e) {

        e.preventDefault()
        let href = $(this).attr('href')

        Swal.fire({
            title: "Anda yakin?",
            text: "Data akan dihapus!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, hapus data!"
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href
            }
        });
    })


        $('#upload').on('change', function(event) {
        $('#preview').attr('src', URL.createObjectURL(event.target.files[0]))
    })

    new DataTable('#data-table');
</script>

    <script>
        function updateHarga() {
            var jumlah = document.getElementById("jumlah").value;
            var harga = 0;
            if (jumlah == "70") harga = 10000;
            else if (jumlah == "140") harga = 20000;
            else if (jumlah == "355") harga = 50000;
            else if (jumlah == "720") harga = 100000;
            document.getElementById("harga").value = harga;
        }
</script>

<!-- Set harga based on KWH -->
<script>
function setHarga() {
    const hargaMap = {
        450: 10000,
        900: 20000,
        1300: 30000,
        2200: 40000,
        3500: 50000
    };
    const kwh = document.getElementById('kwh').value;
    document.getElementById('harga').value = hargaMap[kwh] || '';
}

// Preview foto
document.getElementById('fotoInput').addEventListener('change', e => {
    const reader = new FileReader();
    reader.onload = () => document.getElementById('preview').src = reader.result;
    reader.readAsDataURL(e.target.files[0]);
});
</script>


</body>

</html>