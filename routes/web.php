<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReliefRequestController;
use App\Http\Controllers\ReliefSupplyController;
use App\Http\Controllers\DistributionController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    $pendingRequests = \App\Models\ReliefRequest::where('status', 'pending')->count();
    $totalSupplies = \App\Models\ReliefSupply::sum('available_quantity');
    $distributions = \App\Models\Distribution::count();
    return view('dashboard', compact('pendingRequests', 'totalSupplies', 'distributions'));
})->name('dashboard');

// Tuyến đường yêu cầu cứu trợ
Route::resource('relief_requests', ReliefRequestController::class);
Route::get('/api/relief-requests/map-data', [ReliefRequestController::class, 'getMapData']);

// Tuyến đường nguồn cứu trợ
Route::resource('relief_supplies', ReliefSupplyController::class);

// Tuyến đường phân bổ
Route::resource('distributions', DistributionController::class);

// API routes cho bản đồ
Route::prefix('api')->group(function () {
    Route::get('/relief-data', function () {
        return response()->json([
            'requests' => \App\Models\ReliefRequest::all(),
            'supplies' => \App\Models\ReliefSupply::all()
        ]);
    });
});