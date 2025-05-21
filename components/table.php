<?php 
$start = date('Y-m-d');
if(isset($_GET['start'])){

    $start = date("Y-m-d", strtotime(str_replace('-', '/', $_GET['start'])));
}
$end = date('Y-m-d');
if(isset($_GET['end'])){

    $end = date("Y-m-d", strtotime(str_replace('-', '/', $_GET['end'])));
}

?>
<div class="card p-4 m-4">
    <div class="card-header">
        <div class="card-title">Data <?= $title ?? '' ?></div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3 p-3">
            <?php if ($table->action()): ?>
                <button id="add-form" class="btn btn-success">
                    Tambah
                </button>
            <?php else: ?>
                <div class="col-8">
                    <div class="row">
                        <div class="col-3">
                            <label for="date_start" class="form-label">Tanggal Mulai</label>
                            <input type="date" name="date_start" id="date_start" max="<?= $end ?>" class="form-control" value="<?= $start ?>">
                        </div>
                        <div class="col-3">
                            <label for="date_end" class="form-label">Tanggal Akhir</label>
                            <input type="date" name="date_end" min="<?= $start ?>" id="date_end" class="form-control" value="<?= $end ?>">
                    
                        </div>
                        <div class="col-3 ">
                            <button id="filter" onclick="onFilter()" class="btn btn-success" style="margin-top: 30px;">
                                <i class="fas fa-filter"></i>
                                Filter
                            </button>
                        </div>
                        <div class="col-3">
                            <button id="print" class="btn btn-success" style="margin-top: 30px;">
                                <i class="fas fa-print"></i>
                                Print PDF
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="d-flex align-items-center gap-2">
                <label for="entry" class="mb-0 me-2">Entries Per Page</label>
                <select name="entry" id="entry" class="form-select w-auto">
                    <option <?= $table->entry() == '5' ? 'selected' : null ?> value="5">5</option>
                    <option <?= $table->entry() == '10' ? 'selected' : null ?> value="10">10</option>
                    <option <?= $table->entry() == '15' ? 'selected' : null ?> value="15">15</option>
                    <option <?= $table->entry() == '20' ? 'selected' : null ?> value="20">20</option>
                </select>
            </div>
        </div>

        <div class="table-responsive" style="height:400px; width: 400px; overflow-x: auto; overflow-y: auto;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NO</th>
                        <?php foreach ($table->title() as $title): ?>
                            <th class="py-5 px-10 font-bold text-lg ">
                                <?= str_replace("_", " ", strtoupper($title));  ?>
                            </th>
                        <?php endforeach; ?>
                        <?php if ($table->action()): ?>
                            <th>AKSI</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if (is_array($table->value())): ?>
                        <?php $no = 1; ?>
                        <?php foreach ($table->value() as $value): ?>
                            <?php if ($no > $table->paginate()['view']): ?>
                                <?php if ($no <= ($table->entry() + $table->paginate()['view'])): ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <?php foreach ($table->title() as $title): ?>
                                            <?php if($title == 'status'): ?>
                                                <td> <span class="py-2 px-3 rounded-3
                                                    <?= $value[$title] == 'proses' ? 'bg-warning' : ($value[$title] == 'tertunda' ? 'bg-danger' : 'bg-success')  ?>">
                                                <?= $value[$title] ?></span></td>
                                            <?php elseif($title == 'invoice'): ?>
                                                <td>
                                                    <button onclick="invoice(<?= $value['id'] ?>)" class="btn btn-secondary btn-sm">
                                                        <i class="bi bi-file-earmark-text"></i>
                                                    </button>
                                                </td>
                                            <?php else: ?>
                                                <td><?= $value[$title] ?></td>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <?php if ($table->action()): ?>
                                            <td>
                                                
                                                <button onclick="<?= $table->clickEdit() ?>(<?= $value['id'] ?>)" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Edit</button>
                                                <button onclick="deleteData('<?= $table->clickDelete() ?>',<?= $value['id'] ?>)" class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i> Hapus</button>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php $no++ ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <?php $cols = count($table->title()) ?>
                        <tr>
                            <td class="text-center" colspan="<?= $cols + 2 ?>">Data belum di temukan</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end align-items-center px-5 mt-1 gap-2">
            <p class="fs-5 p-3 mt-1 mb-0"><?= $table->paginate()['summary'] ?></p>
            <div class="btn-group me-5 p-3" role="group" aria-label="Pagination">
                <button type="button"
                    class="btn btn-outline-primary"
                    onclick="paginate(<?= $table->paginate()['page'] - 1 ?>)"
                    <?= $table->paginate()['prev'] ? 'disabled' : '' ?>>
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <?php for ($i = 0; $i < $table->paginate()['count']; $i++) : ?>
                    <?php $isActive = $table->paginate()['page'] == ($i + 1); ?>
                    <button type="button"
                        class="btn <?= $isActive ? 'btn-primary' : 'btn-outline-primary' ?>"
                        onclick="paginate(<?= $i + 1 ?>)">
                        <?= $i + 1 ?>
                    </button>
                <?php endfor; ?>
                <button type="button"
                    class="btn btn-outline-primary"
                    onclick="paginate(<?= $table->paginate()['page'] + 1 ?>)"
                    <?= $table->paginate()['next'] ? 'disabled' : '' ?>>
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>
        </div>

    </div>
</div>