@extends('layout.main')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<section class="content-header">
  <h1 style="text-align:center;">Beri Ulasan</h1>
  <ol class="breadcrumb">
    <li>
      <a href="{{ route('home') }}">
        <i class="fa fa-home"></i>
        <b>Si Perpustakaan</b>
      </a>
    </li>
    <li class="active">Beri Ulasan</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">

      <div class="box box-primary">
        <div class="box-header with-border text-center">
          <h4 class="box-title">
            <i class="fa fa-star" style="color:#f5a623;margin-right:8px;"></i>
            Form Ulasan Perpustakaan
          </h4>
        </div>

        <div class="box-body">

          @if(session('success'))
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <i class="fa fa-check-circle"></i> {{ session('success') }}
            </div>
          @endif

          @if($errors->any())
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <ul style="margin:0;padding-left:16px;">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="{{ route('ulasan.store') }}" method="POST">
            @csrf

            {{-- 2 KOLOM --}}
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" class="form-control"
                         value="{{ auth()->user()->nama ?? old('nama') }}"
                         placeholder="Nama lengkap" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Kelas</label>
                  <input type="text" name="kelas" class="form-control"
                         value="{{ auth()->user()->noidentitas ?? old('kelas') }}"
                         placeholder="Contoh: XI RPL 1" required>
                </div>
              </div>
            </div>

            {{-- ULASAN --}}
            <div class="form-group">
              <label>Ulasan</label>
              <textarea name="isi" class="form-control" rows="4"
                        placeholder="Ceritakan pengalamanmu menggunakan perpustakaan..." required>{{ old('isi') }}</textarea>
            </div>

            {{-- STAR RATING --}}
            <div class="form-group">
              <label>Rating</label>
              <div style="display:flex;align-items:center;gap:12px;margin-top:6px;">
                <div id="starRating" style="display:flex;gap:6px;">
                  @for($i = 1; $i <= 5; $i++)
                    <span class="star-btn" data-value="{{ $i }}"
                          style="font-size:40px;cursor:pointer;color:#d1d9e6;
                                 transition:color .15s,transform .15s;line-height:1;
                                 user-select:none;">★</span>
                  @endfor
                </div>
                <span id="starLabel"
                      style="font-size:14px;font-weight:700;color:#5a6b7b;min-width:100px;">
                  Sangat Bagus
                </span>
              </div>
              <input type="hidden" name="rating" id="ratingValue" value="5">
            </div>

            {{-- BUTTONS --}}
            <div class="text-right" style="margin-top:24px;border-top:1px solid #e8edf2;padding-top:20px;">
              <a href="{{ route('home') }}" class="btn btn-default" style="margin-right:8px;">
                <i class="fa fa-arrow-left"></i> Kembali
              </a>
              <button type="submit" class="btn btn-primary">
                <i class="fa fa-paper-plane"></i> Kirim Ulasan
              </button>
            </div>

          </form>
        </div>

        {{-- BOX FOOTER: preview ulasan --}}
        <div class="box-footer">
          <div style="display:flex;align-items:center;gap:14px;">
            <div style="width:44px;height:44px;border-radius:50%;
                        background:linear-gradient(135deg,#eef1fb,#dde4eb);
                        display:flex;align-items:center;justify-content:center;
                        font-size:20px;font-weight:800;color:#1a2d6b;" id="previewAvatar">
              {{ strtoupper(substr(auth()->user()->nama ?? 'U', 0, 1)) }}
            </div>
            <div>
              <div style="font-weight:700;font-size:14px;color:#1a2332;" id="previewNama">
                {{ auth()->user()->nama ?? 'Nama' }}
              </div>
              <div id="previewStars" style="color:#f5a623;font-size:16px;letter-spacing:2px;">
                ★★★★★
              </div>
            </div>
            <div style="font-size:13px;color:#5a6b7b;font-style:italic;" id="previewTeks">
              Preview ulasan kamu akan muncul di sini...
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

@push('scripts')
<script>
  var currentRating  = 5;
  var ratingLabels   = ['','Jelek Banget','Kurang Baik','Cukup','Bagus','Sangat Bagus'];
  var stars          = document.querySelectorAll('.star-btn');

  function paintStars(val, isHover) {
    stars.forEach(function(s, i) {
      s.style.color     = i < val ? '#f5a623' : '#d1d9e6';
      s.style.transform = i < val ? 'scale(1.15)' : 'scale(1)';
    });
  }

  function setRating(val) {
    currentRating = val;
    document.getElementById('ratingValue').value = val;
    document.getElementById('starLabel').textContent = ratingLabels[val];
    paintStars(val, false);
    var previewStars = '';
    for (var i = 0; i < val; i++) previewStars += '★';
    for (var j = val; j < 5; j++) previewStars += '☆';
    document.getElementById('previewStars').textContent = previewStars;
  }

  stars.forEach(function(s) {
    var val = parseInt(s.dataset.value);
    s.addEventListener('click',      function() { setRating(val); });
    s.addEventListener('mouseover',  function() { paintStars(val, true); });
    s.addEventListener('mouseout',   function() { paintStars(currentRating, false); });
  });

  document.querySelector('[name="isi"]').addEventListener('input', function() {
    var txt = this.value.trim();
    document.getElementById('previewTeks').textContent =
      txt ? '"' + txt + '"' : 'Preview ulasan kamu akan muncul di sini...';
  });

  setRating(5);
</script>
@endpush

@endsection