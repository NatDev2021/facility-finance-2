@extends('layouts.page')

@section('title', 'Integração Finne')

@section('content_header')
    <h1>Integração Finne</h1>

@stop

@section('content')

    <div class="content">
        <div class="container-fluid">


            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa-brands fa-hive"></i>

                    </h3>
                </div>

                <div class="card-body">
                    <div class="card card-body">

                        <form id="finne_form" method="post">
                            @csrf
                            <div class="row justify-content-md-center">
                                <div class="col-md-2">
                                    <label for="amount">Tipo</label>
                                    <x-adminlte-select name="type" id="type">
                                        <option value="0">Salecione...</option>
                                        <option @selected(($search['status'] ?? '') == 'p') value="p">Pagamento</option>
                                        <option @selected(($search['status'] ?? '') == 'r') value="r">Recebimento</option>
                                    </x-adminlte-select>
                                </div>
                                <div class="col-md-6">
                                    <x-adminlte-select2 id="customer" name="person" label="Cliente/Fornecedor">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text">
                                                <i class="fa-solid fa-address-card"></i>
                                            </div>
                                        </x-slot>
                                        <option value="0">Salecione...</option>
                                        @foreach ($person as $item)
                                            <option value="{{ $item->id }}"> {{ $item->name }}</option>
                                        @endforeach
                                    </x-adminlte-select2>
                                </div>
                                <div class="col-md-2">
                                    <label for="inputDescription">Vencimento</label>
                                    <div class="input-group date" id="date" data-target-input="nearest">
                                        <div class="input-group-append" data-target="#due_date">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                        <input type="text" name="due_date" id="due_date" class="form-control "
                                            data-target="#due_date" />

                                    </div>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label for="inputDescription">&nbsp;</label>
                                    <button type="button" id="bt_search" class="form-control btn btn-dark ">Buscar&nbsp;
                                        <span id="spinner"></span>
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div style="padding-top: 15px" class="table-responsive">
                        <table class="table" id="finne_table" data-toggle="table">
                            <thead class="table-dark">
                                <tr>
                                    <th class='text-center align-middle'>
                                        <div class="icheck-default ">
                                            <input type="checkbox" id="checkAll" checked="">
                                            <label for="checkAll">
                                            </label>
                                        </div>

                                    </th>
                                    <th class='text-center align-middle'>Tipo</th>
                                    <th class="text-center align-middle">Vencimento</th>
                                    <th class="text-left align-middle">Descrição</th>
                                    <th class="text-center align-middle">Cliente\Fornecedor</th>
                                    <th class="text-center align-middle">Data Pagamento</th>
                                    <th class="text-center align-middle">Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot></tfoot>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination" style="justify-content: end;">
                                <li class="page-item "><a class="page-link first" href="#">Primeiro</a></li>
                                <li class="page-item">
                                    <a class="page-link prev" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item numbers d-flex"><a class="page-link" href="#">1</a></li>
                                <li class="page-item">
                                    <a class="page-link next" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                                <li class="page-item "><a class="page-link last" href="#">Ultimo</a></li>
                            </ul>
                        </nav>
                    </div>
                    <hr>
                    <div class=" d-flex justify-content-between">
                        <button type="button" id="bt_export_excel" class="btn btn-success" data-dismiss="modal">Excel&nbsp;
                            <span id="spinner"></span>
                            &nbsp;<i class="fa-regular fa-file-spreadsheet"></i></button>
                        <button type="button" id="bt_export" class="btn btn-success float-right">Exportar&nbsp;
                            <span id="spinner_api_export"></span></button>
                    </div>


                </div>

            </div>

        </div>

    </div>


@stop

