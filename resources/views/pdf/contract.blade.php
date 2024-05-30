<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato de Empréstimo por Cartão de Crédito</title>
    <style>
        /* Estilos */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }


        .header {
            text-align: center;
        }

        .header img {
            max-width: 200px;
        }

        .contract {
            margin: 0 auto;
            max-width: 800px;
            padding: 10px, 20px, 20px, 20px;
        }

        .signature {
            margin-top: 50px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="img/authLogo.svg" alt="Logo da Empresa" width="100">
    </div>

    <div class="contract">
        <h3 style="text-align: center;">CONTRATO DE EMPRÉSTIMO POR CARTÃO DE CRÉDITO Nº: {{$loan->id}}</h3>
        <h4>IDENTIFICAÇÃO DAS PARTES CONTRATANTES:</h4>
        <p><strong>CONCEDENTE (EMPRESA):</strong><br>
            Nome: {{$company->company_name??''}}<br>
            CNPJ: {{ Helper::formatDocument($company->document??'')}}<br>
            Endereço: {{($company->street_address??'').' Nº: '.($company->address_number??'').' - '. ($company->complement??'').', '. ($company->neighborhood??''). ' - '. ($company->city??'') . '/'. ($company->state??'')}}
        </p>

        <p><strong>CONTRATANTE (CLIENTE):</strong><br>
            Nome: {{$customer->person->name??''}}<br>
            CPF: {{ Helper::formatDocument($customer->person->document??'')}}<br>
            Endereço: {{($customer->personAddress->street_address ?? '').' Nº: '.($customer->personAddress->address_number??'').' - '. ($customer->personAddress->complement??'').', '. ($customer->personAddress->neighborhood??''). ' - '. ($customer->personAddress->city??'') . '/'. ($customer->personAddress->state??'')}}
        </p>
        @if(!empty($loan->cardholder))
        <p><strong>TITULAR DO CARTÃO:</strong><br>
            Nome: {{$loan->holder->name??''}}<br>
            CPF: {{Helper::formatDocument($loan->holder->document??'')}}<br>
            Endereço: {{($loan->holderAddress->street_address??'').' Nº: '.($loan->holderAddress->address_number??'').' - '. ($loan->holderAddress->complement??'').', '. ($loan->holderAddress->neighborhood??''). ' - '. ($loan->holderAddress->city??'') . '/'. ($loan->holderAddress->state??'')}}
        </p>
        @endif
        <h4>CLÁUSULAS:</h4>
        <ol>
            <li style="text-align: justify;"><strong>OBJETO:</strong> O CONCEDENTE concorda em conceder ao CONTRATANTE um empréstimo por meio do cartão de crédito vinculado à conta do CONTRATANTE.</li>
            <li style="text-align: justify;"><strong>VALOR DO EMPRÉSTIMO:</strong> O valor total do empréstimo é de R$ {{ Helper::formatBrazilianNumber($loan->financed_amount ?? '') }} dividido em {{ $loan->installments ?? '' }} vezes, a ser disponibilizado na conta do CONTRATANTE mediante a utilização do cartão de crédito o valor de R$: {{ Helper::formatBrazilianNumber($loan->loan_amount ?? '') }}.</li>
            <li style="text-align: justify;"><strong>PAGAMENTO E TAXAS:</strong> O CONTRATANTE concorda em pagar o valor total do empréstimo conforme as condições estabelecidas pela fatura do cartão de crédito. Quaisquer taxas ou encargos adicionais serão detalhados na fatura mensal.</li>
            <li style="text-align: justify;"><strong>PRAZO:</strong> O prazo para o pagamento do empréstimo será o estabelecido nas condições de pagamento do cartão de crédito, conforme definido pela administradora do cartão.</li>
            <li style="text-align: justify;"><strong>JUROS E ENCARGOS:</strong> Quaisquer juros ou encargos relacionados ao empréstimo seguirão as taxas estabelecidas pela administradora do cartão de crédito, de acordo com as políticas vigentes.</li>
            <li style="text-align: justify;"><strong>RESPONSABILIDADES DO CONTRATANTE:</strong> O CONTRATANTE é responsável por garantir que o limite do cartão de crédito seja suficiente para cobrir o valor do empréstimo. Além disso, o CONTRATANTE concorda em cumprir todas as condições e termos estabelecidos pela administradora do cartão.</li>
            <li style="text-align: justify;"><strong>LIQUIDAÇÃO ANTECIPADA:</strong> O CONTRATANTE tem o direito de liquidar antecipadamente o empréstimo, mediante o pagamento do saldo devedor atualizado, conforme as políticas da administradora do cartão.</li>
            <li style="text-align: justify;"><strong>VIGÊNCIA:</strong> Este contrato tem vigência a partir da data de assinatura e permanecerá em vigor até a quitação total do empréstimo.</li>
        </ol>

        <h4>DISPOSIÇÕES GERAIS:</h4>
        <ul>
            <li>Ambas as partes concordam em cumprir todas as leis e regulamentos aplicáveis relacionados a este contrato.</li>
            <li>Alterações a este contrato só serão válidas se realizadas por escrito e assinadas por ambas as partes.</li>
            <li>Caso o contratante não seja o titular do cartão, ele se encarrega de toda responsabilidade e só será autorizado a realizar o empréstimo pelo concedente com a apresentação da documentação do mesmo e do titular.</li>
        </ul>

        <p><strong>FORO:</strong> Para dirimir quaisquer controvérsias oriundas deste contrato, fica eleito o foro da comarca de Muriaé/MG.</p>

        <div class="signature">
            <p><strong>LOCAL E DATA:</strong> {{($company->city??'') . '/'. ($company->state??'')}} - {{date('d/m/Y')}}</p>
            
            <p><strong>CONCEDENTE (EMPRESA):</strong> _____________________________________________</p>

            <p><strong>CONTRATANTE (CLIENTE):</strong> _______________________________________________</p>
        </div>
    </div>
</body>

</html>
