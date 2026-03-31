@extends('layout.app')
@section('content')

<style>
    /* ── Variabel sesuai design system yang sudah ada ── */
    :root {
        --navy:       #1a2d6b;
        --navy-dark:  #152356;
        --navy-mid:   #3d56c0;
        --bg:         #f0f4f8;
        --surface:    #ffffff;
        --border:     #e8edf2;
        --text:       #1a2332;
        --text-muted: #5a6b7b;
        --text-light: #8a9bac;
        --radius:     16px;
        --radius-sm:  10px;
        --shadow:     0 2px 12px rgba(0,0,0,0.07);
        --shadow-hover: 0 8px 24px rgba(0,0,0,0.10);
    }

    /* ── PAGE BANNER — sama persis dengan .dashboard-header ── */
    .info-banner {
        background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 100%);
        border-radius: var(--radius);
        padding: 28px 32px;
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 28px rgba(26,45,107,0.28);
    }
    .info-banner::before {
        content: '';
        position: absolute;
        top: -60px; right: -60px;
        width: 220px; height: 220px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
        pointer-events: none;
    }
    .info-banner::after {
        content: '';
        position: absolute;
        bottom: -40px; left: 120px;
        width: 140px; height: 140px;
        background: rgba(255,255,255,0.04);
        border-radius: 50%;
        pointer-events: none;
    }
    .info-banner h2 {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        color: #fff !important;
        font-weight: 800 !important;
        font-size: 22px !important;
        margin: 4px 0 6px !important;
        position: relative; z-index: 1;
    }
    .info-banner p {
        color: rgba(255,255,255,0.75) !important;
        font-size: 13.5px !important;
        margin: 0 !important;
        position: relative; z-index: 1;
    }
    .info-banner .banner-bg-icon {
        font-family: FontAwesome !important;
        font-size: 80px;
        opacity: 0.07;
        position: absolute;
        right: 32px; top: 50%;
        transform: translateY(-50%);
        color: #fff;
        pointer-events: none;
        line-height: 1;
    }

    /* ── STAT STRIP ── */
    .stat-strip {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }
    @media (max-width: 767px) {
        .stat-strip { grid-template-columns: repeat(2, 1fr); }
        .info-banner { padding: 20px !important; }
        .info-banner h2 { font-size: 18px !important; }
    }

    .strip-card {
        background: var(--surface);
        border-radius: var(--radius-sm);
        border: 1px solid var(--border);
        box-shadow: var(--shadow);
        padding: 18px 16px;
        text-align: center;
        transition: transform 0.2s, box-shadow 0.2s;
        position: relative;
        overflow: hidden;
    }
    .strip-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; height: 3px;
        background: linear-gradient(90deg, var(--navy), var(--navy-mid));
    }
    .strip-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-hover);
    }
    .strip-num {
        font-size: 26px;
        font-weight: 800;
        color: var(--navy);
        line-height: 1;
        margin-bottom: 5px;
    }
    .strip-label {
        font-size: 10px;
        font-weight: 700;
        color: var(--text-light);
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }

    /* ── SECTION DIVIDER LABEL ── */
    .section-divider {
        font-size: 10px;
        font-weight: 700;
        color: var(--text-light);
        text-transform: uppercase;
        letter-spacing: 1.5px;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 14px;
        margin-top: 4px;
    }
    .section-divider i { font-family: FontAwesome !important; }
    .section-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--border);
    }

    /* ── SHARED BOX STYLES ── */
    .info-box {
        background: var(--surface);
        border-radius: var(--radius);
        border: 1px solid var(--border);
        box-shadow: var(--shadow);
        overflow: hidden;
        margin-bottom: 24px;
        transition: box-shadow 0.2s;
    }
    .info-box:hover { box-shadow: var(--shadow-hover); }

    .info-box-header {
        background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 100%);
        padding: 14px 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .info-box-header i {
        font-family: FontAwesome !important;
        color: rgba(255,255,255,0.8);
        font-size: 14px;
    }
    .info-box-header h4 {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        color: #fff !important;
        font-size: 14px !important;
        font-weight: 700 !important;
        margin: 0 !important;
    }

    /* ── PROFIL ── */
    .profil-body {
        padding: 22px;
        display: flex;
        align-items: flex-start;
        gap: 20px;
    }
    @media (max-width: 600px) { .profil-body { flex-direction: column; } }

    .profil-emblem {
        width: 66px; height: 66px; min-width: 66px;
        background: #eef1fb;
        border: 1.5px solid var(--border);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
    }
    .profil-text h5 {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        font-size: 15px !important;
        font-weight: 800 !important;
        color: var(--navy) !important;
        margin: 0 0 8px !important;
    }
    .profil-text p {
        font-size: 13.5px !important;
        color: var(--text-muted) !important;
        line-height: 1.75 !important;
        margin: 0 !important;
    }

    /* ── JAM OPERASIONAL ── */
    .jam-body { padding: 18px 20px; }

    .jam-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 15px;
        border-radius: var(--radius-sm);
        margin-bottom: 10px;
        font-size: 13.5px;
        font-weight: 600;
        transition: transform 0.15s;
    }
    .jam-row:hover { transform: translateX(4px); }
    .jam-row:last-child { margin-bottom: 0; }
    .jam-row.buka  { background: #eef1fb; border-left: 3px solid var(--navy); color: var(--navy); }
    .jam-row.tutup { background: #fff1f1; border-left: 3px solid #dc2626; color: #991b1b; }

    .jam-day { display: flex; align-items: center; gap: 10px; }
    .jam-day i { font-family: FontAwesome !important; font-size: 14px; }

    .jam-badge {
        font-size: 11px;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 20px;
    }
    .jam-badge.open  { background: var(--navy); color: #fff; }
    .jam-badge.close { background: #dc2626; color: #fff; }

    /* ── TATA TERTIB ── */
    .tertib-body { padding: 18px 20px; }

    .tertib-item {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        padding: 13px 15px;
        border-radius: var(--radius-sm);
        background: #f7f9fc;
        border: 1px solid var(--border);
        margin-bottom: 10px;
        transition: background 0.15s, border-color 0.15s, transform 0.15s, box-shadow 0.15s;
    }
    .tertib-item:hover {
        background: #fff;
        border-color: var(--navy-mid);
        box-shadow: 0 4px 14px rgba(26,45,107,0.08);
        transform: translateY(-1px);
    }
    .tertib-item:last-child { margin-bottom: 0; }

    .tertib-num {
        width: 26px; height: 26px; min-width: 26px;
        background: var(--navy);
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 800;
        color: #fff;
        margin-top: 1px;
    }
    .tertib-body-text h5 {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        font-size: 13.5px !important;
        font-weight: 700 !important;
        color: var(--text) !important;
        margin: 0 0 2px !important;
    }
    .tertib-body-text p {
        font-size: 12px !important;
        color: var(--text-light) !important;
        margin: 0 !important;
        line-height: 1.5 !important;
    }

    /* ── KONTAK ── */
    .kontak-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
    }
    @media (max-width: 767px) {
        .kontak-grid { grid-template-columns: 1fr; }
        .kontak-cell { border-right: none !important; border-bottom: 1px solid var(--border) !important; }
        .kontak-cell:last-child { border-bottom: none !important; }
    }

    .kontak-cell {
        padding: 18px 20px;
        border-right: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 14px;
        transition: background 0.15s;
    }
    .kontak-cell:hover { background: #f7f9fc; }
    .kontak-cell:last-child { border-right: none; }

    .kontak-icon {
        width: 38px; height: 38px; min-width: 38px;
        background: #eef1fb;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--navy);
        font-size: 15px;
    }
    .kontak-icon i { font-family: FontAwesome !important; }
    .kontak-cell small {
        display: block;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: var(--text-light);
        margin-bottom: 2px;
    }
    .kontak-cell span {
        font-size: 13px;
        font-weight: 600;
        color: var(--text);
    }
</style>

<section class="content">
    <div class="container-fluid">

        
        <div class="info-banner">
            <h2><i class="fa fa-thumb-tack" style="font-family:FontAwesome!important;margin-right:8px;opacity:.85;"></i> Informasi Perpustakaan</h2>
            <p>SMKN 1 Cirebon — Pusat Literasi dan Informasi Sekolah</p>
            <span class="banner-bg-icon fa fa-book"></span>
        </div>

       
        <div class="stat-strip">
            <div class="strip-card">
                <div class="strip-num">5.000+</div>
                <div class="strip-label">Koleksi Buku</div>
            </div>
            <div class="strip-card">
                <div class="strip-num">35 Jam</div>
                <div class="strip-label">Buka / Minggu</div>
            </div>
            <div class="strip-card">
                <div class="strip-num">1 Lt.</div>
                <div class="strip-label">Ruang Baca</div>
            </div>
            <div class="strip-card">
                <div class="strip-num">Baca</div>
                <div class="strip-label">Gratis</div>
            </div>
        </div>

        
        <div class="section-divider"><i class="fa fa-building-o"></i> Tentang Perpustakaan</div>
        <div class="info-box">
            <div class="info-box-header">
                <i class="fa fa-info-circle"></i>
                <h4>Profil Perpustakaan</h4>
            </div>
            <div class="profil-body">
                <div class="profil-emblem">📚</div>
                <div class="profil-text">
                    <h5>Perpustakaan SMKN 1 Cirebon</h5>
                    <p>
                        Merupakan pusat literasi yang mendukung kegiatan belajar mengajar siswa dan guru
                        dengan menyediakan berbagai koleksi buku dan referensi. Kami berkomitmen menciptakan
                        lingkungan belajar yang nyaman, inspiratif, dan mudah diakses oleh seluruh warga sekolah.
                        Tersedia ruang baca yang kondusif, koleksi buku yang terus diperbarui, serta layanan
                        peminjaman yang mudah dan cepat.
                    </p>
                </div>
            </div>
        </div>

        
        <div class="section-divider"><i class="fa fa-list-ul"></i> Layanan &amp; Ketentuan</div>
        <div class="row">

         
            <div class="col-md-5">
                <div class="info-box">
                    <div class="info-box-header">
                        <i class="fa fa-clock-o"></i>
                        <h4>Jam Operasional</h4>
                    </div>
                    <div class="jam-body">
                        <div class="jam-row buka">
                            <div class="jam-day">
                                <i class="fa fa-calendar-check-o"></i> Senin – Jumat
                            </div>
                            <span class="jam-badge open">08.00 – 15.00</span>
                        </div>
                        <div class="jam-row tutup">
                            <div class="jam-day">
                                <i class="fa fa-calendar-times-o"></i> Sabtu – Minggu
                            </div>
                            <span class="jam-badge close">Tutup</span>
                        </div>
                        <div class="jam-row tutup">
                            <div class="jam-day">
                                <i class="fa fa-calendar-times-o"></i> Hari Libur Nasional
                            </div>
                            <span class="jam-badge close">Tutup</span>
                        </div>
                    </div>
                </div>
            </div>

           
            <div class="col-md-7">
                <div class="info-box">
                    <div class="info-box-header">
                        <i class="fa fa-check-circle"></i>
                        <h4>Tata Tertib</h4>
                    </div>
                    <div class="tertib-body">
                        <div class="tertib-item">
                            <div class="tertib-num">1</div>
                            <div class="tertib-body-text">
                                <h5>Menjaga ketenangan di ruang perpustakaan</h5>
                                <p>Agar suasana tetap kondusif dan nyaman untuk semua pengunjung.</p>
                            </div>
                        </div>
                        <div class="tertib-item">
                            <div class="tertib-num">2</div>
                            <div class="tertib-body-text">
                                <h5>Dilarang makan dan minum di dalam ruangan</h5>
                                <p>Untuk menjaga kebersihan ruangan dan kondisi buku koleksi.</p>
                            </div>
                        </div>
                        <div class="tertib-item">
                            <div class="tertib-num">3</div>
                            <div class="tertib-body-text">
                                <h5>Menjaga kebersihan dan kerapian buku</h5>
                                <p>Kembalikan buku ke rak dengan rapi setelah selesai digunakan.</p>
                            </div>
                        </div>
                        <div class="tertib-item">
                            <div class="tertib-num">4</div>
                            <div class="tertib-body-text">
                                <h5>Menunjukkan kartu pelajar saat peminjaman</h5>
                                <p>Wajib membawa kartu identitas sekolah untuk proses peminjaman.</p>
                            </div>
                        </div>
                        <div class="tertib-item">
                            <div class="tertib-num">5</div>
                            <div class="tertib-body-text">
                                <h5>Batas peminjaman maksimal 7 hari</h5>
                                <p>Buku wajib dikembalikan tepat waktu agar dapat dimanfaatkan siswa lain.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection