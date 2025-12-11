<?php
namespace App\Http\Controllers;

use App\Models\ReliefSupply;
use Illuminate\Http\Request;

class ReliefSupplyController extends Controller {
    public function index() {
        $supplies = ReliefSupply::all();
        return view('relief_supplies.index', compact('supplies'));
    }

    public function create() {
        return view('relief_supplies.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'supply_type' => 'required|string|max:100',
            'available_quantity' => 'required|integer|min:0',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'location_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:available,low,out_of_stock'
        ]);

        ReliefSupply::create($validated);
        return redirect()->route('relief_supplies.index')->with('success', 'Thêm nguồn cứu trợ thành công');
    }

    public function edit(ReliefSupply $reliefSupply) {
        return view('relief_supplies.edit', compact('reliefSupply'));
    }

    public function update(Request $request, ReliefSupply $reliefSupply) {
        $validated = $request->validate([
            'supply_type' => 'required|string|max:100',
            'available_quantity' => 'required|integer|min:0',
            'location_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:available,low,out_of_stock'
        ]);

        $reliefSupply->update($validated);
        return redirect()->route('relief_supplies.index')->with('success', 'Cập nhật thành công');
    }

    public function destroy(ReliefSupply $reliefSupply) {
        $reliefSupply->delete();
        return redirect()->route('relief_supplies.index')->with('success', 'Xóa thành công');
    }
}
