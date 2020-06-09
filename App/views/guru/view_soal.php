<div class="card card-outline card-primary">
    <div class="card-header"
        <?php foreach ($data['listSoal'] as $d) : ?>
        <h3 class="card-title"><?=$d['mapel']?></h3>
        <?php endforeach;?>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="col-md-12">
            <?php $no=0; foreach ($data['soal'] as $d) : $no++;?>
            <div class="card">
                <form action="<?=BASEURL?>guru/add_asset_soal" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <h5 class="clearfix soal-pertanyaan"><span class="soal-nomor"><?=$no?></span><?=$d['soal']?>?</h5>
                    <?php if($d['gambar']==NULL):?>
                    <div class="form-group col-md-3">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="hidden" name="kencana_idFile" value="<?=$d['idFile']?>">
                                <input type="hidden" name="kencana_idSoal" value="<?=$d['id']?>">
                                <input type="file" name="kencana_uploadgambar<?=$d['id']?>" class="custom-file-input" id="kencana_uploadGambarSoal<?=$d['id']?>" onChange="uploadGambarSoal(<?=$d['id']?>)" accept="image/*">
                                <label class="custom-file-label" for="exampleInputFile<?=$d['id']?>">Upload Gambar</label>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="col-md-12 clearfix">
                        <img src="<?=BASEURL?>img/soal_gambar/<?=$d['gambar']?>" alt="gambar-<?=$d['gambar']?>" class="img-thumbnail" style="max-height:250px">
                        <div class="col-md-12">
                            <a href="#soalview" onClick="deleteGambarSoal(<?=$d['id']?>,<?=$d['idFile']?>)">hapus</a>
                        </div>
                    </div>
                    <?php endif;?>
                    <div class="soal-jawaban">
                        <span class="clearfix <?=$d['kunciJawaban']==='a' ? 'text-bold text-success' : ''; ?>">a. <?=$d['a']?></span>
                        <span class="clearfix <?=$d['kunciJawaban']==='b' ? 'text-bold text-success' : ''; ?>">b. <?=$d['b']?></span>
                        <span class="clearfix <?=$d['kunciJawaban']==='c' ? 'text-bold text-success' : ''; ?>">c. <?=$d['c']?></span>
                        <?php if(!is_null($d['d'])): ?>
                        <span class="clearfix <?=$d['kunciJawaban']==='d' ? 'text-bold text-success' : ''; ?>">d. <?=$d['d']?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary d-none" id="elenka_btn_gambar_soal<?=$d['id']?>">Simpan</button>
                </div>
                </form>
            </div>
            <?php endforeach;?>
        </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
<script type="text/javascript">
    $(document).ready(function () {
        bsCustomFileInput.init();
    });
</script>