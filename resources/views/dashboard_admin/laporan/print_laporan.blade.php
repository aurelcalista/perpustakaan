<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Sirkulasi - Si Perpustakaan</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --navy:   #1a2d6b;
            --text:   #111827;
            --muted:  #6b7280;
            --light:  #9ca3af;
            --border: #e5e7eb;
            --row-alt: #fafafa;
            --red:    #dc2626;
            --green:  #15803d;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: white;
            color: var(--text);
            font-size: 13px;
            line-height: 1.5;
        }

        .page {
            max-width: 900px;
            margin: 0 auto;
            padding: 48px 56px;
        }

        /* ── HEADER ── */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding-bottom: 20px;
            border-bottom: 2px solid var(--navy);
            margin-bottom: 28px;
        }

        .brand {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--light);
            margin-bottom: 6px;
        }

        .doc-title {
            font-size: 22px;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -.3px;
        }

        .doc-sub {
            font-size: 12px;
            color: var(--muted);
            margin-top: 3px;
        }

        .header-right { text-align: right; padding-top: 2px; }
        .date-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--light);
            margin-bottom: 3px;
        }
        .date-val { font-size: 13px; font-weight: 600; color: var(--muted); }

        /* ── SUMMARY ── */
        .summary {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1px;
            background: var(--border);
            border: 1px solid var(--border);
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 28px;
        }

        .summary-item { background: white; padding: 16px 20px; }
        .sum-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--light);
            margin-bottom: 5px;
        }
        .sum-value { font-size: 20px; font-weight: 700; color: var(--text); line-height: 1; margin-bottom: 2px; }
        .sum-sub { font-size: 11px; color: var(--muted); }

        /* ── TABLE ── */
        .table-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--light);
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid var(--border);
            border-radius: 8px;
            overflow: hidden;
        }

        thead tr { border-bottom: 1.5px solid var(--navy); }
        thead th {
            padding: 10px 12px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--navy);
            text-align: center;
            background: white;
            white-space: nowrap;
        }
        thead th:first-child { text-align: left; padding-left: 16px; }
        thead th:nth-child(3),
        thead th:nth-child(4) { text-align: left; }

        tbody tr { border-bottom: 1px solid var(--border); }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:nth-child(even) { background: var(--row-alt); }

        tbody td { padding: 11px 12px; text-align: center; vertical-align: middle; }
        td:first-child { text-align: left; padding-left: 16px; }
        td:nth-child(3),
        td:nth-child(4) { text-align: left; }

        .no-cell { font-size: 11px; color: var(--light); font-weight: 600; }
        .id-cell {
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            color: var(--navy);
            font-weight: 500;
            letter-spacing: .3px;
        }
        .book-cell { font-weight: 600; font-size: 13px; }
        .member-cell { color: var(--muted); font-size: 12.5px; }
        .date-cell { font-size: 12px; color: var(--muted); white-space: nowrap; }

        .ok { font-size: 12px; font-weight: 600; color: var(--green); }

        .late-wrap { display: flex; flex-direction: column; align-items: center; gap: 3px; }
        .denda-val { font-size: 12.5px; font-weight: 700; color: var(--red); }
        .late-note { font-size: 10.5px; color: var(--red); opacity: .75; }

        .total-row td {
            border-top: 1.5px solid var(--navy);
            padding: 12px 16px;
            text-align: right;
            font-size: 12.5px;
            color: var(--muted);
            font-weight: 500;
            background: white;
        }
        .total-amount { font-size: 15px; font-weight: 700; color: var(--text); }

        .empty-row td {
            padding: 48px;
            text-align: center;
            color: var(--light);
            font-style: italic;
        }

        /* ── FOOTER ── */
        .footer {
            margin-top: 32px;
            padding-top: 16px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            font-size: 10.5px;
            color: var(--light);
        }

        /* ── PRINT ── */
        @media print {
            .no-print { display: none !important; }
            body { background: white; }
            .page { padding: 32px 40px; }
        }
    </style>
</head>
<body onload="window.print()">
<div class="page">

    <div class="header">
        <div>
            <div class="brand">Si Perpustakaan &nbsp;·&nbsp; Laporan Sirkulasi</div>
            <div class="doc-title">Riwayat Pengembalian Buku</div>
            <div class="doc-sub">Rekapitulasi pengembalian &amp; denda keterlambatan</div>
        </div>
        <div class="header-right">
            <div class="date-label">Dicetak Pada</div>
            <div class="date-val">{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
        </div>
    </div>

    <div class="summary no-print">
        <div class="summary-item">
            <div class="sum-label">Total Peminjaman</div>
            <div class="sum-value">{{ $laporan->count() }}</div>
            <div class="sum-sub">Data dikembalikan</div>
        </div>
        <div class="summary-item">
            <div class="sum-label">Total Denda</div>
            <div class="sum-value">Rp {{ number_format($total_denda, 0, ',', '.') }}</div>
            <div class="sum-sub">Akumulasi keterlambatan</div>
        </div>
        <div class="summary-item">
            <div class="sum-label">Tepat Waktu</div>
            <div class="sum-value">{{ $laporan->where('denda', 0)->count() }}</div>
            <div class="sum-sub">dari {{ $laporan->count() }} peminjaman</div>
        </div>
    </div>

    <div class="table-label">Detail Transaksi</div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID SKL</th>
                <th>Judul Buku</th>
                <th>Peminjam</th>
                <th>Tgl Pinjam</th>
                <th>Jatuh Tempo</th>
                <th>Tgl Dikembalikan</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporan as $index => $item)
            <tr>
                <td><span class="no-cell">{{ $index + 1 }}</span></td>
                <td><span class="id-cell">{{ $item->id_sk }}</span></td>
                <td><span class="book-cell">{{ $item->judul_buku }}</span></td>
                <td><span class="member-cell">{{ $item->nama }}</span></td>
                <td class="date-cell">{{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('d/m/Y') }}</td>
                <td class="date-cell">{{ \Carbon\Carbon::parse($item->tgl_kembali)->format('d/m/Y') }}</td>
                <td class="date-cell">{{ \Carbon\Carbon::parse($item->tgl_dikembalikan)->format('d/m/Y') }}</td>
                <td>
                    @if($item->denda > 0)
                        <div class="late-wrap">
                            <span class="denda-val">Rp {{ number_format($item->denda, 0, ',', '.') }}</span>
                            <span class="late-note">{{ $item->telat_pengembalian }} hari terlambat</span>
                        </div>
                    @else
                        <span class="ok">Tepat Waktu</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr class="empty-row">
                <td colspan="8">Tidak ada data pengembalian</td>
            </tr>
            @endforelse

            <tr class="total-row">
                <td colspan="8">
                    Total Denda Keseluruhan &nbsp;→&nbsp;
                    <span class="total-amount">Rp {{ number_format($total_denda, 0, ',', '.') }}</span>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <span>Dokumen digenerate otomatis oleh sistem Si Perpustakaan</span>
        <span>{{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</span>
    </div>

</div>
</body>
</html>