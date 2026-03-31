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
            <div class="dh-stat-lbl">Buku Tersedia</div>
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
          <span>📊 Statistik Peminjaman</span>
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
          <div class="dh-recent">
            <div class="dh-book-cover" style="background:linear-gradient(135deg,#1a2d6b,#3d56c0)">📖</div>
            <div class="dh-ri-info">
              <div class="dh-ri-title">Laskar Pelangi</div>
              <div class="dh-ri-sub">Budi Santoso · 2 jam lalu</div>
            </div>
            <span class="dh-badge badge-out">Dipinjam</span>
          </div>
          <div class="dh-recent">
            <div class="dh-book-cover" style="background:linear-gradient(135deg,#059669,#10b981)">📗</div>
            <div class="dh-ri-info">
              <div class="dh-ri-title">Algoritma &amp; Pemrograman</div>
              <div class="dh-ri-sub">Siti Rahayu · 4 jam lalu</div>
            </div>
            <span class="dh-badge badge-in">Dikembalikan</span>
          </div>
          <div class="dh-recent">
            <div class="dh-book-cover" style="background:linear-gradient(135deg,#d97706,#f59e0b)">📙</div>
            <div class="dh-ri-info">
              <div class="dh-ri-title">Bumi Manusia</div>
              <div class="dh-ri-sub">Ahmad Fauzi · kemarin</div>
            </div>
            <span class="dh-badge badge-out">Dipinjam</span>
          </div>
          <div class="dh-recent" style="border-bottom:none">
            <div class="dh-book-cover" style="background:linear-gradient(135deg,#0891b2,#06b6d4)">📘</div>
            <div class="dh-ri-info">
              <div class="dh-ri-title">Fisika Dasar Vol. 2</div>
              <div class="dh-ri-sub">Dewi Lestari · kemarin</div>
            </div>
            <span class="dh-badge badge-in">Dikembalikan</span>
          </div>
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
                <span class="dh-mini-val" id="ms-buku">127</span>
              </div>
              <div class="dh-bar-wrap"><div class="dh-bar" id="bar-buku" style="background:#1a2d6b;width:0%"></div></div>
            </div>
          </div>

          <div class="dh-mini">
            <div class="dh-mini-dot" style="background:#0891b2"></div>
            <div style="flex:1">
              <div class="dh-mini-row">
                <span class="dh-mini-lbl">Anggota Aktif</span>
                <span class="dh-mini-val" id="ms-agt">58</span>
              </div>
              <div class="dh-bar-wrap"><div class="dh-bar" id="bar-agt" style="background:#0891b2;width:0%"></div></div>
            </div>
          </div>

          <div class="dh-mini">
            <div class="dh-mini-dot" style="background:#d97706"></div>
            <div style="flex:1">
              <div class="dh-mini-row">
                <span class="dh-mini-lbl">Sedang Dipinjam</span>
                <span class="dh-mini-val" id="ms-pin">34</span>
              </div>
              <div class="dh-bar-wrap"><div class="dh-bar" id="bar-pin" style="background:#d97706;width:0%"></div></div>
            </div>
          </div>

          <div class="dh-mini" style="border-bottom:none;padding-bottom:0">
            <div class="dh-mini-dot" style="background:#059669"></div>
            <div style="flex:1">
              <div class="dh-mini-row">
                <span class="dh-mini-lbl">Buku Tersedia</span>
                <span class="dh-mini-val" id="ms-avail">93</span>
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
          <button class="dh-qa" onclick="sendPrompt('Bagaimana cara menambahkan buku baru ke sistem perpustakaan?')">
            <span class="dh-qa-icon">➕</span> Tambah Buku Baru
          </button>
          <button class="dh-qa dh-qa-teal" onclick="sendPrompt('Bagaimana cara mendaftarkan anggota baru perpustakaan?')">
            <span class="dh-qa-icon">👤</span> Daftarkan Anggota
          </button>
          <button class="dh-qa dh-qa-purple" onclick="sendPrompt('Tampilkan laporan peminjaman bulan ini')">
            <span class="dh-qa-icon">📊</span> Laporan Bulanan
          </button>
        </div>
      </div>

    </div>{{-- /col-md-4 --}}

  </div>{{-- /row --}}

