<?php require '../template/headher.php'; ?>

      <div class="container section-title" data-aos="fade-up">
        <h2>Riwayat Pembelian Diamond Dan Koin</h2>
      </div><!-- End Section Title -->
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-body">
        

    <div class="table-responsive">
        <table class="table table-striped table-bordered w-100" id="data-table">
            <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Player</th>
                        <th>Diamond (Jumlah)</th>
                        <th>Harga Diamond</th>
                        <th>Koin Bintang (Jumlah)</th>
                        <th>Harga Koin</th>
                        <th>Komentar Diamond</th>
                        <th>Komentar Koin</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                $game = get("SELECT 
                                topup_ff.nama_player,
                                topup_ff.jumlah AS jumlah_diamond,
                                topup_ff.harga AS harga_diamond,
                                topup_ff.deskripsi AS deskripsi_diamond,
                                bintang_topup.jumlah AS jumlah_koin,
                                bintang_topup.harga AS harga_koin,
                                bintang_topup.deskripsi AS deskripsi_koin
                            FROM topup_ff
                            JOIN bintang_topup ON topup_ff.nama_player = bintang_topup.nama_player
                            ORDER BY topup_ff.nama_player DESC");

                foreach ($game as $row) :
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['nama_player']; ?></td>
                        <td><?= $row['jumlah_diamond']; ?></td>
                        <td>Rp<?= number_format($row['harga_diamond']); ?></td>
                        <td><?= $row['jumlah_koin']; ?></td>
                        <td>Rp<?= number_format($row['harga_koin']); ?></td>
                        <td><?= $row['deskripsi_diamond']; ?></td>
                        <td><?= $row['deskripsi_koin']; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

    <!-- <div class="table-responsive">
        <table class="table table-striped table-bordered w-100" id="data-table">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">email</th>
                    <th class="text-center">username</th>
                    <th class="text-center">Role</th>
                    <th class="text-center">Foto</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php $i = 1 ?>
                <?php foreach ($user as $row) : ?>
                    <tr>
                        <td class="text-center"><?= $i++; ?></td>
                        <td class="text-start"><?= $row['email']; ?></td>
                        <td class="text-center"><?= $row['username']; ?></td>
                        <td class="text-center"><?= $row['role'] == 1 ? 'Superadmin' : 'Admin'; ?></td>
                        <td class="text-center">
                            <?php if ($row['foto']) : ?>
                                <img src="<?= $base_url; ?>/assets/uploads/user/<?= $row['foto']; ?>" alt="<?= $row['username']; ?>" width="70">
                            <?php else : ?>
                                <img src="<?= $base_url; ?>assets/img/noprofil.png" alt="<?= $row['username']; ?>" width="70">
                            <?php endif ?>
                        </td>
                        <td class="text-center text-nowrap">
                            <a class="btn btn-warning me-1" href="<?= $base_url; ?>admin/user/ubah.php?id=<?= $row['id_user']; ?>" role="button"><i class="bi bi-pencil-square"></i></i></a>
                            <a class="btn btn-danger button-delete" href="<?= $base_url; ?>admin/user/hapus.php?id=<?= $row['id_user']; ?>" role="button"><i class="bi bi-trash"></i></i></a>
                        </td>
                    </tr>
                <?php endforeach ?>

            </tbody>
        </table>
    </div> -->


        </div>
    </div>
</div>

<?php require '../template/foother.php'; ?>
