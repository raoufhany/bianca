<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Contracts\Restaurants\GetRestaurants;
use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class SelectRestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param GetRestaurants $getRestaurants
     * @return View
     */
    public function index(GetRestaurants $getRestaurants): View
    {
        $restaurants = $getRestaurants->handle()->select('id', 'name')->paginate();
        return view('admin.restaurants.select', ['rows' => $restaurants]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Restaurant $restaurant
     * @return RedirectResponse
     */
    public function select(Restaurant $restaurant): RedirectResponse
    {
        Session::put('restaurant', $restaurant);

        return redirect()->route('admin.dashboard');
    }

    /**
     * Display a listing of the resource.
     *
     * @return RedirectResponse
     */
    public function unselect(): RedirectResponse
    {
        Session::remove('restaurant');

        return redirect()->route('admin.dashboard');
    }
}
