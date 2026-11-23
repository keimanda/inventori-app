<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\StockTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockTransactionController extends Controller
{
    public function index()
    {
        $transactions = StockTransaction::with('item')
            ->orderByDesc('transaction_date')
            ->get();

        return view('transactions.index', compact('transactions'));
    }

    public function create(Request $request)
    {
        $type = $request->query('type', 'masuk');

        if (!in_array($type, ['masuk', 'keluar'])) {
            abort(404);
        }

        $items = Item::orderBy('name')->get();

        return view('transactions.create', compact('items', 'type'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'transaction_type' => 'required|in:masuk,keluar',
            'quantity' => 'required|integer|min:1',
            'transaction_date' => 'required|date',
            'notes' => 'nullable|string|max:1000',
        ]);

        try {
            DB::transaction(function () use ($validated) {

                $item = Item::whereKey($validated['item_id'])
                    ->lockForUpdate()
                    ->firstOrFail();

                if ($validated['transaction_type'] === 'keluar'
                    && $item->stock < $validated['quantity']) {
                    throw new \RuntimeException(
                        'Stok tidak mencukupi. Stok tersedia: ' . $item->stock
                    );
                }

                if ($validated['transaction_type'] === 'masuk') {
                    $item->stock += $validated['quantity'];
                } else {
                    $item->stock -= $validated['quantity'];
                }

                $item->save();

                StockTransaction::create($validated);
            });

        } catch (\RuntimeException $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil disimpan dan stok telah diperbarui!');
    }
}
