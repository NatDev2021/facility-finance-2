<div class="card mb-4">
    <div class="card-header">
        <i class="fa-regular fa-clipboard-list-check"></i>
        Dados da Importação
    </div>
    <div class="card-body">

        <form id="importa_plano_contas" name="importa_plano_contas" method="post" class="form-card">

            <div class="card mb-4">
                <div class="card-body">
                    <div class="row justify-content-between ">
                        <div class="form-group col-12 ">
                            <x-adminlte-input-file name="input_file" label="Selecionar Arquivo" id="input_file"
                                placeholder="Selecione..." legend="Navegar">
                                <x-slot name="appendSlot">
                                    <x-adminlte-button theme="primary" label="Importar" id="btn_impot_file" />
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
                        <div class="progress-bar  bg-success" id="progressBar" role="progressbar" style="width: 0%"
                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div id="status"></div>

                </div>
            </div>


        </form>
        <b>Resgistros Importados.</b>
        <div style="padding-top: 15px" class="table-responsive">
            <table class="table">
                <thead>
                    <tr style="color: #455a64; background-color: #f5f5f5">
                        <th>Conta</th>
                        <th>Nome</th>
                        <th>Início de Vigência</th>
                        <th>Fim de Vigência</th>
                    </tr>
                </thead>
            </table>
        </div>

    </div>
</div>
@push('js')
    <script>
        document.getElementById("btn_impot_file").addEventListener("click", function(e) {
            var form = document.getElementById("import_accounting_financial_form");
            xhr = new XMLHttpRequest();
            xhr.open("POST", "{{ url('accounting_financial/read_file') }}", true);


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
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log(xhr.responseXML);
                }
            }
        });
    </script>
@endpush
