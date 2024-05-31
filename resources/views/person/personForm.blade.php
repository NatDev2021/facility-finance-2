@extends('layouts.page')

@section('title', 'Pessoas')

@section('content_header')
<h1>Cadastro de Pessoa</h1>

@stop

@section('content')

<div class="content">
    <div class="container-fluid">
        <form action="{{ url('person/save') }}" id="person_form" method="post">
            @csrf
            <input type="hidden" name="id_person" id="id_person" value="{{ $person->id ?? '' }}" autocomplete="off">

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-edit"></i>

                    </h3>
                </div>

                <div class="card-body table-responsive p-0">

                    <div class="timeline mt-3">


                        <div>
                            <i class="fas fa-address-card bg-blue"></i>
                            <div class="timeline-item">
                                <x-adminlte-card title="Dados Básicos" theme="dark">
                                    @include("{$form_view}")
                                </x-adminlte-card>
                            </div>
                        </div>

                        <div>
                            <i class="fas fa-home bg-blue"></i>
                            <div class="timeline-item">
                                <x-adminlte-card title="Endereço" theme="dark">
                                    @include('person.forms.addressForm')
                                </x-adminlte-card>

                            </div>
                        </div>

                        {{-- <div>
                                <i class="fas fa-phone-square bg-blue"></i>
                                <div class="timeline-item">
                                    <div class="card card-secondary">
                                        <div class="card-header">
                                            <h3 class="card-title">Contato</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                    title="Collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @include('person.forms.phoneForm')
                                        </div>

                                    </div>
                                </div>
                            </div> --}}


                    </div>

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-12">
                            <a href="/person" class="btn btn-secondary">Voltar</a>
                            <a id="save" class="btn btn-success float-right">Salvar</a>
                        </div>
                    </div>
                </div>


            </div>

            <!-- Modal -->
            <div class="modal fade" id="personModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Nova Pessoa</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p> Deseja adicionar está pessoa como Cliente/Fornecedor?</p>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customer_check" name="customer_check" value="provider_check">
                                    <label class="custom-control-label" for="customer_check">Cliente</label>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="provider_check" name="provider_check" value="provider_check">
                                    <label class="custom-control-label" for="provider_check">Fornecedor</label>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <a onclick="addPerson()" class="btn btn-danger">Não</a>
                            <a onclick="addPersonAndCustomerProvider()" class="btn btn-success">Sim</a>

                        </div>
                    </div>
                </div>
            </div>

        </form>

    </div>

</div>

@stop


@push('js')
<script>
    const btn_save = document.getElementById('save');
    btn_save.addEventListener("click", function() {


        if (validateEmptyFields('document', 'name')) {
            let id_person = document.getElementById('id_person').value;
            if (id_person !== '') {
                addPerson();

            } else {
                let modal = $('#personModal');
                modal.modal('show');
            }

        }


    });

    async function addPerson() {
        await document.getElementById("person_form").submit();

    }

    function addPersonAndCustomerProvider() {
        document.getElementById("person_form").action = window.location.origin + '/person/save_customer_provider';
        addPerson();
    }

    $(document).ready(function() { // onloadjs

        $('#document').on('change', function() {

            let document = $(this).cleanVal();

            if (document.trim()) {

                $.ajax({
                    url: "{{ url('person/get_by_document') }}" + "/" + document,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        if (response) {
                            definePersonData(response)
                            Swal.fire("Este CPF/CNPJ já possui cadastro.");
                        } else {
                            $('#id_person').val('').trigger('input');
                            $('#id_phone').val('').trigger('input');
                            $('#id_address').val('').trigger('input');


                        }

                    }
                });

            } else {
                $('#id_person').val('').trigger('input');
                $('#id_phone').val('').trigger('input');
                $('#id_address').val('').trigger('input');


            }

        });




    });

    function definePersonData(data) {
        $('#id_person').val(data.id);
        $('#document').val(data.document).trigger('input');
        $('#name').val(data.name).trigger('input');
        $('#representative').val(data.representative).trigger('input');
        $('#date_birthday').val(data.date_birthday).trigger('input');
        $('#email').val(data.email).trigger('input');
        $('#id_phone').val(data.phone[0].id);
        $('#phone').val(data.phone[0].phone).trigger('input');
        $('#id_address').val(data.address[0].id);
        $('#zip_code').val(data.address[0].zip_code).trigger('input');
        $('#street_address').val(data.address[0].street_address);
        $('#address_number').val(data.address[0].address_number);
        $('#neighborhood').val(data.address[0].neighborhood);
        $('#city').val(data.address[0].city);
        $('#state').val(data.address[0].state);
        $('#complement').val(data.address[0].complement);
    }
</script>
@endpush