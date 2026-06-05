<div class="card border-0 shadow-sm rounded-3 p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark m-0"><i class="fas fa-file-invoice-dollar text-primary me-2"></i> Riwayat Pendapatan</h4>
        <span class="badge bg-primary px-3 py-2 rounded-pill">Total Transaksi: <?= count($laporan) ?></span>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th width="50">No</th>
                    <th>Tanggal / Waktu</th>
                    <th>No. Invoice</th>
                    <th class="text-end">Total Omzet</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($laporan)): ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">Belum ada transaksi yang disimpan.</td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1; $grandTotal = 0; foreach ($laporan as $row): $grandTotal += $row['total_harga']; ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= date('d M Y - H:i', strtotime($row['tanggal'])) ?> WIB</td>
                            <td><code class="fw-bold"><?= $row['invoice'] ?></code></td>
                            <td class="text-end fw-bold text-success">Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr class="table-dark fw-bold">
                        <td colspan="3" class="text-center">TOTAL TOTALAN OMZET MASUK</td>
                        <td class="text-end text-warning">Rp <?= number_format($grandTotal, 0, ',', '.') ?></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>