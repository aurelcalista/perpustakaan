@extends('layout.app')
@section('content')

<style>
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

    /* ── BANNER ── */
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

    /* ── SECTION DIVIDER ── */
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
    }
    .section-divider i { font-family: FontAwesome !important; }
    .section-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--border);
    }

    /* ── SHARED BOX ── */
    .info-box {
        background: var(--surface);
        border-radius: var(--radius);
        border: 1px solid var(--border);
        box-shadow: var(--shadow);
        overflow: hidden;
        margin-bottom: 24px;
        transition: box-shadow 0.2s;
        height: calc(100% - 24px);
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
    .info-box-body { padding: 20px; }

    /* ── STEP ITEMS ── */
    .step-item {
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
    .step-item:hover {
        background: #fff;
        border-color: var(--navy-mid);
        box-shadow: 0 4px 14px rgba(26,45,107,0.08);
        transform: translateY(-1px);
    }
    .step-item:last-child { margin-bottom: 0; }

    .step-num {
        width: 26px; height: 26px; min-width: 26px;
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 800;
        color: #fff;
        margin-top: 1px;
    }
    .step-num.green  { background: #059669; }
    .step-num.blue   { background: #0891b2; }

    .step-text h6 {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        font-size: 13.5px !important;
        font-weight: 700 !important;
        color: var(--text) !important;
        margin: 0 0 2px !important;
    }
    .step-text p {
        font-size: 12px !important;
        color: var(--text-light) !important;
        margin: 0 !important;
        line-height: 1.5 !important;
    }

    /* ── DENDA ALERT ── */
    .denda-box {
        background: var(--surface);
        border-radius: var(--radius);
        border: 1px solid var(--border);
        border-left: 4px solid #dc2626;
        box-shadow: var(--shadow);
        overflow: hidden;
        margin-bottom: 24px;
        transition: box-shadow 0.2s;
    }
    .denda-box:hover { box-shadow: var(--shadow-hover); }

    .denda-inner {
        padding: 18px 22px;
        display: flex;
        align-items: flex-start;
        gap: 16px;
    }
    .denda-icon-wrap {
        width: 42px; height: 42px; min-width: 42px;
        background: #fff1f1;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #dc2626;
        font-size: 18px;
    }
    .denda-icon-wrap i { font-family: FontAwesome !important; }
    .denda-text h5 {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        font-size: 14px !important;
        font-weight: 800 !important;
        color: #991b1b !important;
        margin: 0 0 5px !important;
    }
    .denda-text p {
        font-size: 13px !important;
        color: var(--text-muted) !important;
        margin: 0 !important;
        line-height: 1.6 !important;
    }
    .denda-badge {
        display: inline-block;
        background: #dc2626;
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 20px;
        margin-left: 4px;
    }

    /* ── TIPS GRID ── */
    .tips-box {
        background: var(--surface);
        border-radius: var(--radius);
        border: 1px solid var(--border);
        border-top: 3px solid #d97706;
        box-shadow: var(--shadow);
        overflow: hidden;
        transition: box-shadow 0.2s;
    }
    .tips-box:hover { box-shadow: var(--shadow-hover); }

    .tips-box-header {
        padding: 14px 20px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 8px;
        background: #fffbeb;
    }
    .tips-box-header i { font-family: FontAwesome !important; color: #d97706; font-size: 15px; }
    .tips-box-header h4 {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        font-size: 14px !important;
        font-weight: 700 !important;
        color: #92400e !important;
        margin: 0 !important;
    }

    .tips-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0;
    }
    @media (max-width: 767px) { .tips-grid { grid-template-columns: 1fr; } }

    .tip-cell {
        padding: 16px 20px;
        border-right: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: flex-start;
        gap: 13px;
        transition: background 0.15s;
    }
    .tip-cell:hover { background: #f7f9fc; }
    .tip-cell:nth-child(2)  { border-right: none; }
    .tip-cell:nth-child(3)  { border-bottom: none; }
    .tip-cell:nth-child(4)  { border-right: none; border-bottom: none; }
    @media (max-width: 767px) {
        .tip-cell { border-right: none !important; }
        .tip-cell:last-child { border-bottom: none !important; }
    }

    .tip-icon {
        width: 34px; height: 34px; min-width: 34px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        margin-top: 1px;
    }
    .tip-icon i { font-family: FontAwesome !important; }
    .tip-icon.green  { background: #d1fae5; color: #059669; }
    .tip-icon.navy   { background: #eef1fb; color: var(--navy); }
    .tip-icon.blue   { background: #e0f2fe; color: #0891b2; }
    .tip-icon.red    { background: #fee2e2; color: #dc2626; }

    .tip-text h6 {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        font-size: 13px !important;
        font-weight: 700 !important;
        color: var(--text) !important;
        margin: 0 0 2px !important;
    }
    .tip-text p {
        font-size: 12px !important;
        color: var(--text-light) !important;
        margin: 0 !important;
    }

    @media (max-width: 767px) {
        .info-banner { padding: 20px !important; }
        .info-banner h2 { font-size: 18px !important; }
    }
</style>


<section class="content">
    <div class="container-fluid">

        
        <div class="info-banner">
            <h2><i class="fa fa-book" style="font-family:FontAwesome!important;margin-right:8px;opacity:.85;"></i> Panduan Penggunaan Website</h2>
            <p>Gampang kok! Ikutin langkah-langkah di bawah ini 👇</p>
            <span class="banner-bg-icon fa fa-graduation-cap"></span>
        </div>

       
        <div class="section-divider"><i class="fa fa-exchange"></i> Cara Penggunaan</div>
        <div class="row">

           
            <div class="col-md-6">
                <div class="info-box">
                    <div class="info-box-header">
                        <i class="fa fa-book"></i>
                        <h4>Mau Pinjam Buku?</h4>
                    </div>
                    <div class="info-box-body">
                        <div class="step-item">
                            <div class="step-num green">1</div>
                            <div class="step-text">
                                <h6>Klik menu "Koleksi"</h6>
                                <p>Ada di bagian atas website</p>
                            </div>
                        </div>
                        <div class="step-item">
                            <div class="step-num green">2</div>
                            <div class="step-text">
                                <h6>Klik tombol "Pinjam Buku"</h6>
                                <p>⚠️ Harus login dulu ya sebelum bisa pinjam!</p>
                            </div>
                        </div>
                        <div class="step-item">
                            <div class="step-num green">3</div>
                            <div class="step-text">
                                <h6>Tunggu admin approve permintaan</h6>
                                <p>Buku bisa dipinjam kalau statusnya sudah <strong style="color:#059669;">Disetujui</strong></p>
                            </div>
                        </div>
                        <div class="step-item">
                            <div class="step-num green">4</div>
                            <div class="step-text">
                                <h6>Selesai! ✅</h6>
                                <p>Catat tanggal harus kembaliin bukunya ya!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

           
            <div class="col-md-6">
                <div class="info-box">
                    <div class="info-box-header">
                        <i class="fa fa-undo"></i>
                        <h4>Mau Kembalikan Buku?</h4>
                    </div>
                    <div class="info-box-body">
                        <div class="step-item">
                            <div class="step-num blue">1</div>
                            <div class="step-text">
                                <h6>Datang ke perpustakaan</h6>
                                <p>Bawa buku yang mau dikembalikan</p>
                            </div>
                        </div>
                        <div class="step-item">
                            <div class="step-num blue">2</div>
                            <div class="step-text">
                                <h6>Temui petugas perpustakaan</h6>
                                <p>Konfirmasi pengembalian buku ke petugas langsung</p>
                            </div>
                        </div>
                        <div class="step-item">
                            <div class="step-num blue">3</div>
                            <div class="step-text">
                                <h6>Tunggu admin update status</h6>
                                <p>Admin akan mengganti status buku menjadi <strong style="color:#0891b2;">Dikembalikan</strong></p>
                            </div>
                        </div>
                        <div class="step-item">
                            <div class="step-num blue">4</div>
                            <div class="step-text">
                                <h6>Selesai! ✅</h6>
                                <p>Jangan telat ya — denda ngitung otomatis per hari 😅</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="section-divider"><i class="fa fa-exclamation-triangle"></i> Perhatian</div>
        <div class="denda-box">
            <div class="denda-inner">
                <div class="denda-icon-wrap">
                    <i class="fa fa-exclamation-triangle"></i>
                </div>
                <div class="denda-text">
                    <h5>⚠️ Hati-hati Kena Denda!</h5>
                    <p>
                        Kalau telat kembaliin buku, sistem otomatis ngitung denda
                        <span class="denda-badge">Rp 500 / hari</span>
                        — jadi jangan sampai lupa tanggal kembalinya ya!
                    </p>
                </div>
            </div>
        </div>

       
        <div class="section-divider"><i class="fa fa-lightbulb-o"></i> Tips Penting</div>
        <div class="tips-box">
            <div class="tips-box-header">
                <i class="fa fa-lightbulb-o"></i>
                <h4>Hal yang Perlu Diingat</h4>
            </div>
            <div class="tips-grid">
                <div class="tip-cell">
                    <div class="tip-icon green"><i class="fa fa-check"></i></div>
                    <div class="tip-text">
                        <h6>Login menjadi anggota untuk meminjam buku</h6>
                        <p>Login dengan data kamu yang asli ya!</p>
                    </div>
                </div>
                <div class="tip-cell">
                    <div class="tip-icon navy"><i class="fa fa-calendar"></i></div>
                    <div class="tip-text">
                        <h6>Inget tanggal kembali</h6>
                        <p>Biar ga kena denda</p>
                    </div>
                </div>
                <div class="tip-cell">
                    <div class="tip-icon blue"><i class="fa fa-book"></i></div>
                    <div class="tip-text">
                        <h6>Maksimal 3 buku</h6>
                        <p>Per orang ya!</p>
                    </div>
                </div>
                <div class="tip-cell">
                    <div class="tip-icon red"><i class="fa fa-clock-o"></i></div>
                    <div class="tip-text">
                        <h6>Waktu pinjam: 3 hari</h6>
                        <p>Dari tanggal pinjam</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection