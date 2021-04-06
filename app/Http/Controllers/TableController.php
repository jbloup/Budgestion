<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Category;
use App\Models\Fuel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class TableController extends Controller
{
    /**
     *
     * @return Application|Factory|View
     */
    public function month(){
        setlocale(LC_TIME, "fr_FR");

        $fuels = Fuel::where('user_id', Auth::user()->getAuthIdentifier())->get();
        $cars = Car::where('user_id', Auth::user()->getAuthIdentifier())->get();
        $categories = Category::where('user_id', Auth::user()->getAuthIdentifier())->get();
        $spentCategories = Category::where('user_id', Auth::user()->getAuthIdentifier())->where('kind', 'spent')->get();
        $earningCategories = Category::where('user_id', Auth::user()->getAuthIdentifier())->where('kind', 'earning')->get();
        $categoryTotals = null;
        $typeTotals = null;

        $mileageMonthTab = null;
        $spentTotal = 0;
        $earningTotal = 0;
        $fuelTotal = 0;
        $fuelTotalLiter = 0;

        if(request('month') == null && request('year') == null){
            $date = date('Y-m');
            $date2 = date('Y-m', strtotime('+1 month'));
        }else{
            $date = date('Y-m', mktime(0, 0, 0, request('month'), 1, request('year')));
            $date2 = date('Y-m', strtotime('+1 month', strtotime($date)));
        }

        foreach ($fuels as $fuel) {
            if (($fuel->date >= $date) && ($fuel->date < $date2)) {
                $fuelTotal += $fuel->price;
                $fuelTotalLiter += $fuel->liter;
            }
        }

        foreach($cars as $car){
            $mileageMonth = 0;
            $mileageTab = null;
            foreach ($car->fuels as $fuel) {
                if (($fuel->date >= $date) && ($fuel->date < $date2)) {
                    $mileageTab[$fuel->id] = $fuel->mileage;
                }
                if($mileageTab != null){
                    $mileageMonth = max($mileageTab) - min($mileageTab);
                }
            }
            $mileageMonthTab[$car->id] = $mileageMonth;
        }

        foreach ($categories as $category){
            $categoryTotal = 0;
            foreach ($category->types as $type){
                $typeTotal = 0;
                foreach($type->families as $family){
                    foreach ($family->spents as $spent)
                        if(($spent->date >= $date) && ($spent->date < $date2)){
                            $typeTotal +=  $spent->price;
                        }
                    foreach ($family->earnings as $earning)
                        if(($earning->date >= $date) && ($earning->date < $date2)){
                            $typeTotal +=  $earning->amount;
                        }
                }
                $typeTotals[$type->id] = $typeTotal;
                $categoryTotal += $typeTotal;
            }
            $categoryTotals[$category->id] = $categoryTotal;
        }

        foreach ($spentCategories as $category){
            $spentTotal += $categoryTotals[$category->id];
        }

        foreach ($earningCategories as $category){
            $earningTotal += $categoryTotals[$category->id];
        }

        $spentFuelTotal = $spentTotal + $fuelTotal;
        $total = $earningTotal - $spentFuelTotal;

        return view('table.month',[
            'spentCategories' => $spentCategories,
            'earningCategories' => $earningCategories,
            'fuels' => $fuels,
            'date' => $date,
            'date2' => $date2,
            'categoryTotals' => $categoryTotals,
            'typeTotals' => $typeTotals,
            'fuelTotal' => number_format($fuelTotal, 2, ',', ' '),
            'fuelTotalLiter' => $fuelTotalLiter,
            'spentTotal' => number_format($spentTotal, 2, ',', ' '),
            'earningTotal' => number_format($earningTotal, 2, ',', ' '),
            'total' => number_format($total, 2, ',', ' '),
            'spentFuelTotal' => number_format($spentFuelTotal, 2, ',', ' '),
            'cars' => $cars,
            'mileageMonthTab' => $mileageMonthTab,
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function year(){

        $categories = Category::where('user_id', Auth::user()->getAuthIdentifier())->get();
        $spentCategories = Category::where('user_id', Auth::user()->getAuthIdentifier())->where('kind', 'spent')->get();
        $earningCategories = Category::where('user_id', Auth::user()->getAuthIdentifier())->where('kind', 'earning')->get();
        $cars = Car::where('user_id', Auth::user()->getAuthIdentifier())->get();
        $fuels = Fuel::where('user_id', Auth::user()->getAuthIdentifier())->get();

        $tabTotalFamilyMonth = null;
        $tabTotalFamilyYear = null;
        $tabTotalFamily = null;

        $tabTotalTypeMonth = null;
        $tabTotalTypeYear = null;
        $tabTotalType = null;

        $tabTotalCategoryMonth = null;
        $tabTotalCategoryYear = null;
        $tabTotalCategory = null;

        $tabTotalCarMonth = null;
        $tabTotalCarYear = null;
        $tabTotalCar = null;

        $tabTotalLiterCarMonth = null;
        $tabTotalLiterCarYear = null;
        $tabTotalLiterCar = null;

        $tabSpentTotalMonth = null;
        $tabEarningTotalMonth = null;
        $tabTotalVehicleMonth = null;
        $tabTotalLiterVehicleMonth = null;

        $tabTotalFuelAndCategoryMonth = null;

        if(request('year') == null){
            $year = date('Y');
            $year2 = date('Y', strtotime('+1 year'));
        }else{
            $year = date('Y', mktime(0, 0, 0, 1, 1, request('year')));
            $date = date('Y-m', mktime(0, 0, 0, 1, 1, $year));
            $year2 = date('Y', strtotime('+1 year', strtotime($date)));
        }

        for($i=1;$i<=12;$i++) {
            $date = date('Y-m', mktime(0, 0, 0, $i, 1, $year));
            $date2 = date('Y-m', strtotime('+1 month', strtotime($date)));
            $spentTotalMonth = 0;
            $spentTotalYear = 0;
            $earningTotalMonth = 0;
            $earningTotalYear = 0;
            foreach($categories as $category){
                $totalCategoryMonth = 0;
                $totalCategoryYear = 0;
                foreach ($category->types as $type){
                    $totalTypeMonth = 0;
                    $totalTypeYear = 0;
                    foreach($type->families as $family){
                        $totalSpentYear = 0;
                        $totalSpentMonth = 0;
                        if($family->spents->count() > 0) {
                            foreach ($family->spents as $spent) {
                                if (($spent->date >= $date) && ($spent->date < $date2)) {
                                    $totalSpentMonth += $spent->price;
                                }
                                if (($spent->date >= $year) && ($spent->date < $year2)) {
                                    $totalSpentYear += $spent->price;
                                }
                            }
                        }
                        else if($family->earnings->count() > 0) {
                            foreach ($family->earnings as $earning) {
                                if (($earning->date >= $date) && ($earning->date < $date2)) {
                                    $totalSpentMonth += $earning->amount;
                                }
                                if (($earning->date >= $year) && ($earning->date < $year2)) {
                                    $totalSpentYear += $earning->amount;
                                }
                            }
                        }

                        $tabTotalFamily[$family->id] = $totalSpentMonth;
                        $tabTotalFamilyMonth[$i] = $tabTotalFamily;

                        $tabTotalFamilyYear[$family->id] = $totalSpentYear;

                        $totalTypeMonth += $totalSpentMonth;
                        $totalTypeYear += $totalSpentYear;
                    }

                    $tabTotalType[$type->id] = $totalTypeMonth;
                    $tabTotalTypeMonth[$i] = $tabTotalType;

                    $tabTotalTypeYear[$type->id] = $totalTypeYear;

                    $totalCategoryMonth += $totalTypeMonth;
                    $totalCategoryYear += $totalTypeYear;
                }
                $tabTotalCategory[$category->id] = $totalCategoryMonth;
                $tabTotalCategoryMonth[$i] = $tabTotalCategory;

                $tabTotalCategoryYear[$category->id] = $totalCategoryYear;
            }

            foreach($spentCategories as $category){
                $spentTotalYear += $tabTotalCategoryYear[$category->id];
                $spentTotalMonth += $tabTotalCategory[$category->id];
                $tabSpentTotalMonth[$i] = $spentTotalMonth;
            }

            foreach($earningCategories as $category){
                $earningTotalYear += $tabTotalCategoryYear[$category->id];
                $earningTotalMonth += $tabTotalCategory[$category->id];
                $tabEarningTotalMonth[$i] = $earningTotalMonth;
            }

            $totalVehicleMonth = 0;
            $totalVehicleYear = 0;

            $totalLiterVehicleMonth = 0;
            $totalLiterVehicleYear = 0;

            foreach ($cars as $car){
                    $totalFuelMonth = 0;
                    $totalLiterFuelMonth = 0;
                    $totalFuelYear = 0;
                    $totalLiterFuelYear = 0;
                    $mileageYear = 0;
                    $mileageTab = null;
                    foreach ($car->fuels as $fuel){
                        if(($fuel->date >= $date) && ($fuel->date < $date2)){
                            $totalFuelMonth +=  $fuel->price;
                            $totalLiterFuelMonth += $fuel->liter;
                        }
                        if(($fuel->date > $year) && ($fuel->date < $year2)){
                            $totalFuelYear +=  $fuel->price;
                            $totalLiterFuelYear += $fuel->liter;
                            $mileageTab[$fuel->id] = $fuel->mileage;
                        }
                        if($mileageTab != null){
                            $mileageYear = max($mileageTab) - min($mileageTab);
                        }
                    }
                    $mileageYearTab[$car->id] = $mileageYear;

                    $tabTotalCar[$car->id] = $totalFuelMonth;
                    $tabTotalCarMonth[$i] = $tabTotalCar;

                    $tabTotalCarYear[$car->id] = $totalFuelYear;

                    $totalVehicleYear += $totalFuelYear;
                    $totalVehicleMonth += $totalFuelMonth;
                    $tabTotalVehicleMonth[$i] = $totalVehicleMonth;


                    $tabTotalLiterCar[$car->id] = $totalLiterFuelMonth;
                    $tabTotalLiterCarMonth[$i] = $tabTotalLiterCar;

                    $tabTotalLiterCarYear[$car->id] = $totalLiterFuelYear;

                    $totalLiterVehicleYear += $totalLiterFuelYear;
                    $totalLiterVehicleMonth += $totalLiterFuelMonth;
                    $tabTotalLiterVehicleMonth[$i] = $totalLiterVehicleMonth;

            }

            if($fuels->count() > 0){
                $tabTotalFuelAndCategoryMonth[$i] = $tabSpentTotalMonth[$i] + $tabTotalVehicleMonth[$i];
                $totalFuelAndCategoryYear = $spentTotalYear + $totalVehicleYear;
            }else{
                $totalFuelAndCategoryYear = 0;
            }
            $totalYear = $earningTotalYear - $spentTotalYear - $totalFuelAndCategoryYear;
        }

        return view('table.year',[
            'spentCategories' => $spentCategories,
            'earningCategories' => $earningCategories,
            'cars' => $cars,
            'fuels' => $fuels,
            'year' => $year,
            'year2' => $year2,
            'mileageYearTab' => $mileageYearTab,
            'mileageTab' => $mileageTab,
            'totalYear' => $totalYear,
            'spentTotalYear' => $spentTotalYear,
            'earningTotalYear' => $earningTotalYear,
            'totalVehicleYear' => $totalVehicleYear,
            'totalLiterVehicleYear' => $totalLiterVehicleYear,
            'totalFuelAndCategoryYear' => $totalFuelAndCategoryYear,
            'tabSpentTotalMonth' => $tabSpentTotalMonth,
            'tabEarningTotalMonth' => $tabEarningTotalMonth,
            'tabTotalVehicleMonth' => $tabTotalVehicleMonth,
            'tabTotalFuelAndCategoryMonth' => $tabTotalFuelAndCategoryMonth,
            'tabTotalLiterVehicleMonth' => $tabTotalLiterVehicleMonth,
            'tabTotalFamilyMonth' =>  $tabTotalFamilyMonth,
            'tabTotalFamilyYear' =>  $tabTotalFamilyYear,
            'tabTotalTypeMonth' =>  $tabTotalTypeMonth,
            'tabTotalTypeYear' =>  $tabTotalTypeYear,
            'tabTotalCategoryMonth' =>  $tabTotalCategoryMonth,
            'tabTotalCategoryYear' =>  $tabTotalCategoryYear,
            'tabTotalCarMonth' =>  $tabTotalCarMonth,
            'tabTotalLiterCarMonth' =>  $tabTotalLiterCarMonth,
            'tabTotalCarYear' =>  $tabTotalCarYear,
            'tabTotalLiterCarYear' =>  $tabTotalLiterCarYear,
        ]);
    }
}
