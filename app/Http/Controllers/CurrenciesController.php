<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CurrencyRepositoryInterface;
use App\Services\CurrencyPresenter;

class CurrenciesController extends Controller
{
    public function getCurrencies()
    {
        $currencyRepository = app(CurrencyRepositoryInterface::class);

        $activeCurrencies = $currencyRepository->findActive();

        $formattedCurrencies = [];

        foreach ($activeCurrencies as $currency) {
            $formattedCurrencies[] = CurrencyPresenter::present($currency);
        }

        $data = response()->json($formattedCurrencies);

        return $data;
    }

    public function getCurrency(int $id)
    {
        $currencyRepository = app(CurrencyRepositoryInterface::class);

        $foundCurrency = $currencyRepository->findById($id);

        if (is_null($foundCurrency)) {

            return response('Error 404: Wrong currency ID.', 404);

        } else {
            $formattedCurrency = CurrencyPresenter::present($foundCurrency);

            $data = response()->json($formattedCurrency);

            return $data;
        }
    }
}
