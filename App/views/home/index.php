<div class="pt-4">
    <div class="card col-md-8 mx-auto">
        <div class="card-body">
            <div class="col-md-12 text-center">
                <h4>Jadwal Ujian</h4>
                <div class="mt-2">
                    <table class="table align-items-center">
                        <tbody>
                            <?php if(isset($data['listSoal'])): ?>
                            <?php foreach ($data['listSoal'] as $d) : ?>
                            <tr>
                                <td><?=$d['mapel']?></td>
                                <td>
                                    <?php foreach ($d['idKelas'] as $dKelas) :?>
                                    <span><?=$dKelas['kelas']?></span>                                    
                                    <?php endforeach;?>
                                </td>
                                <td>
                                    <a href="<?=BASEURL?>soal/index/<?=$d['id']?>" class="btn btn-sm btn-primary" <?=$d['status']==2 ? "disabled" : "";?>>Mulai</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else:?>
                                Selesai
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>