<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Sirkulasi - Si Perpustakaan</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #f5f7fa;
            color: #1a1a2e;
            min-height: 100vh;
        }

        /* HEADER */
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 36px 48px 28px;
            position: relative;
            overflow: hidden;
        }
        .header::before {
            content: '';
            position: absolute;
            top: -40px; right: -40px;
            width: 200px; height: 200px;
            border-radius: 50%;
            background: rgba(255,255,255,.08);
        }
        .header::after {
            content: '';
            position: absolute;
            bottom: -60px; left: 30%;
            width: 300px; height: 300px;
            border-radius: 50%;
            background: rgba(255,255,255,.05);
        }
        .header-inner {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }
        .header-label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #c4b5fd;
            margin-bottom: 8px;
        }
        .header-title {
            font-family: 'DM Serif Display', serif;
            font-size: 32px;
            line-height: 1.1;
            color: white;
        }
        .header-subtitle {
            font-size: 14px;
            color: rgba(255,255,255,.6);
            margin-top: 6px;
        }
        .header-date {
            text-align: right;
            font-size: 12px;
            color: rgba(255,255,255,.55);
        }
        .header-date strong {
            display: block;
            font-size: 15px;
            color: #e9d5ff;
            font-weight: 600;
        }
        .purple-line {
            height: 3px;
            background: linear-gradient(90deg, rgba(255,255,255,.5), transparent);
            margin-top: 24px;
        }

        /* TOOLBAR */
        .toolbar {
            display: flex;
            gap: 10px;
            padding: 20px 48px;
            background: white;
            border-bottom: 1px solid #e0e0f0;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 20px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: all .2s;
        }
        .btn-print {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .btn-print:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(102,126,234,.3);
        }
        .btn-back {
            background: white;
            color: #667eea;
            border: 1.5px solid #e0e0f0;
        }
        .btn-back:hover { background: #f5f3ff; color: #667eea; }
        .btn svg { width: 15px; height: 15px; }

        /* SUMMARY CARDS */
        .summary {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            padding: 24px 48px;
        }
        .card {
            background: white;
            border: 1px solid #e0e0f0;
            border-radius: 12px;
            padding: 20px 24px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(102,126,234,.06);
            transition: all 0.3s;
        }
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 40px rgba(102,126,234,.12);
        }
        .card::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
        }
        .card-label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #6b7280;
            margin-bottom: 8px;
        }
        .card-value {
            font-family: 'DM Serif Display', serif;
            font-size: 28px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .card-value.danger {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .card-value.success {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .card-sub {
            font-size: 12px;
            color: #6b7280;
            margin-top: 4px;
        }

        /* TABLE */
        .table-wrap { padding: 0 48px 48px; }
        .table-wrap table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(102,126,234,.08);
        }
        thead tr {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        thead th {
            padding: 14px 16px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            text-align: center;
        }
        tbody tr { border-bottom: 1px solid #f0eeff; transition: background .15s; }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: #f5f3ff; }
        tbody td {
            padding: 13px 16px;
            font-size: 13.5px;
            text-align: center;
            color: #2d2d3a;
        }
        .no-col { font-weight: 700; color: #6b7280; }
        .id-col {
            font-family: monospace;
            font-size: 12px;
            background: #ede9fe;
            padding: 3px 8px;
            border-radius: 4px;
            color: #667eea;
        }
        .buku-col { font-weight: 600; text-align: left; }
        .peminjam-col { text-align: left; color: #6b7280; }
        .denda-danger { color: #c0392b; font-weight: 700; }
        .denda-ok { color: #1e7e5e; font-weight: 600; }
        .telat-badge {
            display: inline-block;
            margin-top: 3px;
            font-size: 11px;
            background: #fde8e6;
            color: #c0392b;
            padding: 2px 7px;
            border-radius: 20px;
        }
        .total-row td {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: 700;
            font-size: 14px;
            text-align: right;
            padding: 16px 24px;
        }
        .total-amount {
            color: #e9d5ff;
            font-family: 'DM Serif Display', serif;
            font-size: 18px;
        }
        .empty-row td { padding: 48px; color: #6b7280; font-style: italic; }

        /* FOOTER */
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #6b7280;
            border-top: 1px solid #e0e0f0;
            margin: 0 48px;
        }

        /* PRINT */
        @media print {
            .no-print { display: none !important; }
            body { background: white; }
            .header, thead tr, .total-row td {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="header">
        <div class="header-inner">
            <div>
                <div class="header-label">Si Perpustakaan</div>
                <div class="header-title">Laporan Sirkulasi</div>
                <div class="header-subtitle">Riwayat pengembalian buku &amp; rekapitulasi denda</div>
            </div>
            <div class="header-date">
                Dicetak pada
                <strong>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</strong>
            </div>
        </div>
        <div class="purple-line"></div>
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
        <div class="card">
            <div class="card-label">Total Peminjaman</div>
            <div class="card-value">{{ $laporan->count() }}</div>
            <div class="card-sub">Data dikembalikan</div>
        </div>
        <div class="card">
            <div class="card-label">Total Denda</div>
            <div class="card-value {{ $total_denda > 0 ? 'danger' : 'success' }}">
                Rp {{ number_format($total_denda, 0, ',', '.') }}
            </div>
            <div class="card-sub">Akumulasi keterlambatan</div>
        </div>
        <div class="card">
            <div class="card-label">Tepat Waktu</div>
            <div class="card-value success">{{ $laporan->where('denda', 0)->count() }}</div>
            <div class="card-sub">dari {{ $laporan->count() }} peminjaman</div>
        </div>
    </div>

    <div class="table-wrap">
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

        <div class="footer">
            Dokumen ini digenerate otomatis oleh sistem Si Perpustakaan
            &bull; {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}
        </div>
    </div>

</body>
</html>