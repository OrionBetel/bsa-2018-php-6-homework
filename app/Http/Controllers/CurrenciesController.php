<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CurrencyRepositoryInterface;

class CurrenciesController extends Controller
{
    public function getCurrencies()
    {
        $currencyRepository = app(CurrencyRepositoryInterface::class);

        $activeCurrencies = $currencyRepository->findActive();

        $activeCurrenciesArray = [];

        foreach ($activeCurrencies as $currency) {
            $activeCurrenciesArray[] = [
                'id' => $currency->getId(),
                'name' => $currency->getName(),
                'short_name' => $currency->getShortName(),
                'actual_course' => $currency->getActualCourse(),
                'actual_course_date' => $currency->getActualCourseDate(),
                'active' => $currency->isActive()
            ];
        }

        $data = response()->json($activeCurrenciesArray);

        return $data;
    }
}
