<?php
    if(isset($data['mapel'])){
        $mapel = $data['mapel'];
        unset($data['mapel']);
    }
?>
<h3><?=$mapel?></h3>

<form action="<?=BASEURL?>soal/penilaian" method="post">
<?php $no=0; foreach ($data['soal'] as $d) : $no++;?>
    <div class="card">
        <?php if($d['jawaban']!==$d['kunciJawaban']): ?>
            <div class="card-header <?=$d['jawaban']===$d['kunciJawaban'] ? "bg-success" : "bg-danger"?>">
                <span class="text-lg" >Jawaban Yang benar adalah : <?=$d['kunciJawaban']?></span>
            </div>
        <?php endif;?>
        <div class="card-body <?=$d['jawaban']===$d['kunciJawaban'] ? "bg-success" : ""?>">
            <div class="form-question">
                <div class="form-group">
                    <span class="text-lg border-right border-success mr-2"><?=$no?>. </span>
                    <span class="text-lg"><?=$d['pertanyaan']?> . . .</span>
                </div>
            </div>

            <div class="form-answer">
                <div class="form-group">
                    <div class="custom-control custom-radio">
                        <input disabled <?=$d['jawaban']==="a" ? "checked" : ""?> class="custom-control-input" type="radio" id="customRadio<?=$no?>1" name="elenka_jawaban<?=$no?>" value="a">
                        <label for="customRadio<?=$no?>1" class="custom-control-label text-md">a</label>
                        <span class="text-lg"><?=$d['a']?></span>
                    </div>
                    <div class="custom-control custom-radio">
                        <input disabled <?=$d['jawaban']==="b" ? "checked" : ""?> class="custom-control-input" type="radio" id="customRadio<?=$no?>2" name="elenka_jawaban<?=$no?>" value="b">
                        <label for="customRadio<?=$no?>2" class="custom-control-label text-md">b</label>
                        <span class="text-lg"><?=$d['b']?></span>
                    </div>
                    <div class="custom-control custom-radio">
                        <input disabled <?=$d['jawaban']==="c" ? "checked" : ""?> class="custom-control-input" type="radio" id="customRadio<?=$no?>3" name="elenka_jawaban<?=$no?>" value="c">
                        <label for="customRadio<?=$no?>3" class="custom-control-label text-md">c</label>
                        <span class="text-lg"><?=$d['c']?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
    <div class="card col-md-2 bg-success">
        <div class="card-body text-center">
            <span class="text-lg text-bold" >Nilai : <?=$data['nilai']?></span>
        </div>
    </div>
    <div class="pb-5">
        <a href="<?=BASEURL?>" class="btn btn-primary">Kembali</a>
    </div>
</form>