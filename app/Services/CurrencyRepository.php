<?php

namespace App\Services;

class CurrencyRepository implements CurrencyRepositoryInterface
{
    const CURRENCIES_URL = 'https://api.coinmarketcap.com/v2/ticker/?structure=array';
    
    private $repository = [];
    
    public function __construct()
    {
        $data = $this->fetchCurrencies();

        foreach ($data as $item) {
            $currency = new Currency(
                $item->id,
                $item->name,
                $item->symbol,
                $item->quotes->USD->price,
                (new \DateTime)->setTimestamp($item->last_updated),
                ($item->id % 2 != 0) // make some currencies inactive
            );
            
            $this->repository[] = $currency;
        }
    }
    
    public function findAll(): array
    {
        return $this->repository;        
    }

    public function findActive(): array
    {
        $allCurrencies = $this->findAll();

        $activeCurrencies = array_filter($allCurrencies, function ($currency) {
            return $currency->isActive();
        });

        return $activeCurrencies;
    }

    public function findById(int $id): ?Currency
    {
        $currencies = $this->findAll();

        foreach ($currencies as $currency) {
            if ($currency->getId() === $id) {
                return $currency;
            }
        }

        return null;
    }

    public function save(Currency $currency): void
    {
        $this->repository[] = $currency;
    }

    public function delete(Currency $currency): void
    {
        foreach ($this->repository as $index => $storedCurrency) {
            if ($storedCurrency->getID() === $currency->getID()) {
                array_splice($this->repository, $index, 1);
                return;
            }
        }
    }

    private function fetchCurrencies(): array
    {
        $output = file_get_contents(self::CURRENCIES_URL);
        $currencies = json_decode($output)->data;

        return $currencies;
    }
}
