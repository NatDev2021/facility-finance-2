<?php

namespace App\Helpers;

use DateTime;
use DateInterval;

class DateHelper
{
    /**
     * Summary of dueDate
     * Função responsavel por gerar a data de vencimento de cada parcela
     * @param string $date
     * @param string $frequency
     * @return string
     */
    public static function dueDate(string $date, string $frequency, $firstDueDate, $oldDate = null): string
    {
        // Converte a data inicial para um objeto DateTime
        $firstDueDate = new DateTime($firstDueDate);

        // Extrai o dia da data inicial
        $installmentDay = $firstDueDate->format('d');

        // Utilizase função diferente pra incremento mensal devido ao comportamento do php em incrementos de Mes com a função DateTime.
        // Em casos de vencimento no dia 30 a função nativa não considera o mês de fevereiro. Nata - 11/10
        if ($frequency == 30) {

            $date = self::dateIncrementMonth($date);
            $date = new DateTime($date);
            $yaer = $date->format('Y');
            $month = $date->format('m');

            // Cria uma nova data com o mesmo dia da cobrança
            $newDate = new DateTime("$yaer-$month-$installmentDay");
            $date = $newDate->format('Y-m-d');
        } else {
            $date = self::dateIncrement($date, $frequency);
        }

        if (!empty($oldDate)) {
            $date = self::validateMonth($date, $oldDate);
        }


        return $date;
    }

    protected static function validateMonth(string $date, $oldDate)
    {

        $monthDate = date('m', strtotime($date));
        $monthOldDate = date('m', strtotime($oldDate));
        if ($monthDate - $monthOldDate > 1) {
            $newDate = self::dateIncrement($date, 1, 'sub');
            $date = $this->validateMonth($newDate, $oldDate);
        }


        return $date;
    }

    /**
     * Summary of dateIncrement
     * Função responsavel por realizar o auto incremento das datas.
     * @param string $date
     * @param mixed $frequency
     * @return string
     * @throws \InvalidArgumentException
     */
    public static function dateIncrement(string $date, int $frequency = 30, string $operation = 'add'): string
    {
        // Validar a data de entrada
        $parsedDate = DateTime::createFromFormat('Y-m-d', $date);
        if ($parsedDate === false) {
            report("Data de entrada inválida. O formato esperado é 'Y-m-d'.");
        }


        // Mapear frequências para intervalos
        $intervals = [
            1 => 'P1D',
            7 => 'P7D',
            15 => 'P15D',
            30 => 'P30D',
            365 => 'P365D',

        ];

        // Definir o intervalo padrão
        $interval = $intervals[$frequency] ?? 'P1M';

        // Clonar a data inicial
        $initialDate = clone $parsedDate;

        // Adicionar ou subtrair o intervalo conforme a operação
        if ($operation === 'add') {
            $initialDate->add(new DateInterval($interval));
        } elseif ($operation === 'sub') {
            $initialDate->sub(new DateInterval($interval));
        } else {
            report("Operação inválida. Use 'add' ou 'sub'.");
        }


        return $initialDate->format('Y-m-d');
    }

    public static function dateIncrementMonth(string $date)
    {

        $monthToAdd = 1;

        $d1 = DateTime::createFromFormat('Y-m-d', $date);

        $year = $d1->format('Y');
        $month = $d1->format('n');
        $day = $d1->format('d');

        $year += floor($monthToAdd / 12);
        $monthToAdd = $monthToAdd % 12;
        $month += $monthToAdd;
        if ($month > 12) {
            $year++;
            $month = $month % 12;
            if ($month === 0)
                $month = 12;
        }

        if (!checkdate($month, $day, $year)) {
            $d2 = DateTime::createFromFormat('Y-n-j', $year . '-' . $month . '-1');
            $d2->modify('last day of');
        } else {
            $d2 = DateTime::createFromFormat('Y-n-d', $year . '-' . $month . '-' . $day);
        }
        $d2->setTime($d1->format('H'), $d1->format('i'), $d1->format('s'));
        return $d2->format('Y-m-d');
    }
}
