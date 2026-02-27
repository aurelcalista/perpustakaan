<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Sirkulasi - Si Perpustakaan</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --navy:     #1a2d6b;
            --navy-mid: #3d56c0;
            --bg:       #f0f4f8;
            --border:   #e8edf2;
            --text:     #1a2332;
            --muted:    #5a6b7b;
            --light:    #8a9bac;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        /* ════ HEADER — putih bersih + accent navy kiri ════ */
        .header {
            background: white;
            border-bottom: 1px solid var(--border);
            padding: 28px 48px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }
        .header::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 5px;
            background: linear-gradient(180deg, var(--navy), var(--navy-mid));
            border-radius: 0 3px 3px 0;
        }
        .header-left { padding-left: 16px; }
        .header-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--light);
            margin-bottom: 6px;
        }
        .header-title {
            font-size: 24px;
            font-weight: 800;
            color: var(--navy);
        }
        .header-subtitle {
            font-size: 13px;
            color: var(--muted);
            margin-top: 4px;
            font-weight: 500;
        }
        .header-date { text-align: right; }
        .header-date .date-label {
            font-size: 11px;
            color: var(--light);
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 4px;
        }
        .header-date .date-value {
            font-size: 15px;
            color: var(--navy);
            font-weight: 700;
        }

        /* ════ TOOLBAR ════ */
        .toolbar {
            display: flex;
            gap: 10px;
            padding: 16px 48px;
            background: var(--bg);
            border-bottom: 1px solid var(--border);
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 18px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: all .2s;
        }
        .btn-print { background: var(--navy); color: white; }
        .btn-print:hover {
            background: #152356;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(26,45,107,.25);
        }
        .btn-back {
            background: white;
            color: var(--muted);
            border: 1.5px solid var(--border);
        }
        .btn-back:hover { background: #eef1fb; color: var(--navy); border-color: var(--navy); }
        .btn svg { width: 14px; height: 14px; }

        /* ════ SUMMARY CARDS ════ */
        .summary {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            padding: 24px 48px;
        }
        .card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px 22px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,.05);
            transition: all 0.2s;
        }
        .card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(26,45,107,.10); }
        .card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            border-radius: 12px 12px 0 0;
        }
        .card-navy::before   { background: linear-gradient(90deg, var(--navy), var(--navy-mid)); }
        .card-green::before  { background: linear-gradient(90deg, #059669, #10b981); }
        .card-orange::before { background: linear-gradient(90deg, #d97706, #f59e0b); }

        .card-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--light);
            margin-bottom: 8px;
        }
        .card-value { font-size: 30px; font-weight: 800; line-height: 1; margin-bottom: 4px; }
        .card-value.navy    { color: var(--navy); }
        .card-value.danger  { color: #dc2626; }
        .card-value.success { color: #059669; }
        .card-value.orange  { color: #d97706; }
        .card-sub { font-size: 12px; color: var(--light); font-weight: 500; }

        /* ════ TABLE ════ */
        .table-wrap { padding: 0 48px 48px; }
        .table-container {
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,.05);
        }
        table { width: 100%; border-collapse: collapse; }

        thead tr { background: var(--navy); }
        thead th {
            padding: 13px 16px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            text-align: center;
            color: rgba(255,255,255,0.85);
        }

        tbody tr { border-bottom: 1px solid var(--border); transition: background .12s; }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: #f7f9fc; }
        tbody td { padding: 12px 16px; font-size: 13.5px; text-align: center; color: var(--text); }

        .no-col { font-weight: 700; color: var(--light); text-align: left; padding-left: 20px; }
        .id-col {
            font-family: monospace;
            font-size: 12px;
            background: #eef1fb;
            padding: 3px 9px;
            border-radius: 5px;
            color: var(--navy);
            font-weight: 700;
            display: inline-block;
        }
        .buku-col { font-weight: 600; text-align: left; }
        .peminjam-col { text-align: left; color: var(--muted); }
        .denda-danger { color: #dc2626; font-weight: 700; }
        .denda-ok { color: #059669; font-weight: 600; }
        .telat-badge {
            display: inline-block;
            margin-top: 3px;
            font-size: 11px;
            background: #fee2e2;
            color: #dc2626;
            padding: 2px 8px;
            border-radius: 20px;
            font-weight: 600;
        }
        .total-row td {
            background: #eef1fb;
            border-top: 2px solid var(--navy);
            color: var(--navy);
            font-weight: 700;
            font-size: 13.5px;
            text-align: right;
            padding: 14px 20px;
        }
        .total-amount { font-size: 16px; font-weight: 800; color: var(--navy); }
        .empty-row td { padding: 48px; color: var(--light); font-style: italic; text-align: center; }

        /* ════ FOOTER ════ */
        .footer {
            text-align: center;
            padding: 16px 48px 24px;
            font-size: 12px;
            color: var(--light);
            font-weight: 500;
        }

        /* ════ PRINT ════ */
        @media print {
            .no-print { display: none !important; }
            body { background: white; }
            .header, .table-container { box-shadow: none; border: 1px solid #ddd; }
            .header::before { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            thead tr { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .total-row td { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .table-wrap { padding: 0 0 24px; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="header">
        <div class="header-left">
            <div class="header-label">Si Perpustakaan &bull; Laporan</div>
            <div class="header-title">Laporan Sirkulasi</div>
            <div class="header-subtitle">Riwayat pengembalian buku &amp; rekapitulasi denda</div>
        </div>
        <div class="header-date">
            <div class="date-label">Dicetak pada</div>
            <div class="date-value">{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
        </div>
    </div>

    <div class="toolbar no-print">
        <button onclick="window.print()" class="btn btn-print">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
            </svg>
            Cetak Laporan
        </button>
        <a href="{{ route('admin.laporan.index') }}" class="btn btn-back">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <div class="summary no-print">
        <div class="card card-navy">
            <div class="card-label">Total Peminjaman</div>
            <div class="card-value navy">{{ $laporan->count() }}</div>
            <div class="card-sub">Data dikembalikan</div>
        </div>
        <div class="card card-orange">
            <div class="card-label">Total Denda</div>
            <div class="card-value {{ $total_denda > 0 ? 'orange' : 'success' }}">
                Rp {{ number_format($total_denda, 0, ',', '.') }}
            </div>
            <div class="card-sub">Akumulasi keterlambatan</div>
        </div>
        <div class="card card-green">
            <div class="card-label">Tepat Waktu</div>
            <div class="card-value success">{{ $laporan->where('denda', 0)->count() }}</div>
            <div class="card-sub">dari {{ $laporan->count() }} peminjaman</div>
        </div>
    </div>

    <div class="table-wrap">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="text-align:left; padding-left:20px;">No</th>
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
                        <td class="no-col">{{ $index + 1 }}</td>
                        <td><span class="id-col">{{ $item->id_sk }}</span></td>
                        <td class="buku-col">{{ $item->judul_buku }}</td>
                        <td class="peminjam-col">{{ $item->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tgl_kembali)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tgl_dikembalikan)->format('d/m/Y') }}</td>
                        <td>
                            @if($item->denda > 0)
                                <span class="denda-danger">Rp {{ number_format($item->denda, 0, ',', '.') }}</span>
                                <br><span class="telat-badge">{{ $item->telat_pengembalian }} hari terlambat</span>
                            @else
                                <span class="denda-ok">&#10003; Tepat Waktu</span>
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
                            Total Denda Keseluruhan &nbsp;&rarr;&nbsp;
                            <span class="total-amount">Rp {{ number_format($total_denda, 0, ',', '.') }}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="footer">
            Dokumen ini digenerate otomatis oleh sistem Si Perpustakaan
            &bull; {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}
        </div>
    </div>

</body>
</html>