<div class="pt-4">
    <h3>Tambah Guru</h3>
    <div class="card w-75 mx-auto">
        <div class="card-body">
            <?=Flasher::get()?>
            <form action="<?=BASEURL?>administration/create_guru" method="post">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6  border-right">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-6 p-0 m-0">
                                        <label for="admin_createguru">Nama Pengguna</label>
                                        <input type="text" name="kencana_admin_namapenggunaguru" class="form-control" id="admin_namapenggunaguru">
                                    </div>
                                    <label for="admin_createguru">Nama Lengkap</label>
                                    <input type="text" name="kencana_admin_namalengkapguru" class="form-control" id="admin_namalengkapguru">
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="kencana_admin_roleguru" class="form-control" id="selectRoleGuru" onchange="layoutRoleGuru()">
                                        <option value="_BLANK_">-- Pilih Role --</option>
                                            <option value="1">Walikelas</option>
                                            <option value="2">Matapelajaran</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="admin_passwordguru">Password</label>
                                    <input type="password" name="kencana_admin_passwordguru" class="form-control" id="admin_passwordguru" value="1234">
                                    <span class="text-sm text-bold">password default 1234</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" id="viewQuestRoleGuru">
                            <div class="form-group d-none" id="roleMatapelajaran">
                                <label>Pilih Matapelajaran</label>
                                <?php foreach ($data['mapel_lokal'] as $d) : ?>
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="" class="custom-control-input mapelMatapelajaran" id="customRadio<?=$d['id']?>" value="<?=$d['id']?>">
                                    <label for="customRadio<?=$d['id']?>" class="custom-control-label"><?=$d['mapel']?></label>
                                </div>
                                <?php endforeach; ?>

                                <label>Pilih Kelas</label>
                                <div class="col-md-12">
                                    <div class="row">
                                        <?php foreach ($data['kelas'] as $d) : ?>
                                        <div class="custom-control custom-checkbox mr-4">
                                            <input type="checkbox" name="" class="custom-control-input kelasMatapelajaran" id="kelasMpCheckbox<?=$d['id']?>" value="<?=$d['id']?>" checked>
                                            <label for="kelasMpCheckbox<?=$d['id']?>" class="custom-control-label"><?=$d['kelas']?></label>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="d-none" id="roleWalikelas">
                                <div class="form-group">
                                    <label>Pilih Mata Pelajaran</label>
                                    <?php foreach($data['mapel_umum'] as $d) : ?>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="" class="custom-control-input mapelWalikelas" id="mapelCheckbox<?=$d['id']?>" value="<?=$d['id']?>" checked>
                                        <label for="mapelCheckbox<?=$d['id']?>" class="custom-control-label"><?=$d['mapel']?></label>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="form-group">
                                    <label>Pilih Kelas</label>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <?php foreach ($data['kelas'] as $d) : ?>
                                            <div class="custom-control custom-checkbox mr-4">
                                                <input type="checkbox" name="" class="custom-control-input kelasWalikelas" id="kelasWlCheckbox<?=$d['id']?>" value="<?=$d['id']?>">
                                                <label for="kelasWlCheckbox<?=$d['id']?>" class="custom-control-label"><?=$d['kelas']?></label>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>