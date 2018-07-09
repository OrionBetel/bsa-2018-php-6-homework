<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CurrencyRepositoryInterface;
use App\Services\CurrencyPresenter;

class CurrenciesController extends Controller
{
    protected $repository;

    public function __construct(CurrencyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    public function getCurrencies()
    {
        $activeCurrencies = $this->repository->findActive();

        $formattedCurrencies = [];

        foreach ($activeCurrencies as $currency) {
            $formattedCurrencies[] = CurrencyPresenter::present($currency);
        }

        $data = response()->json($formattedCurrencies);

        return $data;
    }

    public function getCurrency(int $id)
    {
        $foundCurrency = $this->repository->findById($id);

        if (is_null($foundCurrency)) {
            return $this->wrongIdError();
        } else {
            $formattedCurrency = CurrencyPresenter::present($foundCurrency);

            $data = response()->json($formattedCurrency);

            return $data;
        }
    }

    public function showAll()
    {
        $currencies = $this->repository->findAll();

        $formattedCurrencies = [];

        foreach ($currencies as $currency) {
            $formattedCurrencies[] = CurrencyPresenter::present($currency);
        }
        
        return view('currencies', ['currencies' => $formattedCurrencies]);
    }

    protected function wrongIdError()
    {
        return response()->json([
            'message' => 'Wrong Currency ID'
        ], 404);
    }
}
