@extends('layouts.page')
@section('title', 'Plano de Contas')
@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Importar Plano de Contas</h1>
    </div>

@stop


@section('content')

    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-9">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fa-regular fa-clipboard-list-check"></i>
                                Dados da Importação

                            </h3>
                        </div>

                        <div class="card-body table-responsive">

                            <div class="card mb-4">
                                <form id="import_accounting_financial_form" method="post">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row justify-content-between ">
                                            <div class="form-group col-12 ">
                                                <x-adminlte-input-file name="input_file" label="Selecionar Arquivo"
                                                    id="input_file" placeholder="Selecione..." legend="Navegar">
                                                    <x-slot name="appendSlot">
                                                        <x-adminlte-button theme="primary" label="Importar"
                                                            id="btn_impot_file" />
                                                    </x-slot>
                                                    <x-slot name="prependSlot">
                                                        <div class="input-group-text text-primary">
                                                            <i class="fas fa-file-upload"></i>
                                                        </div>
                                                    </x-slot>
                                                </x-adminlte-input-file>
                                            </div>

                                        </div>

                                        <div class="progress" id="progressBarContainer">
                                            <div class="progress-bar  bg-success" id="progressBar" role="progressbar"
                                                style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                        <div id="status"></div>

                                    </div>
                                </form>
                            </div>



                            <b>Resgistros Importados.</b>
                            <div style="padding-top: 15px" class="table-responsive">
                                <table class="table" id="import_table">
                                    <thead>
                                        <tr style="color: #455a64; background-color: #f5f5f5">
                                            <th style='text-align: center; '>Conta</th>
                                            <th style='text-align: left;'>Nome</th>
                                            <th style='text-align: center;'>Início de Vigência</th>
                                            <th style='text-align: center; '>Fim de Vigência</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
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
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-12">
                                    <a href="/accounting_financial" class="btn btn-secondary">Voltar</a>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col-3">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fa-regular fa-lightbulb"></i>
                                Dica do Sistema

                            </h3>
                        </div>

                        <div class="card-body table-responsive">
                            <p> - O plano de contas facilita agrupar melhor suas contas em categorias.</p>
                            <p> - Os campos marcados com <span class="text-danger"> (*)</span> são obrigatórios.</p>
                        </div>


                    </div>
                </div>
            </div>


        </div>

    </div>

@stop

@push('js')
    <script>
        document.getElementById("btn_impot_file").addEventListener("click", function(e) {
            var form = document.getElementById("import_accounting_financial_form");
            xhr = new XMLHttpRequest();
            xhr.open("POST", "{{ url('accounting_financial/import/save') }}", true);


            // definir uma função de retorno de chamada para atualizar a barra de progresso
            xhr.upload.addEventListener("progress", function(e) {
                var percent = Math.round((e.loaded / e.total) * 100);
                document.getElementById("progressBar").style.width = percent + "%";
                document.getElementById("status").innerHTML = percent + "% importado...";
            }, false);

            // enviar o arquivo
            var formData = new FormData(form);
            xhr.send(formData);

            xhr.onreadystatechange = function() {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    let data = JSON.parse(xhr.responseText);

                    if (xhr.status !== 200) {
                        Toast.fire({
                            icon: data.status,
                            title: data.message,
                        });
                        return false;
                    }

                    if (data.data) {
                        let objeto = data.data;
                        const array = Object.keys(objeto).map(chave => objeto[chave]);
                        paginate(array);
                    } else {
                        $("#import_table tbody tr").remove();

                    }

                    Toast.fire({
                        icon: data.status,
                        title: data.message,
                    });

                }
            }
        });

        function paginate(dados) { // fun��o que monta a tabela e a pagina��o


            const state = {
                page: 1,
                perPage() {
                    return 10
                },
                totalPage() {
                    return Math.ceil(dados.length / state.perPage())

                },
                maxVisibleButtons: 5
            }

            const list = {
                create(item) {
                    var table = "";
                    let start_date = new Date(item.start_duration_date).toLocaleDateString('pt-BR');
                    let end_date = "";
                    if (item.end_duration_date) {
                        end_date = new Date(item.end_duration_date).toLocaleDateString('pt-BR');

                    }
                    table = table.concat("<tr >",
                        "<td   style='text-align: center; '>" + item.account + "</td>",
                        "<td   style='text-align: left; '>" + item.name + "</td>",
                        "<td   style='text-align: center; '>" + start_date + "</td>",
                        "<td   style='text-align: center; '>" + end_date + "</td>",
                        "</tr>"

                    );

                    $("#import_table tbody").append(table);

                },
                update() {
                    $("#import_table tbody tr").remove();
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
                update()
                controls.createListeners()
            }

            init();
        }
    </script>
@endpush
