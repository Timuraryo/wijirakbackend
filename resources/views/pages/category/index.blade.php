@extends('layouts.default')

@section('title')
    Daftar Category - Shayna
@endsection

@section('content')
    <div class="orders">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Daftar Category</h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Name</th>
                                        <th>Icon</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @forelse ($items as $item)
                                   <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                   <td>
                                        <img src="{{ Storage::url($item->image)}}" alt=""/>
                                   </td>
                                    <td>

                                    <a href="{{ route ('category.edit', $item->id)}}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    <form action="{{ route ('category.destroy', $item->id)}}" method="post" class="d-inline">
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
