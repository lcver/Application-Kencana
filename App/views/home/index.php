<div class="pt-4">
    <div class="card col-md-8 mx-auto">
        <div class="card-body">
            <div class="col-md-12 text-center">
                <h3>Jadwal Ujian</h3>
                <div class="mt-2">
                    <table class="table align-items-center">
                        <tbody>
                            <?php foreach ($data['listSoal'] as $d) : ?>
                            <tr>
                                <td><?=$d['mapel']?></td>
                                <td>
                                    <?php foreach ($d['idKelas'] as $dKelas) :?>
                                    <span><?=$dKelas['kelas']?></span>                                    
                                    <?php endforeach;?>
                                </td>
                                <td><button type="submit" class="btn btn-sm btn-primary">Mulai</button></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>