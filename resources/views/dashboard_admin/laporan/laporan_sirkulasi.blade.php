@extends('layout.main')

@section('content')
<section class="content-header">
	<h1 style="text-align:center;">
		Laporan
        <small>Sirkulasi</small>
	</h1>
</section>

<section class="content">

    <div class="box box-primary">
        <div class="box-header with-border">

            {{-- ✅ PRINT TANPA FILTER --}}
            <a href="{{ route('admin.laporan.print') }}"
               class="btn btn-success" target="_blank">
                <i class="glyphicon glyphicon-print"></i> Print
            </a>

        </div>

        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Buku</th>
                        <th>Peminjam</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Denda</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($laporan as $i => $item)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $item->judul_buku }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tgl_dikembalikan)->format('d/m/Y') }}</td>

                        <td>
                            @if($item->denda > 0)
                                <span class="text-danger">
                                    Rp {{ number_format($item->denda,0,',','.') }}
                                </span>
                            @else
                                <span class="text-success">Tepat Waktu</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" align="center">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <h4>Total Denda:
                <b>Rp {{ number_format($total_denda,0,',','.') }}</b>
            </h4>

        </div>
    </div>

</section>
@endsection