@extends('layouts.page')

@section('title', 'Contratos')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Contratos</h1>
        <a href="{{ url('simulate/simulate_form') }}" class="btn btn-outline-primary" id="new_status">
            <i class="fa-solid fa-plus"></i>
            Adicionar
        </a>
    </div>

@stop

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-edit"></i>

                    </h3>
                </div>

                <div class="card-body table-responsive">
                    <table id="loans_table" class="table table-striped table-valign-middle ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">Data</th>
                                <th class="text-center">Cliente</th>
                                <th class="text-right">Valor</th>
                                <th class="text-center">Parcelas</th>
                                <th class="text-center">Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loans as $item)
                                <tr>
                                    <td id="id">{{ $item->id }}</td>
                                    <td class="text-center">{{  date('d/m/Y', strtotime($item->created_at)) }}</td>
                                    <td class="text-left">{{ $item->customer ?? '' }}</td>
                                    <td class="text-right">{{ Helper::formatBrazilianNumber($item->loan_amount ?? '') }}
                                    </td>
                                    <td class="text-center">{{ $item->installments ?? '' }}</td>
                                    <td class="text-center"><span class="badge"
                                            style="background-color: {{ $item->status_color ?? '' }};">{{ $item->status ?? '' }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-end">
                                            <a id="loan_detail" href="{{ url('loans/detail/' . $item->id) }}"
                                                class="text-muted mr-3" style="cursor: pointer;" title="Editar">
                                                <i class="fas fa-search"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $loans->links() }}
                    </div>
                </div>

            </div>
        </div>

    </div>

@stop


@push('js')
    <script>
        $(document).ready(function() {
          
        });
    </script>
@endpush