</div>{{-- /dash-wrap --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
<script>
const DATA = { buku:127, agt:58, pin:34 };
DATA.avail = DATA.buku - DATA.pin;

// ── CLOCK ──
function tick(){
  const n=new Date(), h=n.getHours(), m=n.getMinutes(), s=n.getSeconds();
  document.getElementById('clock').textContent = [h,m,s].map(x=>String(x).padStart(2,'0')).join(':');
  const g = h<5?'🌙 Selamat Malam': h<12?'🌅 Selamat Pagi': h<15?'☀️ Selamat Siang': h<18?'🌤️ Selamat Sore':'🌙 Selamat Malam';
  document.getElementById('greeting').textContent = g;
  const days    = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
  const months  = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
  document.getElementById('hdate').textContent = `${days[n.getDay()]}, ${n.getDate()} ${months[n.getMonth()]} ${n.getFullYear()}`;
}
tick(); setInterval(tick, 1000);

// ── COUNT UP ──
function countTo(id, target, dur=1200){
  const el = document.getElementById(id); let s=0;
  const step = Math.ceil(target / (dur/16));
  const t = setInterval(()=>{ s=Math.min(s+step,target); el.textContent=s; if(s>=target) clearInterval(t); }, 16);
}
setTimeout(()=>{
  countTo('n-buku', DATA.buku); countTo('n-agt', DATA.agt);
  countTo('n-pin', DATA.pin);   countTo('n-avail', DATA.avail);
}, 300);

// ── PROGRESS BARS ──
setTimeout(()=>{
  document.getElementById('bar-buku').style.width  = '100%';
  document.getElementById('bar-agt').style.width   = Math.round(DATA.agt/DATA.buku*100)+'%';
  document.getElementById('bar-pin').style.width   = Math.round(DATA.pin/DATA.buku*100)+'%';
  document.getElementById('bar-avail').style.width = Math.round(DATA.avail/DATA.buku*100)+'%';
}, 500);

// ── CHART ──
const gridC  = 'rgba(0,0,0,.06)';
const labelC = '#5a6b7b';

const chartData = {
  bar: {
    labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agt','Sep','Okt','Nov','Des'],
    datasets: [
      { label:'Dipinjam',     data:[22,31,28,45,38,52,41,35,49,44,37,55], backgroundColor:'rgba(26,45,107,.75)', borderRadius:6, borderSkipped:false },
      { label:'Dikembalikan', data:[18,27,31,40,35,48,38,30,45,40,33,50], backgroundColor:'rgba(8,145,178,.65)',  borderRadius:6, borderSkipped:false }
    ]
  },
  line: {
    labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agt','Sep','Okt','Nov','Des'],
    datasets: [
      { label:'Peminjaman',   data:[22,31,28,45,38,52,41,35,49,44,37,55], borderColor:'#1a2d6b', backgroundColor:'rgba(26,45,107,.10)', fill:true, tension:.4, pointRadius:4, pointBackgroundColor:'#1a2d6b', borderWidth:2 },
      { label:'Pengembalian', data:[18,27,31,40,35,48,38,30,45,40,33,50], borderColor:'#0891b2', backgroundColor:'rgba(8,145,178,.08)',  fill:true, tension:.4, pointRadius:4, pointBackgroundColor:'#0891b2', borderWidth:2 }
    ]
  },
  doughnut: {
    labels: ['Fiksi','Sains','Sejarah','Teknologi','Lainnya'],
    datasets: [{ data:[35,25,15,18,7], backgroundColor:['#1a2d6b','#0891b2','#059669','#d97706','#8a9bac'], borderWidth:0, hoverOffset:6 }]
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