@push('js')
    <script>
        $(document).ready(function() { // onloadjs

            selectedItems = []; // Track selected item IDs
            dados = [];


            $('#due_date').daterangepicker({
                locale: {
                    "format": "DD/MM/YYYY",
                    "applyLabel": "Aplicar",
                    "cancelLabel": "Cancelar",
                    "daysOfWeek": [
                        "D",
                        "S",
                        "T",
                        "Q",
                        "Q",
                        "S",
                        "S"
                    ],
                    "monthNames": [
                        "Janeiro",
                        "Fevereiro",
                        "Março",
                        "Abril",
                        "Maio",
                        "Junho",
                        "Julho",
                        "Agosto",
                        "Setembro",
                        "Outubro",
                        "Novembro",
                        "Dezembro"
                    ]

                },
            });

            $('#bt_search').on('click', function() {
                dados = [];
                var frm = $('#finne_form');
                $.ajax({
                    url: "{{ url('integration/finne/get_transaction') }}",
                    type: "GET",
                    data: frm.serialize(),
                    beforeSend: function() {
                        $('#spinner').addClass(
                            "spinner-border spinner-border-sm"); // Liga spiner
                        $('#bt_search').addClass("disabled");

                    },
                    complete: function() {
                        $('#spinner').removeClass(
                            "spinner-border spinner-border-sm"); //Desliga spiner
                        $('#bt_search').removeClass("disabled");

                    },
                    success: function(response) {
                        const array = Object.keys(response).map(chave => response[chave]);
                        dados = array;
                        paginate();


                    }
                });
            })


            $('#checkAll').click(function() {
                $('input:checkbox').not(this).prop('checked', this.checked);
                if (this.checked) {
                    checkedAll();
                } else {
                    clearCheck();
                }
            });

            $('#bt_export').on('click', function() {


                if (selectedItems.length === 0) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Nenhum registro selecionado para exportação!",
                    });

                    return false;
                }

                exportApiTransaction(selectedItems)

            })

            $('#bt_export_excel').on('click', function() {


                if (selectedItems.length === 0) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Nenhum registro selecionado para exportação!",
                    });

                    return false;
                }

                exportExcelTransaction(selectedItems)

            })

            // Event listener for checkbox change
            $(document).on('change', 'input[type="checkbox"]', function() {
                const itemId = parseInt($(this).val());
                if ($(this).prop('checked')) {
                    selectedItems.push(itemId);
                } else {
                    selectedItems = selectedItems.filter(id => id !== itemId);
                }
            });



        });

        function paginate() {


            const state = {
                page: 1,
                perPage() {
                    return 10
                },
                totalPage() {
                    return Math.ceil(dados.length / state.perPage())

                },
                maxVisibleButtons: 5,

            }

            const list = {
                create(item) {
                    var table = "";
                    let = new Date(item.due_date).toLocaleDateString('pt-BR');
                    let pay_ddue_dateate = new Date(item.pay_date).toLocaleDateString('pt-BR');
                    let classType = item.type == 'p' ? 'up text-danger' : 'down text-success';
                    let titleType = item.type == 'p' ? 'Pagamento' : 'Recebimento';

                    // Determine if checkbox should be checked based on selectedItems
                    const isChecked = selectedItems.includes(item.id);

                    table = table.concat("<tr >",
                        "<td class='text-center align-middle'><div class='icheck-wetasphalt'>",
                        "<input value='" + item.id + "' type='checkbox' id='checkboxWetasphalt" + item.id + "' " + (
                            isChecked ? "checked" : "") + ">",
                        "<label for='checkboxWetasphalt" + item.id + "'></label></div></td>",
                        "<td class='text-center align-middle'><i style='font-size: x-large; opacity: 0.7;'class='fa-solid fa-circle-arrow-" +
                        classType + "'  title='" + titleType + "'></i></td>",
                        "<td class='text-center align-middle'>" + item.due_date + "</td>",
                        "<td class='text-left align-middle'>" + item.description + "</td>",
                        "<td class='text-center align-middle'>" + item.customer_provider + "</td>",
                        "<td class='text-center align-middle'>" + item.pay_date + "</td>",
                        "<td class='text-center align-middle'>" + item.amount + "</td>",
                        "</tr>"

                    );

                    $("#finne_table tbody").append(table);

                },
                update() {
                    $("#finne_table tbody tr").remove();
                    let page = state.page - 1
                    let start = page * state.perPage()
                    let end = parseInt(start) + parseInt(state.perPage())

                    const paginatedItems = dados.slice(start, end)
                    paginatedItems.forEach(list.create)
                }
            }

            const html = {
                get(element) {
                    return document.querySelector(element)
                }
            }

            const controls = {
                perPage(number) {
                    if (perPage != number) {
                        perPage = number;
                    }



                },
                next() {
                    const lastPage = state.page < state.totalPage()
                    if (lastPage) {
                        state.page++
                    }
                },
                prev() {

                    const firstPage = state.page > 1;
                    if (firstPage) {
                        state.page--
                    }
                },
                goTo(page) {
                    if (page < 1) {
                        page = 1
                    }
                    state.page = +page
                    if (page > state.totalPage()) {
                        state.page = state.totalPage()
                    }

                },
                createListeners() {
                    html.get('.first').addEventListener('click', () => {
                        controls.goTo(1);
                        update();
                    })
                    html.get('.last').addEventListener('click', () => {
                        controls.goTo(state.totalPage());
                        update();

                    })
                    html.get('.prev').addEventListener('click', () => {
                        controls.prev();
                        update();

                    })
                    html.get('.next').addEventListener('click', () => {
                        controls.next();
                        update();

                    })


                }
            }



            const buttons = {

                element: html.get('.numbers'),
                create(number) {
                    const button = document.createElement('a')
                    button.classList.add('page-link')
                    button.innerHTML = number
                    if (state.page == number) {
                        button.classList.add('active')
                    }
                    button.addEventListener('click', (event) => {
                        const page = event.target.innerText
                        controls.goTo(page)
                        update()
                    })
                    buttons.element.appendChild(button)
                },
                update() {
                    buttons.element.innerHTML = ""
                    const {
                        maxLeft,
                        maxRight
                    } = buttons.calculateMaxVisible()
                    for (let page = maxLeft; page <= maxRight; page++) {
                        buttons.create(page)
                    }

                },
                calculateMaxVisible() {
                    const {
                        maxVisibleButtons
                    } = state
                    let maxLeft = (state.page - Math.floor(maxVisibleButtons / 2))
                    let maxRight = (state.page + Math.floor(maxVisibleButtons / 2))

                    if (maxLeft < 1) {
                        maxLeft = 1
                        maxRight = maxVisibleButtons
                    }
                    if (maxRight > state.totalPage()) {
                        maxLeft = state.totalPage() - (maxVisibleButtons - 1)
                        maxRight = state.totalPage()
                        if (maxLeft < 1) {
                            maxLeft = 1
                        }
                    }

                    return {
                        maxLeft,
                        maxRight
                    }
                }
            }

            function update() {
                list.update()
                buttons.update()
            }

            function init() {
                checkedAll();
                update()
                controls.createListeners()
            }




            init();
        }


        function checkedAll() {
            clearCheck();
            dados.forEach(element => {
                selectedItems.push(element.id);
            });
        }

        function clearCheck() {
            selectedItems = [];
        }


        function exportApiTransaction(idTransaction) {


            var form = document.getElementById("finne_form");
            var formData = new FormData(form);
            idTransaction.forEach(element => {
                formData.append("id_transaction[]", element);
            });

            $.ajax({
                url: "{{ url('integration/finne/export') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#spinner_api_export').addClass("spinner-border spinner-border-sm"); // Liga spiner
                    $('.btn').addClass("disabled");

                },
                complete: function() {
                    $('#spinner_api_export').removeClass("spinner-border spinner-border-sm"); //Desliga spiner
                    $('.btn').removeClass("disabled");

                },
                success: function(response) {
                    if (!response.success) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: response.message,
                        });

                        return false;

                    }


                }
            });

        }

        function exportExcelTransaction(idTransaction) {

            const urlParams = new URLSearchParams(window.location.search);
            const data = urlParams.toString();
            window.location.href = 'accounts_payable/export/excel?' + data;
        }
    </script>
@endpush
