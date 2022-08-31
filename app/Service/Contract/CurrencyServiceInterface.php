<?php
declare(strict_types=1);


namespace App\Service\Contract;


use Carbon\Carbon;


interface CurrencyServiceInterface
{
    public function getData(Carbon $date): ?array;
}