<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BanksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('banks')->insert([
            [
                "ispb" => "00000000",
                "name" => "BCO DO BRASIL S.A.",
                "code" => 1,
                "full_name" => "Banco do Brasil S.A."
            ],
            [
                "ispb" => "00000208",
                "name" => "BRB - BCO DE BRASILIA S.A.",
                "code" => 70,
                "full_name" => "BRB - BANCO DE BRASILIA S.A."
            ],
            [
                "ispb" => "00038121",
                "name" => "Selic",
                "code" => null,
                "full_name" => "Banco Central do Brasil - Selic"
            ],
            [
                "ispb" => "00038166",
                "name" => "Bacen",
                "code" => null,
                "full_name" => "Banco Central do Brasil"
            ],
            [
                "ispb" => "00122327",
                "name" => "SANTINVEST S.A. - CFI",
                "code" => 539,
                "full_name" => "SANTINVEST S.A. - CREDITO, FINANCIAMENTO E INVESTIMENTOS"
            ],
            [
                "ispb" => "00204963",
                "name" => "CCR SEARA",
                "code" => 430,
                "full_name" => "COOPERATIVA DE CREDITO RURAL SEARA - CREDISEARA"
            ],
            [
                "ispb" => "00250699",
                "name" => "AGK CC S.A.",
                "code" => 272,
                "full_name" => "AGK CORRETORA DE CAMBIO S.A."
            ],
            [
                "ispb" => "00315557",
                "name" => "CONF NAC COOP CENTRAIS UNICRED",
                "code" => 136,
                "full_name" => "CONFEDERAÇÃO NACIONAL DAS COOPERATIVAS CENTRAIS UNICRED LTDA. - UNICRED DO BRASI"
            ],
            [
                "ispb" => "00329598",
                "name" => "ÍNDIGO INVESTIMENTOS DTVM LTDA.",
                "code" => 407,
                "full_name" => "ÍNDIGO INVESTIMENTOS DISTRIBUIDORA DE TÍTULOS E VALORES MOBILIÁRIOS LTDA."
            ],
            [
                "ispb" => "00360305",
                "name" => "CAIXA ECONOMICA FEDERAL",
                "code" => 104,
                "full_name" => "CAIXA ECONOMICA FEDERAL"
            ],
            [
                "ispb" => "00394460",
                "name" => "STN",
                "code" => null,
                "full_name" => "Secretaria do Tesouro Nacional - STN"
            ],
            [
                "ispb" => "00416968",
                "name" => "BANCO INTER",
                "code" => 77,
                "full_name" => "Banco Inter S.A."
            ],
            [
                "ispb" => "00460065",
                "name" => "COLUNA S.A. DTVM",
                "code" => 423,
                "full_name" => "COLUNA S/A DISTRIBUIDORA DE TITULOS E VALORES MOBILIÁRIOS"
            ],
            [
                "ispb" => "00517645",
                "name" => "BCO RIBEIRAO PRETO S.A.",
                "code" => 741,
                "full_name" => "BANCO RIBEIRAO PRETO S.A."
            ],
            [
                "ispb" => "00556603",
                "name" => "BANCO BARI S.A.",
                "code" => 330,
                "full_name" => "BANCO BARI DE INVESTIMENTOS E FINANCIAMENTOS S.A."
            ],
            [
                "ispb" => "00558456",
                "name" => "BCO CETELEM S.A.",
                "code" => 739,
                "full_name" => "Banco Cetelem S.A."
            ],
            [
                "ispb" => "00714671",
                "name" => "EWALLY IP S.A.",
                "code" => 534,
                "full_name" => "EWALLY INSTITUIÇÃO DE PAGAMENTO S.A."
            ],
            [
                "ispb" => "00795423",
                "name" => "BANCO SEMEAR",
                "code" => 743,
                "full_name" => "Banco Semear S.A."
            ],
            [
                "ispb" => "00806535",
                "name" => "PLANNER CV S.A.",
                "code" => 100,
                "full_name" => "Planner Corretora de Valores S.A."
            ],
            [
                "ispb" => "00954288",
                "name" => "FDO GARANTIDOR CRÉDITOS",
                "code" => 541,
                "full_name" => "FUNDO GARANTIDOR DE CREDITOS - FGC"
            ],
            [
                "ispb" => "00997185",
                "name" => "BCO B3 S.A.",
                "code" => 96,
                "full_name" => "Banco B3 S.A."
            ],
            [
                "ispb" => "01023570",
                "name" => "BCO RABOBANK INTL BRASIL S.A.",
                "code" => 747,
                "full_name" => "Banco Rabobank International Brasil S.A."
            ],
            [
                "ispb" => "01027058",
                "name" => "CIELO IP S.A.",
                "code" => 362,
                "full_name" => "CIELO S.A. - INSTITUIÇÃO DE PAGAMENTO"
            ],
            [
                "ispb" => "01073966",
                "name" => "CCR DE ABELARDO LUZ",
                "code" => 322,
                "full_name" => "Cooperativa de Crédito Rural de Abelardo Luz - Sulcredi/Crediluz"
            ],
            [
                "ispb" => "01181521",
                "name" => "BCO COOPERATIVO SICREDI S.A.",
                "code" => 748,
                "full_name" => "BANCO COOPERATIVO SICREDI S.A."
            ],
            [
                "ispb" => "01330387",
                "name" => "CREHNOR LARANJEIRAS",
                "code" => 350,
                "full_name" => "COOPERATIVA DE CRÉDITO RURAL DE PEQUENOS AGRICULTORES E DA REFORMA AGRÁRIA DO CE"
            ],
            [
                "ispb" => "01522368",
                "name" => "BCO BNP PARIBAS BRASIL S A",
                "code" => 752,
                "full_name" => "Banco BNP Paribas Brasil S.A."
            ],
            [
                "ispb" => "01658426",
                "name" => "CECM COOPERFORTE",
                "code" => 379,
                "full_name" => "COOPERFORTE - COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DE FUNCIONÁRIOS DE INSTITU"
            ],
            [
                "ispb" => "01701201",
                "name" => "KIRTON BANK",
                "code" => 399,
                "full_name" => "Kirton Bank S.A. - Banco Múltiplo"
            ],
            [
                "ispb" => "01852137",
                "name" => "BCO BRASILEIRO DE CRÉDITO S.A.",
                "code" => 378,
                "full_name" => "BANCO BRASILEIRO DE CRÉDITO SOCIEDADE ANÔNIMA"
            ],
            [
                "ispb" => "01858774",
                "name" => "BCO BV S.A.",
                "code" => 413,
                "full_name" => "BANCO BV S.A."
            ],
            [
                "ispb" => "02038232",
                "name" => "BANCO SICOOB S.A.",
                "code" => 756,
                "full_name" => "BANCO COOPERATIVO SICOOB S.A. - BANCO SICOOB"
            ],
            [
                "ispb" => "02276653",
                "name" => "TRINUS CAPITAL DTVM",
                "code" => 360,
                "full_name" => "TRINUS CAPITAL DISTRIBUIDORA DE TÍTULOS E VALORES MOBILIÁRIOS S.A."
            ],
            [
                "ispb" => "02318507",
                "name" => "BCO KEB HANA DO BRASIL S.A.",
                "code" => 757,
                "full_name" => "BANCO KEB HANA DO BRASIL S.A."
            ],
            [
                "ispb" => "02332886",
                "name" => "XP INVESTIMENTOS CCTVM S/A",
                "code" => 102,
                "full_name" => "XP INVESTIMENTOS CORRETORA DE CÂMBIO,TÍTULOS E VALORES MOBILIÁRIOS S/A"
            ],
            [
                "ispb" => "02398976",
                "name" => "SISPRIME DO BRASIL - COOP",
                "code" => 84,
                "full_name" => "SISPRIME DO BRASIL - COOPERATIVA DE CRÉDITO"
            ],
            [
                "ispb" => "02685483",
                "name" => "CM CAPITAL MARKETS CCTVM LTDA",
                "code" => 180,
                "full_name" => "CM CAPITAL MARKETS CORRETORA DE CÂMBIO, TÍTULOS E VALORES MOBILIÁRIOS LTDA"
            ],
            [
                "ispb" => "02801938",
                "name" => "BCO MORGAN STANLEY S.A.",
                "code" => 66,
                "full_name" => "BANCO MORGAN STANLEY S.A."
            ],
            [
                "ispb" => "02819125",
                "name" => "UBS BRASIL CCTVM S.A.",
                "code" => 15,
                "full_name" => "UBS Brasil Corretora de Câmbio, Títulos e Valores Mobiliários S.A."
            ],
            [
                "ispb" => "02992317",
                "name" => "TREVISO CC S.A.",
                "code" => 143,
                "full_name" => "Treviso Corretora de Câmbio S.A."
            ],
            [
                "ispb" => "02992335",
                "name" => "CIP SA Siloc",
                "code" => null,
                "full_name" => "CIP S.A"
            ],
            [
                "ispb" => "03012230",
                "name" => "HIPERCARD BM S.A.",
                "code" => 62,
                "full_name" => "Hipercard Banco Múltiplo S.A."
            ],
            [
                "ispb" => "03017677",
                "name" => "BCO. J.SAFRA S.A.",
                "code" => 74,
                "full_name" => "Banco J. Safra S.A."
            ],
            [
                "ispb" => "03046391",
                "name" => "UNIPRIME COOPCENTRAL LTDA.",
                "code" => 99,
                "full_name" => "UNIPRIME CENTRAL NACIONAL - CENTRAL NACIONAL DE COOPERATIVA DE CREDITO"
            ],
            [
                "ispb" => "03215790",
                "name" => "BCO TOYOTA DO BRASIL S.A.",
                "code" => 387,
                "full_name" => "Banco Toyota do Brasil S.A."
            ],
            [
                "ispb" => "03311443",
                "name" => "PARATI - CFI S.A.",
                "code" => 326,
                "full_name" => "PARATI - CREDITO, FINANCIAMENTO E INVESTIMENTO S.A."
            ],
            [
                "ispb" => "03323840",
                "name" => "BCO ALFA S.A.",
                "code" => 25,
                "full_name" => "Banco Alfa S.A."
            ],
            [
                "ispb" => "03532415",
                "name" => "BCO ABN AMRO S.A.",
                "code" => 75,
                "full_name" => "Banco ABN Amro S.A."
            ],
            [
                "ispb" => "03609817",
                "name" => "BCO CARGILL S.A.",
                "code" => 40,
                "full_name" => "Banco Cargill S.A."
            ],
            [
                "ispb" => "03751794",
                "name" => "TERRA INVESTIMENTOS DTVM",
                "code" => 307,
                "full_name" => "Terra Investimentos Distribuidora de Títulos e Valores Mobiliários Ltda."
            ],
            [
                "ispb" => "03844699",
                "name" => "CECM DOS TRAB.PORT. DA G.VITOR",
                "code" => 385,
                "full_name" => "COOPERATIVA DE ECONOMIA E CREDITO MUTUO DOS TRABALHADORES PORTUARIOS DA GRANDE V"
            ],
            [
                "ispb" => "03881423",
                "name" => "SOCINAL S.A. CFI",
                "code" => 425,
                "full_name" => "SOCINAL S.A. - CRÉDITO, FINANCIAMENTO E INVESTIMENTO"
            ],
            [
                "ispb" => "03973814",
                "name" => "SERVICOOP",
                "code" => 190,
                "full_name" => "SERVICOOP - COOPERATIVA DE CRÉDITO DOS SERVIDORES PÚBLICOS ESTADUAIS E MUNICIPAI"
            ],
            [
                "ispb" => "04062902",
                "name" => "OZ CORRETORA DE CÂMBIO S.A.",
                "code" => 296,
                "full_name" => "OZ CORRETORA DE CÂMBIO S.A."
            ],
            [
                "ispb" => "04184779",
                "name" => "BANCO BRADESCARD",
                "code" => 63,
                "full_name" => "Banco Bradescard S.A."
            ],
            [
                "ispb" => "04257795",
                "name" => "NOVA FUTURA CTVM LTDA.",
                "code" => 191,
                "full_name" => "Nova Futura Corretora de Títulos e Valores Mobiliários Ltda."
            ],
            [
                "ispb" => "04307598",
                "name" => "FIDUCIA SCMEPP LTDA",
                "code" => 382,
                "full_name" => "FIDÚCIA SOCIEDADE DE CRÉDITO AO MICROEMPREENDEDOR E À EMPRESA DE PEQUENO PORTE L"
            ],
            [
                "ispb" => "04332281",
                "name" => "GOLDMAN SACHS DO BRASIL BM S.A",
                "code" => 64,
                "full_name" => "GOLDMAN SACHS DO BRASIL BANCO MULTIPLO S.A."
            ],
            [
                "ispb" => "04391007",
                "name" => "CAMARA INTERBANCARIA DE PAGAMENTOS - CIP",
                "code" => null,
                "full_name" => "CIP S.A"
            ],
            [
                "ispb" => "04546162",
                "name" => "CCM SERV. PÚBLICOS SP",
                "code" => 459,
                "full_name" => "COOPERATIVA DE CRÉDITO MÚTUO DE SERVIDORES PÚBLICOS DO ESTADO DE SÃO PAULO - CRE"
            ],
            [
                "ispb" => "04632856",
                "name" => "CREDISIS CENTRAL DE COOPERATIVAS DE CRÉDITO LTDA.",
                "code" => 97,
                "full_name" => "Credisis - Central de Cooperativas de Crédito Ltda."
            ],
            [
                "ispb" => "04715685",
                "name" => "CCM DESP TRÂNS SC E RS",
                "code" => 16,
                "full_name" => "COOPERATIVA DE CRÉDITO MÚTUO DOS DESPACHANTES DE TRÂNSITO DE SANTA CATARINA E RI"
            ],
            [
                "ispb" => "04814563",
                "name" => "BCO AFINZ S.A. - BM",
                "code" => 299,
                "full_name" => "BANCO AFINZ S.A. - BANCO MÚLTIPLO"
            ],
            [
                "ispb" => "04831810",
                "name" => "CECM SERV PUBL PINHÃO",
                "code" => 471,
                "full_name" => "COOPERATIVA DE ECONOMIA E CREDITO MUTUO DOS SERVIDORES PUBLICOS DE PINHÃO - CRES"
            ],
            [
                "ispb" => "04862600",
                "name" => "PORTOSEG S.A. CFI",
                "code" => 468,
                "full_name" => "PORTOSEG S.A. - CREDITO, FINANCIAMENTO E INVESTIMENTO"
            ],
            [
                "ispb" => "04866275",
                "name" => "BANCO INBURSA",
                "code" => 12,
                "full_name" => "Banco Inbursa S.A."
            ],
            [
                "ispb" => "04902979",
                "name" => "BCO DA AMAZONIA S.A.",
                "code" => 3,
                "full_name" => "BANCO DA AMAZONIA S.A."
            ],
            [
                "ispb" => "04913129",
                "name" => "CONFIDENCE CC S.A.",
                "code" => 60,
                "full_name" => "Confidence Corretora de Câmbio S.A."
            ],
            [
                "ispb" => "04913711",
                "name" => "BCO DO EST. DO PA S.A.",
                "code" => 37,
                "full_name" => "Banco do Estado do Pará S.A."
            ],
            [
                "ispb" => "05192316",
                "name" => "VIA CERTA FINANCIADORA S.A. - CFI",
                "code" => 411,
                "full_name" => "Via Certa Financiadora S.A. - Crédito, Financiamento e Investimentos"
            ],
            [
                "ispb" => "05351887",
                "name" => "ZEMA CFI S/A",
                "code" => 359,
                "full_name" => "ZEMA CRÉDITO, FINANCIAMENTO E INVESTIMENTO S/A"
            ],
            [
                "ispb" => "05442029",
                "name" => "CASA CREDITO S.A. SCM",
                "code" => 159,
                "full_name" => "Casa do Crédito S.A. Sociedade de Crédito ao Microempreendedor"
            ],
            [
                "ispb" => "05463212",
                "name" => "COOPCENTRAL AILOS",
                "code" => 85,
                "full_name" => "Cooperativa Central de Crédito - Ailos"
            ],
            [
                "ispb" => "05491616",
                "name" => "COOP CREDITAG",
                "code" => 400,
                "full_name" => "COOPERATIVA DE CRÉDITO, POUPANÇA E SERVIÇOS FINANCEIROS DO CENTRO OESTE - CREDIT"
            ],
            [
                "ispb" => "05676026",
                "name" => "CREDIARE CFI S.A.",
                "code" => 429,
                "full_name" => "Crediare S.A. - Crédito, financiamento e investimento"
            ],
            [
                "ispb" => "05684234",
                "name" => "PLANNER SOCIEDADE DE CRÉDITO DIRETO",
                "code" => 410,
                "full_name" => "PLANNER SOCIEDADE DE CRÉDITO DIRETO S.A."
            ],
            [
                "ispb" => "05790149",
                "name" => "CENTRAL COOPERATIVA DE CRÉDITO NO ESTADO DO ESPÍRITO SANTO",
                "code" => 114,
                "full_name" => "Central Cooperativa de Crédito no Estado do Espírito Santo - CECOOP"
            ],
            [
                "ispb" => "05841967",
                "name" => "CECM FABRIC CALÇADOS SAPIRANGA",
                "code" => 328,
                "full_name" => "COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS FABRICANTES DE CALÇADOS DE SAPIRANGA"
            ],
            [
                "ispb" => "06271464",
                "name" => "BCO BBI S.A.",
                "code" => 36,
                "full_name" => "Banco Bradesco BBI S.A."
            ],
            [
                "ispb" => "07138049",
                "name" => "LIGA INVEST DTVM LTDA.",
                "code" => 469,
                "full_name" => "LIGA INVEST DISTRIBUIDORA DE TÍTULOS E VALORES MOBILIÁRIOS LTDA"
            ],
            [
                "ispb" => "07207996",
                "name" => "BCO BRADESCO FINANC. S.A.",
                "code" => 394,
                "full_name" => "Banco Bradesco Financiamentos S.A."
            ],
            [
                "ispb" => "07237373",
                "name" => "BCO DO NORDESTE DO BRASIL S.A.",
                "code" => 4,
                "full_name" => "Banco do Nordeste do Brasil S.A."
            ],
            [
                "ispb" => "07253654",
                "name" => "HEDGE INVESTMENTS DTVM LTDA.",
                "code" => 458,
                "full_name" => "HEDGE INVESTMENTS DISTRIBUIDORA DE TÍTULOS E VALORES MOBILIÁRIOS LTDA."
            ],
            [
                "ispb" => "07450604",
                "name" => "BCO CCB BRASIL S.A.",
                "code" => 320,
                "full_name" => "China Construction Bank (Brasil) Banco Múltiplo S/A"
            ],
            [
                "ispb" => "07512441",
                "name" => "HS FINANCEIRA",
                "code" => 189,
                "full_name" => "HS FINANCEIRA S/A CREDITO, FINANCIAMENTO E INVESTIMENTOS"
            ],
            [
                "ispb" => "07652226",
                "name" => "LECCA CFI S.A.",
                "code" => 105,
                "full_name" => "Lecca Crédito, Financiamento e Investimento S/A"
            ],
            [
                "ispb" => "07656500",
                "name" => "BCO KDB BRASIL S.A.",
                "code" => 76,
                "full_name" => "Banco KDB do Brasil S.A."
            ],
            [
                "ispb" => "07679404",
                "name" => "BANCO TOPÁZIO S.A.",
                "code" => 82,
                "full_name" => "BANCO TOPÁZIO S.A."
            ],
            [
                "ispb" => "07693858",
                "name" => "HSCM SCMEPP LTDA.",
                "code" => 312,
                "full_name" => "HSCM - SOCIEDADE DE CRÉDITO AO MICROEMPREENDEDOR E À EMPRESA DE PEQUENO PORTE LT"
            ],
            [
                "ispb" => "07799277",
                "name" => "VALOR SCD S.A.",
                "code" => 195,
                "full_name" => "VALOR SOCIEDADE DE CRÉDITO DIRETO S.A."
            ],
            [
                "ispb" => "07945233",
                "name" => "POLOCRED SCMEPP LTDA.",
                "code" => 93,
                "full_name" => "PÓLOCRED   SOCIEDADE DE CRÉDITO AO MICROEMPREENDEDOR E À EMPRESA DE PEQUENO PORT"
            ],
            [
                "ispb" => "08240446",
                "name" => "CCR DE IBIAM",
                "code" => 391,
                "full_name" => "COOPERATIVA DE CREDITO RURAL DE IBIAM - SULCREDI/IBIAM"
            ],
            [
                "ispb" => "08253539",
                "name" => "CCR DE SÃO MIGUEL DO OESTE",
                "code" => 273,
                "full_name" => "Cooperativa de Crédito Rural de São Miguel do Oeste - Sulcredi/São Miguel"
            ],
            [
                "ispb" => "08357240",
                "name" => "BCO CSF S.A.",
                "code" => 368,
                "full_name" => "Banco CSF S.A."
            ],
            [
                "ispb" => "08561701",
                "name" => "PAGSEGURO INTERNET IP S.A.",
                "code" => 290,
                "full_name" => "PAGSEGURO INTERNET INSTITUIÇÃO DE PAGAMENTO S.A."
            ],
            [
                "ispb" => "08609934",
                "name" => "MONEYCORP BCO DE CÂMBIO S.A.",
                "code" => 259,
                "full_name" => "MONEYCORP BANCO DE CÂMBIO S.A."
            ],
            [
                "ispb" => "08673569",
                "name" => "F D GOLD DTVM LTDA",
                "code" => 395,
                "full_name" => "F.D'GOLD - DISTRIBUIDORA DE TÍTULOS E VALORES MOBILIÁRIOS LTDA."
            ],
            [
                "ispb" => "09089356",
                "name" => "EFÍ S.A. - IP",
                "code" => 364,
                "full_name" => "EFÍ S.A. - INSTITUIÇÃO DE PAGAMENTO"
            ],
            [
                "ispb" => "09105360",
                "name" => "ICAP DO BRASIL CTVM LTDA.",
                "code" => 157,
                "full_name" => "ICAP do Brasil Corretora de Títulos e Valores Mobiliários Ltda."
            ],
            [
                "ispb" => "09210106",
                "name" => "SOCRED SA - SCMEPP",
                "code" => 183,
                "full_name" => "SOCRED S.A. - SOCIEDADE DE CRÉDITO AO MICROEMPREENDEDOR E À EMPRESA DE PEQUENO P"
            ],
            [
                "ispb" => "09274232",
                "name" => "STATE STREET BR S.A. BCO COMERCIAL",
                "code" => 14,
                "full_name" => "STATE STREET BRASIL S.A. - BANCO COMERCIAL"
            ],
            [
                "ispb" => "09313766",
                "name" => "CARUANA SCFI",
                "code" => 130,
                "full_name" => "CARUANA S.A. - SOCIEDADE DE CRÉDITO, FINANCIAMENTO E INVESTIMENTO"
            ],
            [
                "ispb" => "09464032",
                "name" => "MIDWAY S.A. - SCFI",
                "code" => 358,
                "full_name" => "MIDWAY S.A. - CRÉDITO, FINANCIAMENTO E INVESTIMENTO"
            ],
            [
                "ispb" => "09512542",
                "name" => "CODEPE CVC S.A.",
                "code" => 127,
                "full_name" => "Codepe Corretora de Valores e Câmbio S.A."
            ],
            [
                "ispb" => "09516419",
                "name" => "PICPAY BANK - BANCO MÚLTIPLO S.A",
                "code" => 79,
                "full_name" => "PICPAY BANK - BANCO MÚLTIPLO S.A"
            ],
            [
                "ispb" => "09526594",
                "name" => "MASTER BI S.A.",
                "code" => 141,
                "full_name" => "BANCO MASTER DE INVESTIMENTO S.A."
            ],
            [
                "ispb" => "09554480",
                "name" => "SUPERDIGITAL I.P. S.A.",
                "code" => 340,
                "full_name" => "SUPERDIGITAL INSTITUIÇÃO DE PAGAMENTO S.A."
            ],
            [
                "ispb" => "10264663",
                "name" => "BANCOSEGURO S.A.",
                "code" => 81,
                "full_name" => "BancoSeguro S.A."
            ],
            [
                "ispb" => "10371492",
                "name" => "BCO YAMAHA MOTOR S.A.",
                "code" => 475,
                "full_name" => "Banco Yamaha Motor do Brasil S.A."
            ],
            [
                "ispb" => "10398952",
                "name" => "CRESOL CONFEDERAÇÃO",
                "code" => 133,
                "full_name" => "CONFEDERAÇÃO NACIONAL DAS COOPERATIVAS CENTRAIS DE CRÉDITO E ECONOMIA FAMILIAR E"
            ],
            [
                "ispb" => "10573521",
                "name" => "MERCADO PAGO IP LTDA.",
                "code" => 323,
                "full_name" => "MERCADO PAGO INSTITUIÇÃO DE PAGAMENTO LTDA."
            ],
            [
                "ispb" => "10664513",
                "name" => "BCO AGIBANK S.A.",
                "code" => 121,
                "full_name" => "Banco Agibank S.A."
            ],
            [
                "ispb" => "10690848",
                "name" => "BCO DA CHINA BRASIL S.A.",
                "code" => 83,
                "full_name" => "Banco da China Brasil S.A."
            ],
            [
                "ispb" => "10853017",
                "name" => "GET MONEY CC LTDA",
                "code" => 138,
                "full_name" => "Get Money Corretora de Câmbio S.A."
            ],
            [
                "ispb" => "10866788",
                "name" => "BCO BANDEPE S.A.",
                "code" => 24,
                "full_name" => "Banco Bandepe S.A."
            ],
            [
                "ispb" => "11165756",
                "name" => "GLOBAL SCM LTDA",
                "code" => 384,
                "full_name" => "GLOBAL FINANÇAS SOCIEDADE DE CRÉDITO AO MICROEMPREENDEDOR E À EMPRESA DE PEQUENO"
            ],
            [
                "ispb" => "11285104",
                "name" => "NEON FINANCEIRA - CFI S.A.",
                "code" => 426,
                "full_name" => "NEON FINANCEIRA - CRÉDITO, FINANCIAMENTO E INVESTIMENTO S.A."
            ],
            [
                "ispb" => "11476673",
                "name" => "BANCO RANDON S.A.",
                "code" => 88,
                "full_name" => "BANCO RANDON S.A."
            ],
            [
                "ispb" => "11495073",
                "name" => "OM DTVM LTDA",
                "code" => 319,
                "full_name" => "OM DISTRIBUIDORA DE TÍTULOS E VALORES MOBILIÁRIOS LTDA"
            ],
            [
                "ispb" => "11581339",
                "name" => "BMP SCMEPP LTDA",
                "code" => 274,
                "full_name" => "BMP SOCIEDADE DE CRÉDITO AO MICROEMPREENDEDOR E A EMPRESA DE PEQUENO PORTE LTDA."
            ],
            [
                "ispb" => "11703662",
                "name" => "TRAVELEX BANCO DE CÂMBIO S.A.",
                "code" => 95,
                "full_name" => "Travelex Banco de Câmbio S.A."
            ],
            [
                "ispb" => "11758741",
                "name" => "BANCO FINAXIS",
                "code" => 94,
                "full_name" => "Banco Finaxis S.A."
            ],
            [
                "ispb" => "11760553",
                "name" => "GAZINCRED S.A. SCFI",
                "code" => 478,
                "full_name" => "GAZINCRED S.A. SOCIEDADE DE CRÉDITO, FINANCIAMENTO E INVESTIMENTO"
            ],
            [
                "ispb" => "11970623",
                "name" => "BCO SENFF S.A.",
                "code" => 276,
                "full_name" => "BANCO SENFF S.A."
            ],
            [
                "ispb" => "12392983",
                "name" => "MIRAE ASSET CCTVM LTDA",
                "code" => 447,
                "full_name" => "MIRAE ASSET WEALTH MANAGEMENT (BRAZIL) CORRETORA DE CÂMBIO, TÍTULOS E VALORES MO"
            ],
            [
                "ispb" => "13009717",
                "name" => "BCO DO EST. DE SE S.A.",
                "code" => 47,
                "full_name" => "Banco do Estado de Sergipe S.A."
            ],
            [
                "ispb" => "13059145",
                "name" => "BEXS BCO DE CAMBIO S.A.",
                "code" => 144,
                "full_name" => "BEXS BANCO DE CÂMBIO S/A"
            ],
            [
                "ispb" => "13140088",
                "name" => "ACESSO SOLUÇÕES DE PAGAMENTO S.A. - INSTITUIÇÃO DE PAGAMENTO",
                "code" => 332,
                "full_name" => "ACESSO SOLUÇÕES DE PAGAMENTO S.A. - INSTITUIÇÃO DE PAGAMENTO"
            ],
            [
                "ispb" => "13203354",
                "name" => "FITBANK IP",
                "code" => 450,
                "full_name" => "FITBANK INSTITUIÇÃO DE PAGAMENTOS ELETRÔNICOS S.A."
            ],
            [
                "ispb" => "13220493",
                "name" => "BR PARTNERS BI",
                "code" => 126,
                "full_name" => "BR Partners Banco de Investimento S.A."
            ],
            [
                "ispb" => "13293225",
                "name" => "ÓRAMA DTVM S.A.",
                "code" => 325,
                "full_name" => "Órama Distribuidora de Títulos e Valores Mobiliários S.A."
            ],
            [
                "ispb" => "13370835",
                "name" => "DOCK IP S.A.",
                "code" => 301,
                "full_name" => "DOCK INSTITUIÇÃO DE PAGAMENTO S.A."
            ],
            [
                "ispb" => "13486793",
                "name" => "BRL TRUST DTVM SA",
                "code" => 173,
                "full_name" => "BRL Trust Distribuidora de Títulos e Valores Mobiliários S.A."
            ],
            [
                "ispb" => "13673855",
                "name" => "FRAM CAPITAL DTVM S.A.",
                "code" => 331,
                "full_name" => "Fram Capital Distribuidora de Títulos e Valores Mobiliários S.A."
            ],
            [
                "ispb" => "13720915",
                "name" => "BCO WESTERN UNION",
                "code" => 119,
                "full_name" => "Banco Western Union do Brasil S.A."
            ],
            [
                "ispb" => "13884775",
                "name" => "HUB IP S.A.",
                "code" => 396,
                "full_name" => "HUB INSTITUIÇÃO DE PAGAMENTO S.A."
            ],
            [
                "ispb" => "13935893",
                "name" => "CELCOIN IP S.A.",
                "code" => 509,
                "full_name" => "CELCOIN INSTITUICAO DE PAGAMENTO S.A."
            ],
            [
                "ispb" => "14190547",
                "name" => "CAMBIONET CC LTDA",
                "code" => 309,
                "full_name" => "CAMBIONET CORRETORA DE CÂMBIO LTDA."
            ],
            [
                "ispb" => "14388334",
                "name" => "PARANA BCO S.A.",
                "code" => 254,
                "full_name" => "PARANÁ BANCO S.A."
            ],
            [
                "ispb" => "14511781",
                "name" => "BARI CIA HIPOTECÁRIA",
                "code" => 268,
                "full_name" => "BARI COMPANHIA HIPOTECÁRIA"
            ],
            [
                "ispb" => "15111975",
                "name" => "IUGU IP S.A.",
                "code" => 401,
                "full_name" => "IUGU INSTITUIÇÃO DE PAGAMENTO S.A."
            ],
            [
                "ispb" => "15114366",
                "name" => "BCO BOCOM BBM S.A.",
                "code" => 107,
                "full_name" => "Banco Bocom BBM S.A."
            ],
            [
                "ispb" => "15124464",
                "name" => "BANCO BESA S.A.",
                "code" => 334,
                "full_name" => "BANCO BESA S.A."
            ],
            [
                "ispb" => "15173776",
                "name" => "SOCIAL BANK S/A",
                "code" => 412,
                "full_name" => "SOCIAL BANK BANCO MÚLTIPLO S/A"
            ],
            [
                "ispb" => "15357060",
                "name" => "BCO WOORI BANK DO BRASIL S.A.",
                "code" => 124,
                "full_name" => "Banco Woori Bank do Brasil S.A."
            ],
            [
                "ispb" => "15581638",
                "name" => "FACTA S.A. CFI",
                "code" => 149,
                "full_name" => "Facta Financeira S.A. - Crédito Financiamento e Investimento"
            ],
            [
                "ispb" => "16501555",
                "name" => "STONE IP S.A.",
                "code" => 197,
                "full_name" => "STONE INSTITUIÇÃO DE PAGAMENTO S.A."
            ],
            [
                "ispb" => "16695922",
                "name" => "ID CTVM",
                "code" => 439,
                "full_name" => "ID CORRETORA DE TÍTULOS E VALORES MOBILIÁRIOS S.A."
            ],
            [
                "ispb" => "16927221",
                "name" => "AMAZÔNIA CC LTDA.",
                "code" => 313,
                "full_name" => "AMAZÔNIA CORRETORA DE CÂMBIO LTDA."
            ],
            [
                "ispb" => "16944141",
                "name" => "BROKER BRASIL CC LTDA.",
                "code" => 142,
                "full_name" => "Broker Brasil Corretora de Câmbio Ltda."
            ],
            [
                "ispb" => "17079937",
                "name" => "PINBANK IP",
                "code" => 529,
                "full_name" => "PINBANK BRASIL INSTITUIÇÃO DE PAGAMENTO S.A."
            ],
            [
                "ispb" => "17184037",
                "name" => "BCO MERCANTIL DO BRASIL S.A.",
                "code" => 389,
                "full_name" => "Banco Mercantil do Brasil S.A."
            ],
            [
                "ispb" => "17298092",
                "name" => "BCO ITAÚ BBA S.A.",
                "code" => 184,
                "full_name" => "Banco Itaú BBA S.A."
            ],
            [
                "ispb" => "17351180",
                "name" => "BCO TRIANGULO S.A.",
                "code" => 634,
                "full_name" => "BANCO TRIANGULO S.A."
            ],
            [
                "ispb" => "17352220",
                "name" => "SENSO CCVM S.A.",
                "code" => 545,
                "full_name" => "SENSO CORRETORA DE CAMBIO E VALORES MOBILIARIOS S.A"
            ],
            [
                "ispb" => "17453575",
                "name" => "ICBC DO BRASIL BM S.A.",
                "code" => 132,
                "full_name" => "ICBC do Brasil Banco Múltiplo S.A."
            ],
            [
                "ispb" => "17772370",
                "name" => "VIPS CC LTDA.",
                "code" => 298,
                "full_name" => "Vip's Corretora de Câmbio Ltda."
            ],
            [
                "ispb" => "17826860",
                "name" => "BMS SCD S.A.",
                "code" => 377,
                "full_name" => "BMS SOCIEDADE DE CRÉDITO DIRETO S.A."
            ],
            [
                "ispb" => "18188384",
                "name" => "CREFAZ SCMEPP LTDA",
                "code" => 321,
                "full_name" => "CREFAZ SOCIEDADE DE CRÉDITO AO MICROEMPREENDEDOR E A EMPRESA DE PEQUENO PORTE LT"
            ],
            [
                "ispb" => "18236120",
                "name" => "NU PAGAMENTOS - IP",
                "code" => 260,
                "full_name" => "NU PAGAMENTOS S.A. - INSTITUIÇÃO DE PAGAMENTO"
            ],
            [
                "ispb" => "18394228",
                "name" => "CDC SCD S.A.",
                "code" => 470,
                "full_name" => "CDC SOCIEDADE DE CRÉDITO DIRETO S.A."
            ],
            [
                "ispb" => "18520834",
                "name" => "UBS BRASIL BI S.A.",
                "code" => 129,
                "full_name" => "UBS Brasil Banco de Investimento S.A."
            ],
            [
                "ispb" => "19307785",
                "name" => "BRAZA BANK S.A. BCO DE CÂMBIO",
                "code" => 128,
                "full_name" => "BRAZA BANK S.A. BANCO DE CÂMBIO"
            ],
            [
                "ispb" => "19324634",
                "name" => "LAMARA SCD S.A.",
                "code" => 416,
                "full_name" => "LAMARA SOCIEDADE DE CRÉDITO DIRETO S.A."
            ],
            [
                "ispb" => "19540550",
                "name" => "ASAAS IP S.A.",
                "code" => 461,
                "full_name" => "ASAAS GESTÃO FINANCEIRA INSTITUIÇÃO DE PAGAMENTO S.A."
            ],
            [
                "ispb" => "20155248",
                "name" => "PARMETAL DTVM LTDA",
                "code" => 194,
                "full_name" => "PARMETAL DISTRIBUIDORA DE TÍTULOS E VALORES MOBILIÁRIOS LTDA"
            ],
            [
                "ispb" => "20855875",
                "name" => "NEON PAGAMENTOS S.A. IP",
                "code" => 536,
                "full_name" => "NEON PAGAMENTOS S.A. - INSTITUIÇÃO DE PAGAMENTO"
            ],
            [
                "ispb" => "21018182",
                "name" => "EBANX IP LTDA.",
                "code" => 383,
                "full_name" => "EBANX INSTITUICAO DE PAGAMENTOS LTDA."
            ],
            [
                "ispb" => "21332862",
                "name" => "CARTOS SCD S.A.",
                "code" => 324,
                "full_name" => "CARTOS SOCIEDADE DE CRÉDITO DIRETO S.A."
            ],
            [
                "ispb" => "22610500",
                "name" => "VORTX DTVM LTDA.",
                "code" => 310,
                "full_name" => "VORTX DISTRIBUIDORA DE TITULOS E VALORES MOBILIARIOS LTDA."
            ],
            [
                "ispb" => "22896431",
                "name" => "PICPAY",
                "code" => 380,
                "full_name" => "PICPAY INSTITUIçãO DE PAGAMENTO S.A."
            ],
            [
                "ispb" => "23862762",
                "name" => "WILL FINANCEIRA S.A.CFI",
                "code" => 280,
                "full_name" => "WILL FINANCEIRA S.A. CRÉDITO, FINANCIAMENTO E INVESTIMENTO"
            ],
            [
                "ispb" => "24074692",
                "name" => "GUITTA CC LTDA",
                "code" => 146,
                "full_name" => "GUITTA CORRETORA DE CAMBIO LTDA."
            ],
            [
                "ispb" => "24537861",
                "name" => "FFA SCMEPP LTDA.",
                "code" => 343,
                "full_name" => "FFA SOCIEDADE DE CRÉDITO AO MICROEMPREENDEDOR E À EMPRESA DE PEQUENO PORTE LTDA."
            ],
            [
                "ispb" => "26563270",
                "name" => "COOP DE PRIMAVERA DO LESTE",
                "code" => 279,
                "full_name" => "PRIMACREDI COOPERATIVA DE CRÉDITO DE PRIMAVERA DO LESTE"
            ],
            [
                "ispb" => "27098060",
                "name" => "BANCO DIGIO",
                "code" => 335,
                "full_name" => "Banco Digio S.A."
            ],
            [
                "ispb" => "27214112",
                "name" => "AL5 S.A. CFI",
                "code" => 349,
                "full_name" => "AL5 S.A. CRÉDITO, FINANCIAMENTO E INVESTIMENTO"
            ],
            [
                "ispb" => "27302181",
                "name" => "CRED-UFES",
                "code" => 427,
                "full_name" => "COOPERATIVA DE CREDITO DOS SERVIDORES DA UNIVERSIDADE FEDERAL DO ESPIRITO SANTO"
            ],
            [
                "ispb" => "27351731",
                "name" => "REALIZE CFI S.A.",
                "code" => 374,
                "full_name" => "REALIZE CRÉDITO, FINANCIAMENTO E INVESTIMENTO S.A."
            ],
            [
                "ispb" => "27652684",
                "name" => "GENIAL INVESTIMENTOS CVM S.A.",
                "code" => 278,
                "full_name" => "Genial Investimentos Corretora de Valores Mobiliários S.A."
            ],
            [
                "ispb" => "27842177",
                "name" => "IB CCTVM S.A.",
                "code" => 271,
                "full_name" => "IB Corretora de Câmbio, Títulos e Valores Mobiliários S.A."
            ],
            [
                "ispb" => "28127603",
                "name" => "BCO BANESTES S.A.",
                "code" => 21,
                "full_name" => "BANESTES S.A. BANCO DO ESTADO DO ESPIRITO SANTO"
            ],
            [
                "ispb" => "28195667",
                "name" => "BCO ABC BRASIL S.A.",
                "code" => 246,
                "full_name" => "Banco ABC Brasil S.A."
            ],
            [
                "ispb" => "28650236",
                "name" => "BS2 DTVM S.A.",
                "code" => 292,
                "full_name" => "BS2 Distribuidora de Títulos e Valores Mobiliários S.A."
            ],
            [
                "ispb" => "28719664",
                "name" => "Balcão B3",
                "code" => null,
                "full_name" => "Sistema do Balcão B3"
            ],
            [
                "ispb" => "29011780",
                "name" => "CIP SA C3",
                "code" => null,
                "full_name" => "CIP S.A"
            ],
            [
                "ispb" => "29030467",
                "name" => "SCOTIABANK BRASIL",
                "code" => 751,
                "full_name" => "Scotiabank Brasil S.A. Banco Múltiplo"
            ],
            [
                "ispb" => "29162769",
                "name" => "TORO CTVM S.A.",
                "code" => 352,
                "full_name" => "TORO CORRETORA DE TÍTULOS E VALORES MOBILIÁRIOS S.A."
            ],
            [
                "ispb" => "30306294",
                "name" => "BANCO BTG PACTUAL S.A.",
                "code" => 208,
                "full_name" => "Banco BTG Pactual S.A."
            ],
            [
                "ispb" => "30680829",
                "name" => "NU FINANCEIRA S.A. CFI",
                "code" => 386,
                "full_name" => "NU FINANCEIRA S.A. - Sociedade de Crédito, Financiamento e Investimento"
            ],
            [
                "ispb" => "30723886",
                "name" => "BCO MODAL S.A.",
                "code" => 746,
                "full_name" => "Banco Modal S.A."
            ],
            [
                "ispb" => "30980539",
                "name" => "U4C INSTITUIÇÃO DE PAGAMENTO S.A.",
                "code" => 546,
                "full_name" => "U4C INSTITUIÇÃO DE PAGAMENTO S.A."
            ],
            [
                "ispb" => "31597552",
                "name" => "BCO CLASSICO S.A.",
                "code" => 241,
                "full_name" => "BANCO CLASSICO S.A."
            ],
            [
                "ispb" => "31749596",
                "name" => "IDEAL CTVM S.A.",
                "code" => 398,
                "full_name" => "IDEAL CORRETORA DE TÍTULOS E VALORES MOBILIÁRIOS S.A."
            ],
            [
                "ispb" => "31872495",
                "name" => "BCO C6 S.A.",
                "code" => 336,
                "full_name" => "Banco C6 S.A."
            ],
            [
                "ispb" => "31880826",
                "name" => "BCO GUANABARA S.A.",
                "code" => 612,
                "full_name" => "Banco Guanabara S.A."
            ],
            [
                "ispb" => "31895683",
                "name" => "BCO INDUSTRIAL DO BRASIL S.A.",
                "code" => 604,
                "full_name" => "Banco Industrial do Brasil S.A."
            ],
            [
                "ispb" => "32062580",
                "name" => "BCO CREDIT SUISSE S.A.",
                "code" => 505,
                "full_name" => "Banco Credit Suisse (Brasil) S.A."
            ],
            [
                "ispb" => "32402502",
                "name" => "QI SCD S.A.",
                "code" => 329,
                "full_name" => "QI Sociedade de Crédito Direto S.A."
            ],
            [
                "ispb" => "32648370",
                "name" => "FAIR CC S.A.",
                "code" => 196,
                "full_name" => "FAIR CORRETORA DE CAMBIO S.A."
            ],
            [
                "ispb" => "32997490",
                "name" => "CREDITAS SCD",
                "code" => 342,
                "full_name" => "Creditas Sociedade de Crédito Direto S.A."
            ],
            [
                "ispb" => "33042151",
                "name" => "BCO LA NACION ARGENTINA",
                "code" => 300,
                "full_name" => "Banco de la Nacion Argentina"
            ],
            [
                "ispb" => "33042953",
                "name" => "CITIBANK N.A.",
                "code" => 477,
                "full_name" => "Citibank N.A."
            ],
            [
                "ispb" => "33132044",
                "name" => "BCO CEDULA S.A.",
                "code" => 266,
                "full_name" => "BANCO CEDULA S.A."
            ],
            [
                "ispb" => "33147315",
                "name" => "BCO BRADESCO BERJ S.A.",
                "code" => 122,
                "full_name" => "Banco Bradesco BERJ S.A."
            ],
            [
                "ispb" => "33172537",
                "name" => "BCO J.P. MORGAN S.A.",
                "code" => 376,
                "full_name" => "BANCO J.P. MORGAN S.A."
            ],
            [
                "ispb" => "33264668",
                "name" => "BCO XP S.A.",
                "code" => 348,
                "full_name" => "Banco XP S.A."
            ],
            [
                "ispb" => "33466988",
                "name" => "BCO CAIXA GERAL BRASIL S.A.",
                "code" => 473,
                "full_name" => "Banco Caixa Geral - Brasil S.A."
            ],
            [
                "ispb" => "33479023",
                "name" => "BCO CITIBANK S.A.",
                "code" => 745,
                "full_name" => "Banco Citibank S.A."
            ],
            [
                "ispb" => "33603457",
                "name" => "BCO RODOBENS S.A.",
                "code" => 120,
                "full_name" => "BANCO RODOBENS S.A."
            ],
            [
                "ispb" => "33644196",
                "name" => "BCO FATOR S.A.",
                "code" => 265,
                "full_name" => "Banco Fator S.A."
            ],
            [
                "ispb" => "33657248",
                "name" => "BNDES",
                "code" => 7,
                "full_name" => "BANCO NACIONAL DE DESENVOLVIMENTO ECONOMICO E SOCIAL"
            ],
            [
                "ispb" => "33775974",
                "name" => "ATIVA S.A. INVESTIMENTOS CCTVM",
                "code" => 188,
                "full_name" => "ATIVA INVESTIMENTOS S.A. CORRETORA DE TÍTULOS, CÂMBIO E VALORES"
            ],
            [
                "ispb" => "33862244",
                "name" => "BGC LIQUIDEZ DTVM LTDA",
                "code" => 134,
                "full_name" => "BGC LIQUIDEZ DISTRIBUIDORA DE TÍTULOS E VALORES MOBILIÁRIOS LTDA"
            ],
            [
                "ispb" => "33885724",
                "name" => "BANCO ITAÚ CONSIGNADO S.A.",
                "code" => 29,
                "full_name" => "Banco Itaú Consignado S.A."
            ],
            [
                "ispb" => "33886862",
                "name" => "MASTER S/A CCTVM",
                "code" => 467,
                "full_name" => "MASTER S/A CORRETORA DE CâMBIO, TíTULOS E VALORES MOBILIáRIOS"
            ],
            [
                "ispb" => "33923798",
                "name" => "BANCO MASTER",
                "code" => 243,
                "full_name" => "BANCO MASTER S/A"
            ],
            [
                "ispb" => "34088029",
                "name" => "LISTO SCD S.A.",
                "code" => 397,
                "full_name" => "LISTO SOCIEDADE DE CREDITO DIRETO S.A."
            ],
            [
                "ispb" => "34111187",
                "name" => "HAITONG BI DO BRASIL S.A.",
                "code" => 78,
                "full_name" => "Haitong Banco de Investimento do Brasil S.A."
            ],
            [
                "ispb" => "34265629",
                "name" => "INTERCAM CC LTDA",
                "code" => 525,
                "full_name" => "INTERCAM CORRETORA DE CÂMBIO LTDA."
            ],
            [
                "ispb" => "34335592",
                "name" => "ÓTIMO SCD S.A.",
                "code" => 355,
                "full_name" => "ÓTIMO SOCIEDADE DE CRÉDITO DIRETO S.A."
            ],
            [
                "ispb" => "34711571",
                "name" => "VITREO DTVM S.A.",
                "code" => 367,
                "full_name" => "VITREO DISTRIBUIDORA DE TÍTULOS E VALORES MOBILIÁRIOS S.A."
            ],
            [
                "ispb" => "34829992",
                "name" => "REAG DTVM S.A.",
                "code" => 528,
                "full_name" => "REAG DISTRIBUIDORA DE TÍTULOS E VALORES MOBILIÁRIOS S.A."
            ],
            [
                "ispb" => "35551187",
                "name" => "PLANTAE CFI",
                "code" => 445,
                "full_name" => "PLANTAE S.A. - CRÉDITO, FINANCIAMENTO E INVESTIMENTO"
            ],
            [
                "ispb" => "35977097",
                "name" => "UP.P SEP S.A.",
                "code" => 373,
                "full_name" => "UP.P SOCIEDADE DE EMPRÉSTIMO ENTRE PESSOAS S.A."
            ],
            [
                "ispb" => "36113876",
                "name" => "OLIVEIRA TRUST DTVM S.A.",
                "code" => 111,
                "full_name" => "OLIVEIRA TRUST DISTRIBUIDORA DE TÍTULOS E VALORES MOBILIARIOS S.A."
            ],
            [
                "ispb" => "36266751",
                "name" => "FINVEST DTVM",
                "code" => 512,
                "full_name" => "FINVEST DISTRIBUIDORA DE TÍTULOS E VALORES MOBILIÁRIOS LTDA."
            ],
            [
                "ispb" => "36583700",
                "name" => "QISTA S.A. CFI",
                "code" => 516,
                "full_name" => "QISTA S.A. - CRÉDITO, FINANCIAMENTO E INVESTIMENTO"
            ],
            [
                "ispb" => "36586946",
                "name" => "BONUSPAGO SCD S.A.",
                "code" => 408,
                "full_name" => "BONUSPAGO SOCIEDADE DE CRÉDITO DIRETO S.A."
            ],
            [
                "ispb" => "36864992",
                "name" => "MAF DTVM SA",
                "code" => 484,
                "full_name" => "MAF DISTRIBUIDORA DE TÍTULOS E VALORES MOBILIÁRIOS S.A."
            ],
            [
                "ispb" => "36947229",
                "name" => "COBUCCIO S.A. SCFI",
                "code" => 402,
                "full_name" => "COBUCCIO S/A - SOCIEDADE DE CRÉDITO, FINANCIAMENTO E INVESTIMENTOS"
            ],
            [
                "ispb" => "37229413",
                "name" => "SCFI EFÍ S.A.",
                "code" => 507,
                "full_name" => "SOCIEDADE DE CRÉDITO, FINANCIAMENTO E INVESTIMENTO EFÍ S.A."
            ],
            [
                "ispb" => "37241230",
                "name" => "SUMUP SCD S.A.",
                "code" => 404,
                "full_name" => "SUMUP SOCIEDADE DE CRÉDITO DIRETO S.A."
            ],
            [
                "ispb" => "37414009",
                "name" => "ZIPDIN SCD S.A.",
                "code" => 418,
                "full_name" => "ZIPDIN SOLUÇÕES DIGITAIS SOCIEDADE DE CRÉDITO DIRETO S/A"
            ],
            [
                "ispb" => "37526080",
                "name" => "LEND SCD S.A.",
                "code" => 414,
                "full_name" => "LEND SOCIEDADE DE CRÉDITO DIRETO S.A."
            ],
            [
                "ispb" => "37555231",
                "name" => "DM",
                "code" => 449,
                "full_name" => "DM SOCIEDADE DE CRÉDITO DIRETO S.A."
            ],
            [
                "ispb" => "37679449",
                "name" => "MERCADO CRÉDITO SCFI S.A.",
                "code" => 518,
                "full_name" => "MERCADO CRÉDITO SOCIEDADE DE CRÉDITO, FINANCIAMENTO E INVESTIMENTO S.A."
            ],
            [
                "ispb" => "37715993",
                "name" => "ACCREDITO SCD S.A.",
                "code" => 406,
                "full_name" => "ACCREDITO - SOCIEDADE DE CRÉDITO DIRETO S.A."
            ],
            [
                "ispb" => "37880206",
                "name" => "CORA SCD S.A.",
                "code" => 403,
                "full_name" => "CORA SOCIEDADE DE CRÉDITO DIRETO S.A."
            ],
            [
                "ispb" => "38129006",
                "name" => "NUMBRS SCD S.A.",
                "code" => 419,
                "full_name" => "NUMBRS SOCIEDADE DE CRÉDITO DIRETO S.A."
            ],
            [
                "ispb" => "38224857",
                "name" => "DELCRED SCD S.A.",
                "code" => 435,
                "full_name" => "DELCRED SOCIEDADE DE CRÉDITO DIRETO S.A."
            ],
            [
                "ispb" => "38429045",
                "name" => "FÊNIX DTVM LTDA.",
                "code" => 455,
                "full_name" => "FÊNIX DISTRIBUIDORA DE TÍTULOS E VALORES MOBILIÁRIOS LTDA."
            ],
            [
                "ispb" => "39343350",
                "name" => "CC LAR CREDI",
                "code" => 421,
                "full_name" => "LAR COOPERATIVA DE CRÉDITO - LAR CREDI"
            ],
            [
                "ispb" => "39416705",
                "name" => "CREDIHOME SCD",
                "code" => 443,
                "full_name" => "CREDIHOME SOCIEDADE DE CRÉDITO DIRETO S.A."
            ],
            [
                "ispb" => "39519944",
                "name" => "MARU SCD S.A.",
                "code" => 535,
                "full_name" => "MARÚ SOCIEDADE DE CRÉDITO DIRETO S.A."
            ],
            [
                "ispb" => "39587424",
                "name" => "UY3 SCD S/A",
                "code" => 457,
                "full_name" => "UY3 SOCIEDADE DE CRÉDITO DIRETO S/A"
            ],
            [
                "ispb" => "39664698",
                "name" => "CREDSYSTEM SCD S.A.",
                "code" => 428,
                "full_name" => "CREDSYSTEM SOCIEDADE DE CRÉDITO DIRETO S.A."
            ],
            [
                "ispb" => "39669186",
                "name" => "HEMERA DTVM LTDA.",
                "code" => 448,
                "full_name" => "HEMERA DISTRIBUIDORA DE TÍTULOS E VALORES MOBILIÁRIOS LTDA."
            ],
            [
                "ispb" => "39676772",
                "name" => "CREDIFIT SCD S.A.",
                "code" => 452,
                "full_name" => "CREDIFIT SOCIEDADE DE CRÉDITO DIRETO S.A."
            ],
            [
                "ispb" => "39738065",
                "name" => "FFCRED SCD S.A.",
                "code" => 510,
                "full_name" => "FFCRED SOCIEDADE DE CRÉDITO DIRETO S.A.."
            ],
            [
                "ispb" => "39908427",
                "name" => "STARK SCD S.A.",
                "code" => 462,
                "full_name" => "STARK SOCIEDADE DE CRÉDITO DIRETO S.A."
            ],
            [
                "ispb" => "40083667",
                "name" => "CAPITAL CONSIG SCD S.A.",
                "code" => 465,
                "full_name" => "CAPITAL CONSIG SOCIEDADE DE CRÉDITO DIRETO S.A."
            ],
            [
                "ispb" => "40303299",
                "name" => "PORTOPAR DTVM LTDA",
                "code" => 306,
                "full_name" => "PORTOPAR DISTRIBUIDORA DE TITULOS E VALORES MOBILIARIOS LTDA."
            ],
            [
                "ispb" => "40434681",
                "name" => "AZUMI DTVM",
                "code" => 463,
                "full_name" => "AZUMI DISTRIBUIDORA DE TíTULOS E VALORES MOBILIáRIOS LTDA."
            ],
            [
                "ispb" => "40475846",
                "name" => "J17 - SCD S/A",
                "code" => 451,
                "full_name" => "J17 - SOCIEDADE DE CRÉDITO DIRETO S/A"
            ],
            [
                "ispb" => "40654622",
                "name" => "TRINUS SCD S.A.",
                "code" => 444,
                "full_name" => "TRINUS SOCIEDADE DE CRÉDITO DIRETO S.A."
            ],
            [
                "ispb" => "40768766",
                "name" => "LIONS TRUST DTVM",
                "code" => 519,
                "full_name" => "LIONS TRUST DISTRIBUIDORA DE TÍTULOS E VALORES MOBILIÁRIOS LTDA."
            ],
            [
                "ispb" => "41592532",
                "name" => "MÉRITO DTVM LTDA.",
                "code" => 454,
                "full_name" => "MÉRITO DISTRIBUIDORA DE TÍTULOS E VALORES MOBILIÁRIOS LTDA."
            ],
            [
                "ispb" => "42047025",
                "name" => "UNAVANTI SCD S/A",
                "code" => 460,
                "full_name" => "UNAVANTI SOCIEDADE DE CRÉDITO DIRETO S/A"
            ],
            [
                "ispb" => "42066258",
                "name" => "RJI",
                "code" => 506,
                "full_name" => "RJI CORRETORA DE TITULOS E VALORES MOBILIARIOS LTDA"
            ],
            [
                "ispb" => "42259084",
                "name" => "SBCASH SCD",
                "code" => 482,
                "full_name" => "SBCASH SOCIEDADE DE CRÉDITO DIRETO S.A."
            ],
            [
                "ispb" => "42272526",
                "name" => "BNY MELLON BCO S.A.",
                "code" => 17,
                "full_name" => "BNY Mellon Banco S.A."
            ],
            [
                "ispb" => "43180355",
                "name" => "PEFISA S.A. - C.F.I.",
                "code" => 174,
                "full_name" => "PEFISA S.A. - CRÉDITO, FINANCIAMENTO E INVESTIMENTO"
            ],
            [
                "ispb" => "43599047",
                "name" => "SUPERLÓGICA SCD S.A.",
                "code" => 481,
                "full_name" => "SUPERLÓGICA SOCIEDADE DE CRÉDITO DIRETO S.A."
            ],
            [
                "ispb" => "44019481",
                "name" => "PEAK SEP S.A.",
                "code" => 521,
                "full_name" => "PEAK SOCIEDADE DE EMPRÉSTIMO ENTRE PESSOAS S.A."
            ],
            [
                "ispb" => "44077014",
                "name" => "BR-CAPITAL DTVM S.A.",
                "code" => 433,
                "full_name" => "BR-CAPITAL DISTRIBUIDORA DE TÍTULOS E VALORES MOBILIÁRIOS S.A."
            ],
            [
                "ispb" => "44189447",
                "name" => "BCO LA PROVINCIA B AIRES BCE",
                "code" => 495,
                "full_name" => "Banco de La Provincia de Buenos Aires"
            ],
            [
                "ispb" => "44292580",
                "name" => "HR DIGITAL SCD",
                "code" => 523,
                "full_name" => "HR DIGITAL - SOCIEDADE DE CRÉDITO DIRETO S/A"
            ],
            [
                "ispb" => "44478623",
                "name" => "ATICCA SCD S.A.",
                "code" => 527,
                "full_name" => "ATICCA - SOCIEDADE DE CRÉDITO DIRETO S.A."
            ],
            [
                "ispb" => "44683140",
                "name" => "MAGNUM SCD",
                "code" => 511,
                "full_name" => "MAGNUM SOCIEDADE DE CRÉDITO DIRETO S.A."
            ],
            [
                "ispb" => "44728700",
                "name" => "ATF CREDIT SCD S.A.",
                "code" => 513,
                "full_name" => "ATF CREDIT SOCIEDADE DE CRÉDITO DIRETO S.A."
            ],
            [
                "ispb" => "45246410",
                "name" => "BANCO GENIAL",
                "code" => 125,
                "full_name" => "BANCO GENIAL S.A."
            ],
            [
                "ispb" => "45745537",
                "name" => "EAGLE SCD S.A.",
                "code" => 532,
                "full_name" => "EAGLE SOCIEDADE DE CRÉDITO DIRETO S.A."
            ],
            [
                "ispb" => "45756448",
                "name" => "MICROCASH SCMEPP LTDA.",
                "code" => 537,
                "full_name" => "MICROCASH SOCIEDADE DE CRÉDITO AO MICROEMPREENDEDOR E À EMPRESA DE PEQUENO PORTE"
            ],
            [
                "ispb" => "45854066",
                "name" => "WNT CAPITAL DTVM",
                "code" => 524,
                "full_name" => "WNT CAPITAL DISTRIBUIDORA DE TÍTULOS E VALORES MOBILIÁRIOS S.A."
            ],
            [
                "ispb" => "46026562",
                "name" => "MONETARIE SCD",
                "code" => 526,
                "full_name" => "MONETARIE SOCIEDADE DE CRÉDITO DIRETO S.A."
            ],
            [
                "ispb" => "46518205",
                "name" => "JPMORGAN CHASE BANK",
                "code" => 488,
                "full_name" => "JPMorgan Chase Bank, National Association"
            ],
            [
                "ispb" => "47593544",
                "name" => "RED SCD S.A.",
                "code" => 522,
                "full_name" => "RED SOCIEDADE DE CRÉDITO DIRETO S.A."
            ],
            [
                "ispb" => "47873449",
                "name" => "SER FINANCE SCD S.A.",
                "code" => 530,
                "full_name" => "SER FINANCE SOCIEDADE DE CRÉDITO DIRETO S.A."
            ],
            [
                "ispb" => "48795256",
                "name" => "BCO ANDBANK S.A.",
                "code" => 65,
                "full_name" => "Banco AndBank (Brasil) S.A."
            ],
            [
                "ispb" => "50579044",
                "name" => "LEVYCAM CCV LTDA",
                "code" => 145,
                "full_name" => "LEVYCAM - CORRETORA DE CAMBIO E VALORES LTDA."
            ],
            [
                "ispb" => "50585090",
                "name" => "BCV - BCO, CRÉDITO E VAREJO S.A.",
                "code" => 250,
                "full_name" => "BCV - BANCO DE CRÉDITO E VAREJO S.A."
            ],
            [
                "ispb" => "52937216",
                "name" => "BEXS CC S.A.",
                "code" => 253,
                "full_name" => "Bexs Corretora de Câmbio S/A"
            ],
            [
                "ispb" => "53518684",
                "name" => "BCO HSBC S.A.",
                "code" => 269,
                "full_name" => "BANCO HSBC S.A."
            ],
            [
                "ispb" => "54403563",
                "name" => "BCO ARBI S.A.",
                "code" => 213,
                "full_name" => "Banco Arbi S.A."
            ],
            [
                "ispb" => "54641030",
                "name" => "Câmara B3",
                "code" => null,
                "full_name" => "Câmara B3"
            ],
            [
                "ispb" => "55230916",
                "name" => "INTESA SANPAOLO BRASIL S.A. BM",
                "code" => 139,
                "full_name" => "Intesa Sanpaolo Brasil S.A. - Banco Múltiplo"
            ],
            [
                "ispb" => "57839805",
                "name" => "BCO TRICURY S.A.",
                "code" => 18,
                "full_name" => "Banco Tricury S.A."
            ],
            [
                "ispb" => "58160789",
                "name" => "BCO SAFRA S.A.",
                "code" => 422,
                "full_name" => "Banco Safra S.A."
            ],
            [
                "ispb" => "58497702",
                "name" => "BCO LETSBANK S.A.",
                "code" => 630,
                "full_name" => "BANCO LETSBANK S.A."
            ],
            [
                "ispb" => "58616418",
                "name" => "BCO FIBRA S.A.",
                "code" => 224,
                "full_name" => "Banco Fibra S.A."
            ],
            [
                "ispb" => "59109165",
                "name" => "BCO VOLKSWAGEN S.A",
                "code" => 393,
                "full_name" => "Banco Volkswagen S.A."
            ],
            [
                "ispb" => "59118133",
                "name" => "BCO LUSO BRASILEIRO S.A.",
                "code" => 600,
                "full_name" => "Banco Luso Brasileiro S.A."
            ],
            [
                "ispb" => "59274605",
                "name" => "BCO GM S.A.",
                "code" => 390,
                "full_name" => "BANCO GM S.A."
            ],
            [
                "ispb" => "59285411",
                "name" => "BANCO PAN",
                "code" => 623,
                "full_name" => "Banco Pan S.A."
            ],
            [
                "ispb" => "59588111",
                "name" => "BCO VOTORANTIM S.A.",
                "code" => 655,
                "full_name" => "Banco Votorantim S.A."
            ],
            [
                "ispb" => "60394079",
                "name" => "BCO ITAUBANK S.A.",
                "code" => 479,
                "full_name" => "Banco ItauBank S.A."
            ],
            [
                "ispb" => "60498557",
                "name" => "BCO MUFG BRASIL S.A.",
                "code" => 456,
                "full_name" => "Banco MUFG Brasil S.A."
            ],
            [
                "ispb" => "60518222",
                "name" => "BCO SUMITOMO MITSUI BRASIL S.A.",
                "code" => 464,
                "full_name" => "Banco Sumitomo Mitsui Brasileiro S.A."
            ],
            [
                "ispb" => "60701190",
                "name" => "ITAÚ UNIBANCO S.A.",
                "code" => 341,
                "full_name" => "ITAÚ UNIBANCO S.A."
            ],
            [
                "ispb" => "60746948",
                "name" => "BCO BRADESCO S.A.",
                "code" => 237,
                "full_name" => "Banco Bradesco S.A."
            ],
            [
                "ispb" => "60814191",
                "name" => "BCO MERCEDES-BENZ S.A.",
                "code" => 381,
                "full_name" => "BANCO MERCEDES-BENZ DO BRASIL S.A."
            ],
            [
                "ispb" => "60850229",
                "name" => "OMNI BANCO S.A.",
                "code" => 613,
                "full_name" => "Omni Banco S.A."
            ],
            [
                "ispb" => "60889128",
                "name" => "BCO SOFISA S.A.",
                "code" => 637,
                "full_name" => "BANCO SOFISA S.A."
            ],
            [
                "ispb" => "60934221",
                "name" => "Câmbio B3",
                "code" => null,
                "full_name" => "Câmara de Câmbio B3"
            ],
            [
                "ispb" => "61024352",
                "name" => "BANCO VOITER",
                "code" => 653,
                "full_name" => "BANCO VOITER S.A."
            ],
            [
                "ispb" => "61033106",
                "name" => "BCO CREFISA S.A.",
                "code" => 69,
                "full_name" => "Banco Crefisa S.A."
            ],
            [
                "ispb" => "61088183",
                "name" => "BCO MIZUHO S.A.",
                "code" => 370,
                "full_name" => "Banco Mizuho do Brasil S.A."
            ],
            [
                "ispb" => "61182408",
                "name" => "BANCO INVESTCRED UNIBANCO S.A.",
                "code" => 249,
                "full_name" => "Banco Investcred Unibanco S.A."
            ],
            [
                "ispb" => "61186680",
                "name" => "BCO BMG S.A.",
                "code" => 318,
                "full_name" => "Banco BMG S.A."
            ],
            [
                "ispb" => "61348538",
                "name" => "BCO C6 CONSIG",
                "code" => 626,
                "full_name" => "BANCO C6 CONSIGNADO S.A."
            ],
            [
                "ispb" => "61384004",
                "name" => "AVENUE SECURITIES DTVM LTDA.",
                "code" => 508,
                "full_name" => "AVENUE SECURITIES DISTRIBUIDORA DE TÍTULOS E VALORES MOBILIÁRIOS LTDA."
            ],
            [
                "ispb" => "61444949",
                "name" => "SAGITUR CC",
                "code" => 270,
                "full_name" => "SAGITUR CORRETORA DE CÂMBIO S.A."
            ],
            [
                "ispb" => "61533584",
                "name" => "BCO SOCIETE GENERALE BRASIL",
                "code" => 366,
                "full_name" => "BANCO SOCIETE GENERALE BRASIL S.A."
            ],
            [
                "ispb" => "61723847",
                "name" => "NEON CTVM S.A.",
                "code" => 113,
                "full_name" => "NEON CORRETORA DE TÍTULOS E VALORES MOBILIÁRIOS S.A."
            ],
            [
                "ispb" => "61747085",
                "name" => "TULLETT PREBON BRASIL CVC LTDA",
                "code" => 131,
                "full_name" => "TULLETT PREBON BRASIL CORRETORA DE VALORES E CÂMBIO LTDA"
            ],
            [
                "ispb" => "61809182",
                "name" => "C.SUISSE HEDGING-GRIFFO CV S/A",
                "code" => 11,
                "full_name" => "CREDIT SUISSE HEDGING-GRIFFO CORRETORA DE VALORES S.A"
            ],
            [
                "ispb" => "61820817",
                "name" => "BCO PAULISTA S.A.",
                "code" => 611,
                "full_name" => "Banco Paulista S.A."
            ],
            [
                "ispb" => "62073200",
                "name" => "BOFA MERRILL LYNCH BM S.A.",
                "code" => 755,
                "full_name" => "Bank of America Merrill Lynch Banco Múltiplo S.A."
            ],
            [
                "ispb" => "62109566",
                "name" => "CREDISAN CC",
                "code" => 89,
                "full_name" => "CREDISAN COOPERATIVA DE CRÉDITO"
            ],
            [
                "ispb" => "62144175",
                "name" => "BCO PINE S.A.",
                "code" => 643,
                "full_name" => "Banco Pine S.A."
            ],
            [
                "ispb" => "62169875",
                "name" => "NU INVEST CORRETORA DE VALORES S.A.",
                "code" => 140,
                "full_name" => "NU INVEST CORRETORA DE VALORES S.A."
            ],
            [
                "ispb" => "62232889",
                "name" => "BCO DAYCOVAL S.A",
                "code" => 707,
                "full_name" => "Banco Daycoval S.A."
            ],
            [
                "ispb" => "62237649",
                "name" => "CAROL DTVM LTDA.",
                "code" => 288,
                "full_name" => "CAROL DISTRIBUIDORA DE TITULOS E VALORES MOBILIARIOS LTDA."
            ],
            [
                "ispb" => "62285390",
                "name" => "SINGULARE CTVM S.A.",
                "code" => 363,
                "full_name" => "SINGULARE CORRETORA DE TÍTULOS E VALORES MOBILIÁRIOS S.A."
            ],
            [
                "ispb" => "62287735",
                "name" => "RENASCENCA DTVM LTDA",
                "code" => 101,
                "full_name" => "RENASCENCA DISTRIBUIDORA DE TÍTULOS E VALORES MOBILIÁRIOS LTDA"
            ],
            [
                "ispb" => "62331228",
                "name" => "DEUTSCHE BANK S.A.BCO ALEMAO",
                "code" => 487,
                "full_name" => "DEUTSCHE BANK S.A. - BANCO ALEMAO"
            ],
            [
                "ispb" => "62421979",
                "name" => "BANCO CIFRA",
                "code" => 233,
                "full_name" => "Banco Cifra S.A."
            ],
            [
                "ispb" => "65913436",
                "name" => "GUIDE",
                "code" => 177,
                "full_name" => "Guide Investimentos S.A. Corretora de Valores"
            ],
            [
                "ispb" => "67030395",
                "name" => "TRUSTEE DTVM LTDA.",
                "code" => 438,
                "full_name" => "TRUSTEE DISTRIBUIDORA DE TÍTULOS E VALORES MOBILIÁRIOS LTDA."
            ],
            [
                "ispb" => "68757681",
                "name" => "SIMPAUL",
                "code" => 365,
                "full_name" => "SIMPAUL CORRETORA DE CAMBIO E VALORES MOBILIARIOS  S.A."
            ],
            [
                "ispb" => "68900810",
                "name" => "BCO RENDIMENTO S.A.",
                "code" => 633,
                "full_name" => "Banco Rendimento S.A."
            ],
            [
                "ispb" => "71027866",
                "name" => "BCO BS2 S.A.",
                "code" => 218,
                "full_name" => "Banco BS2 S.A."
            ],
            [
                "ispb" => "71590442",
                "name" => "LASTRO RDV DTVM LTDA",
                "code" => 293,
                "full_name" => "Lastro RDV Distribuidora de Títulos e Valores Mobiliários Ltda."
            ],
            [
                "ispb" => "71677850",
                "name" => "FRENTE CC S.A.",
                "code" => 285,
                "full_name" => "FRENTE CORRETORA DE CÂMBIO S.A."
            ],
            [
                "ispb" => "73622748",
                "name" => "B&T CC LTDA.",
                "code" => 80,
                "full_name" => "B&T CORRETORA DE CAMBIO LTDA."
            ],
            [
                "ispb" => "74828799",
                "name" => "NOVO BCO CONTINENTAL S.A. - BM",
                "code" => 753,
                "full_name" => "Novo Banco Continental S.A. - Banco Múltiplo"
            ],
            [
                "ispb" => "75647891",
                "name" => "BCO CRÉDIT AGRICOLE BR S.A.",
                "code" => 222,
                "full_name" => "BANCO CRÉDIT AGRICOLE BRASIL S.A."
            ],
            [
                "ispb" => "76461557",
                "name" => "CCR COOPAVEL",
                "code" => 281,
                "full_name" => "Cooperativa de Crédito Rural Coopavel"
            ],
            [
                "ispb" => "76543115",
                "name" => "BANCO SISTEMA",
                "code" => 754,
                "full_name" => "Banco Sistema S.A."
            ],
            [
                "ispb" => "76641497",
                "name" => "DOURADA CORRETORA",
                "code" => 311,
                "full_name" => "DOURADA CORRETORA DE CÂMBIO LTDA."
            ],
            [
                "ispb" => "78157146",
                "name" => "CREDIALIANÇA CCR",
                "code" => 98,
                "full_name" => "Credialiança Cooperativa de Crédito Rural"
            ],
            [
                "ispb" => "78626983",
                "name" => "BCO VR S.A.",
                "code" => 610,
                "full_name" => "Banco VR S.A."
            ],
            [
                "ispb" => "78632767",
                "name" => "BCO OURINVEST S.A.",
                "code" => 712,
                "full_name" => "Banco Ourinvest S.A."
            ],
            [
                "ispb" => "80271455",
                "name" => "BCO RNX S.A.",
                "code" => 720,
                "full_name" => "BANCO RNX S.A."
            ],
            [
                "ispb" => "81723108",
                "name" => "CREDICOAMO",
                "code" => 10,
                "full_name" => "CREDICOAMO CREDITO RURAL COOPERATIVA"
            ],
            [
                "ispb" => "82096447",
                "name" => "CREDIBRF COOP",
                "code" => 440,
                "full_name" => "CREDIBRF - COOPERATIVA DE CRÉDITO"
            ],
            [
                "ispb" => "87963450",
                "name" => "MAGNETIS - DTVM",
                "code" => 442,
                "full_name" => "MAGNETIS - DISTRIBUIDORA DE TÍTULOS E VALORES MOBILIÁRIOS LTDA"
            ],
            [
                "ispb" => "89960090",
                "name" => "RB INVESTIMENTOS DTVM LTDA.",
                "code" => 283,
                "full_name" => "RB INVESTIMENTOS DISTRIBUIDORA DE TITULOS E VALORES MOBILIARIOS LIMITADA"
            ],
            [
                "ispb" => "90400888",
                "name" => "BCO SANTANDER (BRASIL) S.A.",
                "code" => 33,
                "full_name" => "BANCO SANTANDER (BRASIL) S.A."
            ],
            [
                "ispb" => "91884981",
                "name" => "BANCO JOHN DEERE S.A.",
                "code" => 217,
                "full_name" => "Banco John Deere S.A."
            ],
            [
                "ispb" => "92702067",
                "name" => "BCO DO ESTADO DO RS S.A.",
                "code" => 41,
                "full_name" => "Banco do Estado do Rio Grande do Sul S.A."
            ],
            [
                "ispb" => "92856905",
                "name" => "ADVANCED CC LTDA",
                "code" => 117,
                "full_name" => "ADVANCED CORRETORA DE CÂMBIO LTDA"
            ],
            [
                "ispb" => "92874270",
                "name" => "BCO DIGIMAIS S.A.",
                "code" => 654,
                "full_name" => "BANCO DIGIMAIS S.A."
            ],
            [
                "ispb" => "92875780",
                "name" => "WARREN CVMC LTDA",
                "code" => 371,
                "full_name" => "WARREN CORRETORA DE VALORES MOBILIÁRIOS E CÂMBIO LTDA."
            ],
            [
                "ispb" => "92894922",
                "name" => "BANCO ORIGINAL",
                "code" => 212,
                "full_name" => "Banco Original S.A."
            ],
            [
                "ispb" => "94968518",
                "name" => "EFX CC LTDA.",
                "code" => 289,
                "full_name" => "EFX CORRETORA DE CÂMBIO LTDA."
            ]
        ]);
    }
}
