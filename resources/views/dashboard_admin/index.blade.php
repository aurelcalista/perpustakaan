@extends('layout.main')

@section('content')

<div class="dash-wrap">

  {{-- ── HEADER BANNER ── --}}
  <div class="dh-banner">
    <div class="dh-banner-inner">
      <div>
        <p class="dh-greeting" id="greeting">🌅 Selamat Pagi</p>
        <h2 class="dh-title">Admin Perpustakaan</h2>
        <p class="dh-sub">Berikut ringkasan sistem perpustakaan hari ini.</p>
      </div>
      <div class="dh-right">
        <div class="dh-date" id="hdate">—</div>
        <div class="dh-clock" id="clock">00:00:00</div>
      </div>
    </div>
  </div>

  {{-- ── STAT CARDS ── --}}
  <div class="row dh-stat-row">
    <div class="col-xs-6 col-sm-3">
      <div class="dh-stat sc-blue" onclick="sendPrompt('Tampilkan daftar semua buku di perpustakaan')">
        <div class="dh-stat-top">
          <div class="dh-stat-icon si-blue">📚</div>
          <div>
            <div class="dh-stat-num sn-blue" id="n-buku">0</div>
            <div class="dh-stat-lbl">Total Buku</div>
          </div>
        </div>
        <div class="dh-stat-footer">
          <span class="dh-stat-link sl-blue">Lihat Detail →</span>
        </div>
      </div>
    </div>
    <div class="col-xs-6 col-sm-3">
      <div class="dh-stat sc-teal" onclick="sendPrompt('Tampilkan daftar semua anggota perpustakaan')">
        <div class="dh-stat-top">
          <div class="dh-stat-icon si-teal">👥</div>
          <div>
            <div class="dh-stat-num sn-teal" id="n-agt">0</div>
            <div class="dh-stat-lbl">Total Anggota</div>
          </div>
        </div>
        <div class="dh-stat-footer">
          <span class="dh-stat-link sl-teal">Lihat Detail →</span>
        </div>
      </div>
    </div>
    <div class="col-xs-6 col-sm-3">
      <div class="dh-stat sc-amber" onclick="sendPrompt('Tampilkan daftar peminjaman aktif')">
        <div class="dh-stat-top">
          <div class="dh-stat-icon si-amber">🔄</div>
          <div>
            <div class="dh-stat-num sn-amber" id="n-pin">0</div>
            <div class="dh-stat-lbl">Buku Dipinjam</div>
          </div>
        </div>
        <div class="dh-stat-footer">
          <span class="dh-stat-link sl-amber">Lihat Detail →</span>
        </div>
      </div>
    </div>
    <div class="col-xs-6 col-sm-3">
      <div class="dh-stat sc-green" onclick="sendPrompt('Bagaimana cara meningkatkan koleksi buku tersedia?')">
        <div class="dh-stat-top">
          <div class="dh-stat-icon si-green">✅</div>
          <div>
            <div class="dh-stat-num sn-green" id="n-avail">0</div>
            <div class="dh-stat-lbl">Stok Tersedia</div>
          </div>
        </div>
        <div class="dh-stat-footer">
          <span class="dh-stat-link sl-green">Lihat Detail →</span>
        </div>
      </div>
    </div>
  </div>

  {{-- ── BOTTOM GRID ── --}}
  <div class="row">

    {{-- KOLOM KIRI --}}
    <div class="col-md-8">

      {{-- Chart Card --}}
      <div class="dh-card" style="margin-bottom:16px">
        <div class="dh-card-header">
          <span>📊 Statistik Peminjaman {{ date('Y') }}</span>
        </div>
        <div class="dh-card-body">
          <div class="dh-chart-tabs">
            <button class="dh-tab active" onclick="switchChart('bar',this)">Bulanan</button>
            <button class="dh-tab" onclick="switchChart('line',this)">Tren</button>
            <button class="dh-tab" onclick="switchChart('doughnut',this)">Kategori</button>
          </div>
          <div style="position:relative;height:220px">
            <canvas id="mainChart"></canvas>
          </div>
        </div>
      </div>

      {{-- Recent Activity --}}
      <div class="dh-card">
        <div class="dh-card-header">
          <span>📋 Aktivitas Terbaru</span>
        </div>
        <div class="dh-card-body" style="padding:8px 20px 16px">

          @forelse($aktivitas as $i => $item)
            @php
              $colors = [
                'linear-gradient(135deg,#1a2d6b,#3d56c0)',
                'linear-gradient(135deg,#059669,#10b981)',
                'linear-gradient(135deg,#d97706,#f59e0b)',
                'linear-gradient(135deg,#0891b2,#06b6d4)',
                'linear-gradient(135deg,#7c3aed,#a78bfa)',
              ];
              $icons  = ['📖','📗','📙','📘','📕'];
              $color  = $colors[$i % count($colors)];
              $icon   = $icons[$i % count($icons)];
              $isDipinjam = in_array($item->status, ['dipinjam','pending']);
            @endphp
            <div class="dh-recent" style="{{ $loop->last ? 'border-bottom:none' : '' }}">
              <div class="dh-book-cover" style="background:{{ $color }}">{{ $icon }}</div>
              <div class="dh-ri-info">
                <div class="dh-ri-title">{{ $item->judul_buku }}</div>
                <div class="dh-ri-sub">
                  {{ $item->nama_anggota ?? 'Tidak diketahui' }}
                  · {{ $item->waktu_relatif }}
                </div>
              </div>
              <span class="dh-badge {{ $isDipinjam ? 'badge-out' : 'badge-in' }}">
                {{ $isDipinjam ? 'Dipinjam' : 'Dikembalikan' }}
              </span>
            </div>
          @empty
            <div style="padding:20px;text-align:center;color:#8a9bac">
              Belum ada aktivitas peminjaman.
            </div>
          @endforelse

        </div>
      </div>

    </div>{{-- /col-md-8 --}}

    {{-- KOLOM KANAN --}}
    <div class="col-md-4">

      {{-- Ringkasan Koleksi --}}
      <div class="dh-card" style="margin-bottom:16px">
        <div class="dh-card-header">
          <span>📈 Ringkasan Koleksi</span>
        </div>
        <div class="dh-card-body">

          <div class="dh-mini">
            <div class="dh-mini-dot" style="background:#1a2d6b"></div>
            <div style="flex:1">
              <div class="dh-mini-row">
                <span class="dh-mini-lbl">Total Buku</span>
                <span class="dh-mini-val" id="ms-buku">{{ $totalBuku }}</span>
              </div>
              <div class="dh-bar-wrap"><div class="dh-bar" id="bar-buku" style="background:#1a2d6b;width:0%"></div></div>
            </div>
          </div>

          <div class="dh-mini">
            <div class="dh-mini-dot" style="background:#0891b2"></div>
            <div style="flex:1">
              <div class="dh-mini-row">
                <span class="dh-mini-lbl">Anggota Aktif</span>
                <span class="dh-mini-val" id="ms-agt">{{ $totalAnggota }}</span>
              </div>
              <div class="dh-bar-wrap"><div class="dh-bar" id="bar-agt" style="background:#0891b2;width:0%"></div></div>
            </div>
          </div>

          <div class="dh-mini">
            <div class="dh-mini-dot" style="background:#d97706"></div>
            <div style="flex:1">
              <div class="dh-mini-row">
                <span class="dh-mini-lbl">Sedang Dipinjam</span>
                <span class="dh-mini-val" id="ms-pin">{{ $bukuDipinjam }}</span>
              </div>
              <div class="dh-bar-wrap"><div class="dh-bar" id="bar-pin" style="background:#d97706;width:0%"></div></div>
            </div>
          </div>

          <div class="dh-mini" style="border-bottom:none;padding-bottom:0">
            <div class="dh-mini-dot" style="background:#059669"></div>
            <div style="flex:1">
              <div class="dh-mini-row">
                <span class="dh-mini-lbl">Stok Tersedia</span>
                <span class="dh-mini-val" id="ms-avail">{{ $bukuTersedia }}</span>
              </div>
              <div class="dh-bar-wrap"><div class="dh-bar" id="bar-avail" style="background:#059669;width:0%"></div></div>
            </div>
          </div>

        </div>
      </div>

      {{-- Aksi Cepat --}}
