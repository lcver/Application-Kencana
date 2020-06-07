<div class="pt-4">
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-12 mt-2">
                                <?=Flasher::get();?>
                            </div>

                            <form action="<?=BASEURL?>guru/generate_soal" method="post" enctype="multipart/form-data">
                                <!-- select -->
                                <div class="form-group">
                                    <label>Pilih Matapelajaran</label>
                                    <select name="kencana_mapelfile" class="form-control">
                                        <option value="_BLANK_">-- Pilih Matapelajaran --</option>
                                        <?php foreach ($data['mapel'] as $d) : ?>
                                            <option value="<?=$d['id']?>"><?=$d['mapel']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Pilih Kelas</label>
                                    <select name="kencana_kelasfile[]" class="form-control" multiple>
                                        <?php foreach ($data['kelas'] as $d) : ?>
                                            <option value="<?=$d['id']?>"><?=$d['kelas']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="elenka_uploadFileSoal">File Upload</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="kencana_soalfile" class="custom-file-input" id="elenka_uploadFileSoal">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-right mt-3">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card bg-transparent shadow-none">
                        <div class="card-header">
                            <h1 class=" card-title">Daftar soal - soal</h1>
                        </div>
                        <div class="card-body">
                            <!-- <div class="row"> -->
                                <?php if(isset($data['listSoal'])):?>
                                <?php foreach ($data['listSoal'] as $d) : ?>
                                <div class="col-md-12">
                                    <div class="info-box">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheckbox<?=$d['id']?>" onClick="updateStatusSoal(<?=$d['id']?>)" <?=$d['status']==1 ? "checked" : "";?>>
                                        <label for="customCheckbox<?=$d['id']?>" class="custom-control-label"></label>
                                    </div>
                                        <div class="info-box-content">
                                            <a href="#soalview" class="elenkaSoalView" data-target-id="1">
                                                <span class="text-lg"><?=$d['mapel']?></span>
                                            </a>
                                            <div class="row">
                                                <?php foreach ($d['idKelas'] as $d) : ?>
                                                <span class="text-bold bg-primary m-1 p-1 rounded" ><?=$d['kelas']?></span>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <!-- /.info-box-content -->
                                        <div class="info-box-more">
                                            <a href="<?=BASEURL?>guru/delete_soal/<?=$d['id']?>" class="btn btn-custom-delete" onClick="return confirm('Menghapus Soal?')" >
                                            <!-- <a class="btn btn-custom-delete text-muted elenkaDeleteButton" class="btn btn-custom-delete text-muted" data-toggle="modal" data-target="#modal-sm"> -->
                                                <!-- <i class="fas fa-minus-circle"></i> -->
                                                hapus
                                            </a>
                                            <!-- <button class="btn btn-danger elenkaDeleteButton" data-target-id="<?php//$d['id']?>">
                                            </button> -->
                                        </div>
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <?php endforeach;?>
                                <?php else: ?>
                                    <span class="text-lg">Belum ada paket soal terupload</span>
                                <?php endif; ?>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.col -->
        <div class="col-md-12">
            <div id="soalview" class="pb-5"></div>
        </div>
    </div>
    <!-- /.container -->
</div>
<!-- /.pt -->

<div class="modal fade" id="elenka_modal_delete">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <h4 class="modal-title">Small Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div> -->
            <div class="modal-body pb-0">
                <p class="text-lg">Ingin menghapus paket soal?</p>
            </div>
            <div class="modal-footer justify-content-between border-top-0">
                <button type="button" class="btn btn-sm btn-danger" id="elenka_delete_confirm">Hapus</button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
<!-- /.modal -->