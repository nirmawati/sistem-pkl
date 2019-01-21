<?php
use yii\helpers\Html;

?>

<div class="pdf-dealer container">
    <br>
    <p>Nama Mahasiswa : <?= $mahasiswa->nama ?></p>
    <p>Perusahaan : <?= $mitraPkl->nama ?></p>
    <b></b>
    <table class="table table-borderless">
        <thead>
            <tr>
                <td>KET</td>
                <td>Tanggal</td>
                <td>Jam Masuk</td>
                <td>Jam Pulang</td>
                <td>Kegiatan</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($model as $data): ?>
                <tr>
                    <td><?php
                        if ($data->ket == 1) {
                            echo 'Hadir';
                        } elseif ($data->ket == 2) {
                            echo 'Izin';
                        } else {
                            echo 'Mangkir';
                        }
                    ?></td>
                    <td><?= $data->tanggal ?></td>
                    <td><?= $data->jam_masuk ?></td>
                    <td><?= $data->jam_pulang ?></td>
                    <td><?= $data->kegiatan ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    mengetahui
</div>