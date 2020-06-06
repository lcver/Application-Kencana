<div class="pt-4">
    <h4>Tambah Siswa</h4>
    <div class="card w-75 mx-auto">
        <div class="card-body">
            <?=Flasher::get()?>
            <form action="<?=BASEURL?>administration/create_siswa" method="post">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="admin_createsiswa">Nama Lengkap</label>
                        <input type="text" name="kencana_admin_namasiswa" class="form-control" id="admin_namasiswa">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Kelas</label>
                        <select name="kencana_admin_kelassiswa" class="form-control">
                            <option value="_BLANK_">-- Pilih Kelas --</option>
                            <?php foreach ($data['kelas'] as $d) : ?>
                                <option value="<?=$d['id']?>"><?=$d['kelas']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="admin_nissiswa">NIS</label>
                        <input type="text" name="kencana_admin_nissiswa" class="form-control" id="admin_nissiswa">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="admin_passwordsiswa">Password</label>
                        <input type="password" name="kencana_admin_passwordsiswa" class="form-control" id="admin_passwordsiswa" value="1234">
                        <span class="text-sm text-bold">password default 1234</span>
                    </div>
                </div>
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>