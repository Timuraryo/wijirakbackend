@extends('layouts.default')

@section('title')
    Transaksi - WIJIRAK
@endsection

@section('content')
    <div class="orders">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Daftar Transaksi Masuk</h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Nomor</th>
                                        <th>Total Transaksi</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @forelse ($transaction_detail as $item)
                                   <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->product->name}}</td>
                                    <td>{{$item->transaction->user->email}}</td>
                                    <td>{{$item->transaction->user->phone}}</td>
                                    <td> {{ 'Rp ' . number_format($item->transaction->total_price ?? 0, 0, ".", "." ) }}</td>
                                    <td>
                                        @if($item->transaction->status == 'PENDING')
                                            <span class="badge badge-warning">PENDING</span>
                                        @elseif($item->transaction->status == 'SUCCESS')
                                            <span class="badge badge-success">SUCCESS</span>
                                        @elseif($item->transaction->status == 'FAILED')
                                            <span class="badge badge-danger">FAILED</span>
                                        @else
                                            <span>
                                        @endif
                                        {{$item->transaction_status}}
                                            </span>
                                    </td>
                                    <td>
                                    @if($item->transaction_status == 'PENDING')
                                 <a href="{{route('transactions.status', $item->id)}}?status=SUCCESS"
                                        class="btn btn-success btn-sm">
                                        <i class="fa fa-check"></i>
                                    </a>
                                    <a href="{{route('transactions.status', $item->id)}}?status=FAILED"
                                        class="btn btn-warning btn-sm">
                                        <i class="fa fa-times"></i>
                                    </a>
                                    @endif

                                    <a href="{{ route('pembayaran', $item->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-upload"></i>
                                    </a>
                                    <a href="#mymodal"
                                        data-remote="{{route('transactions.show', $item->id)}}"
                                        data-toggle="modal"
                                        data-target="#mymodal"
                                        data-title="Detail Transaksi <strong> {{ $item->transaction->code }}</strong> "
                                        class="btn btn-primary btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route ('transactions.edit', $item->id)}}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    <form action="{{ route ('transactions.destroy', $item->id)}}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
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
