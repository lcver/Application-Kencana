<?php
    if(isset($data['mapel'])){
        $mapel = $data['mapel'];
        unset($data['mapel']);
    }
?>
<h3><?=$mapel?></h3>

<form action="<?=BASEURL?>soal/penilaian" method="post">
<?php $no=0; foreach ($data['soal'] as $d) : $no++;?>
    <input type="hidden" name="kencana_idFile" value="<?=$d['idFile']?>">
    <input type="hidden" name="kencana_idSoal<?=$no?>" value="<?=$d['id']?>">
    <div class="card">
        <div class="card-body">
            <div class="form-question">
                <div class="form-group">
                    <span class="text-lg border-right border-success mr-2"><?=$no?>. </span>
                    <span class="text-lg"><?=$d['soal']?> . . .</span>
                </div>
            </div>
            <div class="form-gambar">
                <?php if(isset($d['gambar'])) : ?>
                    <img src="<?=BASEURL?>img/<?=$d['gambar']?>" alt="<?=$d['gambar']?>" class="img-thumbnail" style="max-height:250px">
                <?php endif; ?>
            </div>

            <div class="form-answer">
                <div class="form-group">
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="customRadio<?=$no?>1" name="kencana_jawaban<?=$no?>" value="a">
                        <label for="customRadio<?=$no?>1" class="custom-control-label text-md"></label>
                        <span class="text-lg"><?=$d['a']?></span>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="customRadio<?=$no?>2" name="kencana_jawaban<?=$no?>" value="b">
                        <label for="customRadio<?=$no?>2" class="custom-control-label text-md"></label>
                        <span class="text-lg"><?=$d['b']?></span>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="customRadio<?=$no?>3" name="kencana_jawaban<?=$no?>" value="c">
                        <label for="customRadio<?=$no?>3" class="custom-control-label text-md"></label>
                        <span class="text-lg"><?=$d['c']?></span>
                    </div>
                    <?php if(!is_null($d['d'])): ?>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="customRadio<?=$no?>3" name="kencana_jawaban<?=$no?>" value="c">
                        <label for="customRadio<?=$no?>3" class="custom-control-label text-md"></label>
                        <span class="text-lg"><?=$d['d']?></span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
    <div class="pb-5">
        <!-- <a href="<?=BASEURL?>soal/cancel">Kembali</a> -->
        <button type="submit" class="btn btn-primary float-right" >Selesai</button>
    </div>
</form>