<div class="dh-card">
  <div class="dh-card-header">
    <span>⚡ Aksi Cepat</span>
  </div>

  <div class="dh-card-body">
    
    <a href="{{ route('admin.buku.create') }}" class="dh-qa">
      <span class="dh-qa-icon">➕</span> Tambah Buku Baru
    </a>

    <a href="{{ route('admin.agt.index') }}" class="dh-qa dh-qa-teal">
      <span class="dh-qa-icon">👤</span> Lihat Anggota
    </a>

    <a href="{{ route('admin.laporan.index') }}" class="dh-qa dh-qa-purple">
      <span class="dh-qa-icon">📊</span> Laporan Bulanan
    </a>

  </div>
</div>

    </div>{{-- /col-md-4 --}}

  </div>{{-- /row --}}

</div>{{-- /dash-wrap --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
<script>
// ── DATA DARI CONTROLLER (PHP → JS) ─────────────────────────────
const DATA = {
  buku  : {{ $totalBuku }},
  agt   : {{ $totalAnggota }},
  pin   : {{ $bukuDipinjam }},
  avail : {{ $bukuTersedia }},
};

const pinjamBulanan  = @json($dataPinjam);
const kembaliБулanan = @json($dataKembali);
const labelKategori  = @json($labelKategori);
const jumlahKategori = @json($jumlahKategori);

// ── CLOCK ────────────────────────────────────────────────────────
function tick(){
  const n=new Date(), h=n.getHours(), m=n.getMinutes(), s=n.getSeconds();
  document.getElementById('clock').textContent = [h,m,s].map(x=>String(x).padStart(2,'0')).join(':');
  const g = h<5?'🌙 Selamat Malam': h<12?'🌅 Selamat Pagi': h<15?'☀️ Selamat Siang': h<18?'🌤️ Selamat Sore':'🌙 Selamat Malam';
  document.getElementById('greeting').textContent = g;
  const days   = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
  const months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
  document.getElementById('hdate').textContent = `${days[n.getDay()]}, ${n.getDate()} ${months[n.getMonth()]} ${n.getFullYear()}`;
}
tick(); setInterval(tick, 1000);

// ── COUNT UP ─────────────────────────────────────────────────────
function countTo(id, target, dur=1200){
  const el = document.getElementById(id); let s=0;
  const step = Math.max(1, Math.ceil(target / (dur/16)));
  const t = setInterval(()=>{ s=Math.min(s+step,target); el.textContent=s; if(s>=target) clearInterval(t); }, 16);
}
setTimeout(()=>{
  countTo('n-buku',  DATA.buku);
  countTo('n-agt',   DATA.agt);
  countTo('n-pin',   DATA.pin);
  countTo('n-avail', DATA.avail);
}, 300);

// ── PROGRESS BARS ────────────────────────────────────────────────
setTimeout(()=>{
  const max = Math.max(DATA.buku, 1);
  document.getElementById('bar-buku').style.width  = '100%';
  document.getElementById('bar-agt').style.width   = Math.round(DATA.agt   / max * 100) + '%';
  document.getElementById('bar-pin').style.width   = Math.round(DATA.pin   / max * 100) + '%';
  document.getElementById('bar-avail').style.width = Math.round(DATA.avail / max * 100) + '%';
}, 500);

// ── CHART ────────────────────────────────────────────────────────
const gridC  = 'rgba(0,0,0,.06)';
const labelC = '#5a6b7b';
const bulanLabels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agt','Sep','Okt','Nov','Des'];

// Warna doughnut — fallback jika kategori < 5
const doughnutColors = ['#1a2d6b','#0891b2','#059669','#d97706','#8a9bac','#7c3aed','#dc2626'];

const chartData = {
  bar: {
    labels: bulanLabels,
    datasets: [
      { label:'Dipinjam',     data: pinjamBulanan,  backgroundColor:'rgba(26,45,107,.75)', borderRadius:6, borderSkipped:false },
      { label:'Dikembalikan', data: kembaliБулanan, backgroundColor:'rgba(8,145,178,.65)',  borderRadius:6, borderSkipped:false }
    ]
  },
  line: {
    labels: bulanLabels,
    datasets: [
      { label:'Peminjaman',   data: pinjamBulanan,  borderColor:'#1a2d6b', backgroundColor:'rgba(26,45,107,.10)', fill:true, tension:.4, pointRadius:4, pointBackgroundColor:'#1a2d6b', borderWidth:2 },
      { label:'Pengembalian', data: kembaliБулanan, borderColor:'#0891b2', backgroundColor:'rgba(8,145,178,.08)',  fill:true, tension:.4, pointRadius:4, pointBackgroundColor:'#0891b2', borderWidth:2 }
    ]
  },
  doughnut: {
    labels: labelKategori.length ? labelKategori : ['Belum ada data'],
    datasets: [{
      data: jumlahKategori.length ? jumlahKategori : [1],
      backgroundColor: doughnutColors.slice(0, Math.max(labelKategori.length, 1)),
      borderWidth: 0,
      hoverOffset: 6
    }]
  }
};

const opts = (type) => ({
  responsive: true, maintainAspectRatio: false,
  plugins: {
    legend: { display: type==='doughnut', position:'bottom', labels:{ boxWidth:10, padding:14, font:{size:12}, color:labelC } },
    tooltip: { backgroundColor:'#fff', titleColor:'#1a2332', bodyColor:labelC, borderColor:'rgba(0,0,0,.08)', borderWidth:1, cornerRadius:8, padding:10 }
  },
  scales: type==='doughnut' ? {} : {
    x: { grid:{color:gridC,drawBorder:false}, ticks:{color:labelC,font:{size:11}} },
    y: { grid:{color:gridC,drawBorder:false}, ticks:{color:labelC,font:{size:11}}, beginAtZero:true }
  }
});

let chart = new Chart(document.getElementById('mainChart'), { type:'bar', data:chartData.bar, options:opts('bar') });

function switchChart(type, btn){
  document.querySelectorAll('.dh-tab').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  chart.destroy();
  chart = new Chart(document.getElementById('mainChart'), { type, data:chartData[type], options:opts(type) });
}
</script>

@endsection