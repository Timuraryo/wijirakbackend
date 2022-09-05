@extends('layouts.default')

@section('title')
    Lihat Pembayaran -WIJIRAK
@endsection

@section('content')
<div class="orders">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title">Daftar Pembayaran</h4>
                </div>
                <div class="card-body--">
                    <div class="table-stats order-table ov-h">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pengirim</th>
                                    <th>Bank Pengirim</th>
                                    <th>Tanggal Transfer</th>
                                    <th>Jumlah Transfer</th>
                                    {{-- <th>Bank Penerima</th> --}}
                                    <th>Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                               @forelse ($data as $data)
                               <tr>
                                {{-- {{ dd($data->foto) }} --}}
                                <td>{{$data->id}}</td>
                                <td>{{$data->nama_pengirim}}</td>
                                <td>{{$data->bank_pengirim}}</td>
                                <td>{{$data->tanggal_transfer}}</td>
                                <td>{{$data->total_transfer}}</td>
                                {{-- <td>{{$data->penerima}}</td> --}}
                                <td>
                                    {{-- get data foto bukti bayar --}}
                                        <img src="{{ Storage::url($data->foto)}}" alt="foto" width="100px"/>
                                    {{-- <img src="{{  }}" name="foto" alt=""/> --}}
                                </td>
                            </tr>
                               @empty
                                   <tr>
                                       <td colspan="6" class="text-center p-5">
                                           Data tidak tersedia
                                       </td>
                                   </tr>
                               @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
