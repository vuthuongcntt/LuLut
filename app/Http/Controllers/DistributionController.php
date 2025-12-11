<?php
namespace App\Http\Controllers;

use App\Models\Distribution;
use App\Models\ReliefRequest;
use App\Models\ReliefSupply;
use Illuminate\Http\Request;

class DistributionController extends Controller {
    public function index() {
        $distributions = Distribution::with(['reliefRequest', 'reliefSupply'])->get();
        return view('distributions.index', compact('distributions'));
    }

    public function create() {
        $requests = ReliefRequest::where('status', 'pending')->get();
        $supplies = ReliefSupply::where('status', '!=', 'out_of_stock')->get();
        return view('distributions.create', compact('requests', 'supplies'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'relief_request_id' => 'required|exists:relief_requests,id',
            'relief_supply_id' => 'required|exists:relief_supplies,id',
            'quantity_distributed' => 'required|integer|min:1',
            'notes' => 'nullable|string'
        ]);

        $supply = ReliefSupply::find($validated['relief_supply_id']);
        if ($supply->available_quantity < $validated['quantity_distributed']) {
            return back()->withErrors(['quantity_distributed' => 'Số lượng không đủ']);
        }

        $validated['distributed_at'] = now();
        Distribution::create($validated);

        $supply->update([
            'available_quantity' => $supply->available_quantity - $validated['quantity_distributed']
        ]);

        ReliefRequest::find($validated['relief_request_id'])->update(['status' => 'processing']);

        return redirect()->route('distributions.index')->with('success', 'Phân bổ cứu trợ thành công');
    }

    public function destroy(Distribution $distribution) {
        $supply = $distribution->reliefSupply;
        $supply->update([
            'available_quantity' => $supply->available_quantity + $distribution->quantity_distributed
        ]);
        $distribution->delete();
        return redirect()->route('distributions.index')->with('success', 'Xóa bản ghi phân bổ thành công');
    }
}