<?php

namespace App\Http\Controllers;
use App\Price;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PriceController extends Controller
{
    public function showForm()
    {
        return view('searchForm');
    }


    public function getClosest($val1, $val2, $target)
    {
        if ($target - $val1 >= $val2 - $target)
            return $val2;
        else
            return $val1;
    }


    public function findClosest($arr, $n, $target)
    {
        // Corner cases
        if ($target <= $arr[0])
            return $arr[0];
        if ($target >= $arr[$n - 1])
            return $arr[$n - 1];

        // Doing binary search
        $i = 0;
        $j = $n;
        $mid = 0;
        while ($i < $j)
        {
            $mid = ($i + $j) / 2;

            if ($arr[$mid] == $target)
                return $arr[$mid];

            /* If target is less than array element,
                then search in left */
            if ($target < $arr[$mid])
            {

                // If target is greater than previous
                // to mid, return closest of two
                if ($mid > 0 && $target > $arr[$mid - 1])
                    return $this->getClosest($arr[$mid - 1],
                        $arr[$mid], $target);

                /* Repeat for left half */
                $j = $mid;
            }

            // If target is greater than mid
            else
            {
                if ($mid < $n - 1 &&
                    $target < $arr[$mid + 1])
                    return $this->getClosest($arr[$mid],
                        $arr[$mid + 1], $target);
                // update i
                $i = $mid + 1;
            }
        }
        // Only single element left after search
        return $arr[$mid];
    }


    public function getNearestDimention($initialWidth,$initialLength)
    {
        $width=[];
        $length = [];
        foreach (Price::all() as $price) {
            array_push($width,$price->width);
            array_push($length,$price->length);
        }

//        Get the nearest Dimention
        $nearestWidth = $this->findClosest($width,count($width),$initialWidth);
        $nearestLength = $this->findClosest($length,count($length),$initialLength);

        return [
            'width' => $nearestWidth,
            'length' => $nearestLength
        ];
    }

//    Function that shows price
    public function showPrice(Request $request){
        $dimention = $this->getNearestDimention($request->width,$request->length);
        $price= Price::where('width',$dimention['width'])->where('length',$dimention['length'])->first()->price;
        dd(Price::where('width',$dimention['width'])->where('length',$dimention['length'])->first()->price);
    }
}
