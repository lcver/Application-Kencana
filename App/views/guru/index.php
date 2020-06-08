<div class="pt-4">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button class="btn btn-custom-delete text-blue">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                    <button class="btn btn-custom-delete text-red">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>
            <table class="table table-striped">
            <thead class=" thead-light">
                <tr>
                    <th style="width:15px;" >No</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <?php foreach ($data['listNilai'] as $d) : ?>
                    <th><?=$d['mapel']?></th>
                    <?php endforeach;?>
                <tr>
            </thead>
            <tbody>
            <?php //var_dump($data['listNilai']) ?>
                <?php $no=0; foreach ($data['listNilai'] as $d) :$no++; ?>
                    <tr>
                        <td><?=$no?></td>
                        <td><?=$d['nama']?></td>
                        
                        <td><?=$d['kelas']?></td>
                        <td><?=$d['nilai']?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            </table>
        </div>
    </div>
</div>