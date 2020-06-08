<div class="pt-4">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button class="btn btn-custom-delete text-blue">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                    <button class="btn btn-custom-delete text-red">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>
            <table class="table">
                <thead>
                    <th>No</th>
                    <th>Kelas</th>
                    <th>Mapel</th>
                    <th>Jumlah Peserta</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php $no=0; foreach ($data['siswa'] as $d) : $no++;?>
                    <tr>
                        <td><?=$no?></td>
                        <td><?=$d['kelas']?></td>
                        <td><?=$d['mapel']?></td>
                        <td><?=$d['jumlah']?></td>
                        <td>
                            <a href="http://">Lihatnilai</a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>