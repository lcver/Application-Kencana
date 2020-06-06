<div class="pt-4">
    <div class="card">
        <div class="card-body">
            <div class="card col-md-6">
                <div class="card-body">
                    <div class="col-md-12 mt-2">
                        <?=Flasher::get();?>
                    </div>

                    <form action="<?=BASEURL?>guru/generate_siswa" method="post" enctype="multipart/form-data">
                        <!-- select -->
                        <div class="form-group">
                            <label>Pilih Matapelajaran</label>
                            <select name="guru_kelas_siswa" class="form-control">
                                <option value="_BLANK_">-- Pilih Kelas --</option>
                                <?php foreach ($data['kelas'] as $d) : ?>
                                    <option value="<?=$d['id']?>"><?=$d['kelas']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="file_list_siswa">File Upload</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="guru_list_siswa" class="custom-file-input" id="file_list_siswa">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary mt-3">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead class="thead-light">
                        <th>No</th>
                        <th>Nis</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th class="text-center">***</th>
                    </thead>
                    <tbody>
                        <?php foreach ($data['kelas'] as $dKelas) : ?>
                            <?php $no=0; foreach ($data['listSiswa'][$dKelas['id']] as $d) : $no++;?>
                            <tr>
                                <td><?=$no?></td>
                                <td><?=$d['nis']?></td>
                                <td><?=$d['nama']?></td>
                                <td><?=$d['kelas']?></td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-custom-delete text-red">hapus</a>
                                    |
                                    <a href="#" class="btn btn-custom-delete text-lightblue">Edit</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>