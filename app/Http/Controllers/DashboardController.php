<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $totalItems = Item::count();
        $totalStock = Item::sum('stock');
        $lowStock = Item::whereColumn('stock', '<=', 'minimum_stock')->count();
        $totalCategories = Category::count();

        $lowStockItems = Item::with('category')
            ->whereColumn('stock', '<=', 'minimum_stock')
            ->orderBy('stock')
            ->take(5)
            ->get();

        $latestItems = Item::with('category')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalItems',
            'totalStock',
            'lowStock',
            'totalCategories',
            'lowStockItems',
            'latestItems'
        ));
    }
}