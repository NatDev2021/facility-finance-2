<div class="row ">
    <div class="col-md-4  justify-content-center">

        <div class="timeline">

            <div>
                <i class="fas fa-circle-exclamation bg-info"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header"><a href="#">Informativo</a></h3>
                    <div class="timeline-body">
                        A assinatura eletrônica tem a mesma validade jurídica do que uma assinatura manuscrita. No
                        Brasil, e na maioria dos outros países, é reconhecida por lei e aceita em todos os âmbitos
                        legais, pois o documento final é certificado digitalmente pela ZapSign com certificado A1
                        ICP-Brasil.
                    </div>

                </div>
            </div>

            @foreach ($loan['signature'] as $signature)
                @if ($signature['status'] == 'pending')
                    <div>
                        <i class="fas fa-paper-plane bg-yellow"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i>&nbsp;
                                {{ Helper::convertToBrazilianDateHour($signature['created_at']) }}</span>
                            <h3 class="timeline-header"><a href="#">Assinatura Solicitada</a></h3>
                            <div class="timeline-body">
                                Um e-mail foi enviado ao cliente solicitando sua assinatura.
                            </div>

                        </div>
                    </div>
                @elseif($signature['status'] == 'signed')
                    <div>
                        <i class="fas fa-badge-check bg-green"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i>&nbsp;
                                {{ Helper::convertToBrazilianDateHour($signature['created_at']) }}</span>
                            <h3 class="timeline-header"><a href="#">Documento Assinado</a></h3>
                            <div class="timeline-body">
                                Documento Assinado com Sucesso.
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach


            <div>
                <div class="timeline-item">
                    @if (!$signedstatus)
                        <button type="button" id="bt_send_sing" class="btn btn-success float-right"
                            onclick="sendSign()">Solicitar
                            Assinatura&nbsp;
                            <span id="spinner_contract"></span>
                        </button>
                    @endif

                </div>
            </div>




        </div>


    </div>
    <div class="col-md-8">
        <embed src="data:application/pdf;base64,{{ $contract }}" type="application/pdf" width="100%"
            height="600">
    </div>

</div>
@push('js')
    <script>
        function sendSign() {
            var frm = $('#loan_form');

            $.ajax({
                url: "{{ url('signature/send') }}",
                type: "POST",
                dataType: "json",
                data: frm.serialize(),
                beforeSend: function() {
                    $('#spinner_contract').addClass("spinner-border spinner-border-sm"); // Liga spiner
                    $('#bt_send_sing').addClass("disabled");

                },
                complete: function() {
                    $('#spinner_contract').removeClass("spinner-border spinner-border-sm"); //Desliga spiner
                    $('#bt_send_sing').removeClass("disabled");

                },
                success: function(response) {

                    Toast.fire({
                        icon: response.status,
                        title: response.message,
                    });

                }
            });
        }
    </script>
@endpush
