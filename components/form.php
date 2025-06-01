<div class="bg-white mt-4 p-4 rounded shadow m-4">
    <form id="<?= $form->setForm() ?>" method="<?= $form->setMethod() ?>" enctype="<?= $form->setEnctype() ?>">
        <?php if ($form->setMethod() == 'PUT'): ?>
            <input type="hidden" name="id" id="id" value="<?= $id ?>">
        <?php endif; ?>
        <div class="p-3 overflow-auto" style="max-height: 440px;">
            <?php $form ?? '' ?>
            <div class="row">
                <?php foreach ($input as $row): ?>
                    <?php
                    $row['type'] = $row['type'] ?? 'text';
                    if ($row['type'] !== 'hidden'): ?>
                        <div class="mb-3 col-md-6">
                            <?php if ($row['type'] == 'select'): ?>
                                <label class="form-label" for="<?= $row['name'] ?? 'name' ?>"><?= $row['label'] ?? '' ?></label>
                                <select <?= $row['required'] ? 'required' : '' ?> class="form-select bg-light py-2" name="<?= $row['name'] ?? 'name' ?>" id="<?= $row['id'] ?? $row['name'] ?>">
                                    <option value=""><?= $row['placeholder'] ?? 'Pilih' ?></option>
                                    <?php foreach ($row['data'] as $rows): ?>
                                        <option
                                            <?= $row['value'] == $rows['id'] ? 'selected' : null; ?>
                                            value="<?= $rows['id'] ?>"><?= $rows['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            <?php else: ?>
                                <label for="<?= $row['name'] ?? 'name' ?>" class="form-label"><?= $row['label'] ?? '' ?></label>
                                <input
                                    type="<?= $row['type'] ?? 'text' ?>"
                                    name="<?= $row['name'] ?>"
                                    id="<?= $row['id'] ?? $row['name'] ?? '' ?>"
                                    placeholder="<?= $row['placeholder'] ?? '' ?>"
                                    <?= $row['required'] ? 'required' : null ?>
                                    class="form-control bg-light"
                                    value="<?= $row['value'] ?? null ?>" <?= isset($row['readonly']) ? 'readonly' : null ?>>
                            <?php endif; ?>
                            <div>
                                <p id="message_<?= $row['name'] ?>" class="text-muted text-danger">

                                </p>
                            </div>
                        </div>
                    <?php else: ?>
                        <input
                            type="hidden"
                            name="<?= $row['name'] ?>"
                            id="<?= $row['id'] ?? $row['name'] ?? '' ?>"
                            value="<?= $row['value'] ?? null ?>">
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <?php if ($form->detail()): ?>
                <div class="row">
                    <div class="col-8 mb-2">
                        <select id="select-barang" class="form-select" placeholder="Cari Barang" autocomplete="off">
                            <option value="">Select Barang</option>

                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <table id="detail" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="form-label" for="total_harga_barang">Total Harga Barang</label>
                        <input type="number" name="total_harga_barang" id="total_harga_barang" placeholder="Total Harga Barang" class="form-control" readonly>
                    </div>
                </div>
            <?php endif; ?>
        </div>


        <div class="d-flex align-items-center gap-2 p-2">
            <button type="button" onclick="<?= $form->onClick() ?>('<?= $form->setForm() ?>','<?= $form->setMethod() ?>')" class="btn btn-primary">Simpan</button>
            <button type="button" onclick="onBack()" class="btn btn-secondary">Batal</button>
        </div>
    </form>
</div>

<script>

</script>