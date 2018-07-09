<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CurrencyRepositoryInterface;
use App\Services\CurrencyPresenter;
use App\Services\Currency;

class AdminCurrenciesController extends CurrenciesController
{    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return parent::getCurrencies();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $currency = new Currency(
            time(),
            $request->input('name'),
            $request->input('short_name'),
            $request->input('actual_course'),
            \DateTime::createFromFormat('Y-m-d H-i-s', $request->input('actual_course_date')),
            $request->input('active')
        );
        
        $this->repository->save($currency);

        $formattedCurrency = CurrencyPresenter::present($currency);

        return response()->json($formattedCurrency);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return parent::getCurrency($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updatingCurrency = $this->repository->findById($id);

        if (is_null($updatingCurrency)) {
            return $this->wrongIdError();
        } else {
            $newDataArray = $request->all();

            foreach ($newDataArray as $key => $value) {
                switch ($key) {
                    case 'name':
                        $updatingCurrency->setName($value);
                        break;
                    case 'short_name':
                        $updatingCurrency->setShortName($value);
                        break;
                    case 'actual_course':
                        $updatingCurrency->setActualCourse($value);
                        break;
                    case 'actual_course_date':
                        $updatingCurrency
                            ->setActualCourseDate(\DateTime::createFromFormat('Y-m-d H-i-s', $value));
                        break;
                    case 'active':
                        $updatingCurrency->setIsActive($value);
                        break;
                }
            }

            $this->repository->save($updatingCurrency);

            $formattedCurrency = CurrencyPresenter::present($updatingCurrency);

            return response()->json($formattedCurrency);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prey = $this->repository->findById($id);

        if (is_null($prey)) {
            return $this->wrongIdError();
        } else {
            $this->repository->delete($prey);
        }
    }
}
