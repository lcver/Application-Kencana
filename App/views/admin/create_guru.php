<div class="pt-4">
    <h3>Tambah Guru</h3>
    <div class="card w-75 mx-auto">
        <div class="card-body">
            <form action="" method="post">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6  border-right">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="admin_createguru">Nama Depan</label>
                                        <input type="text" name="kencana_admin_namadepanguru" class="form-control" id="admin_namadepanguru">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="admin_createguru">Nama Belakang</label>
                                        <input type="text" name="kencana_admin_namabelakangguru" class="form-control" id="admin_namabelakangguru">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="kencana_mapelfile" class="form-control" id="selectRoleGuru">
                                        <option value="_BLANK_">-- Pilih Role --</option>
                                            <option value="1">Walikelas</option>
                                            <option value="2">Matapelajaran</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="admin_passwordsiswa">Password</label>
                                    <input type="password" name="kencana_admin_passwordsiswa" class="form-control" id="admin_passwordsiswa" value="1234">
                                    <span class="text-sm text-bold">password default 1234</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" id="viewQuestRoleGuru">
                            <div class="col-md-12">
                                <div class="form-group" id="roleMatapelajaran">
                                    <label>Pilih Matapelajaran</label>
                                    <?php foreach ($data['mapel'] as $d) : ?>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio<?=$d['id']?>" name="customRadio">
                                        <label for="customRadio<?=$d['id']?>" class="custom-control-label"><?=$d['mapel']?></label>
                                    </div>
                                    <?php endforeach; ?>
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