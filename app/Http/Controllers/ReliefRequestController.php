<?php
namespace App\Http\Controllers;

use App\Models\ReliefRequest;
use Illuminate\Http\Request;

class ReliefRequestController extends Controller {
    public function index() {
        $requests = ReliefRequest::all();
        return view('relief_requests.index', compact('requests'));
    }

    public function create() {
        return view('relief_requests.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'location_name' => 'required|string|max:255',
            'message' => 'required|string',
            'food_type' => 'nullable|string|max:100',
            'food_quantity' => 'required|integer|min:1',
            'people_count' => 'required|integer|min:1'
        ]);

        ReliefRequest::create($validated);
        return redirect()->route('relief_requests.index')->with('success', 'Yêu cầu cứu trợ đã được tạo');
    }

    public function edit(ReliefRequest $reliefRequest) {
        return view('relief_requests.edit', compact('reliefRequest'));
    }

    public function update(Request $request, ReliefRequest $reliefRequest) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'location_name' => 'required|string|max:255',
            'message' => 'required|string',
            'status' => 'required|in:pending,processing,completed,cancelled',
            'food_quantity' => 'required|integer|min:1',
            'people_count' => 'required|integer|min:1'
        ]);

        $reliefRequest->update($validated);
        return redirect()->route('relief_requests.index')->with('success', 'Cập nhật thành công');
    }

    public function destroy(ReliefRequest $reliefRequest) {
        $reliefRequest->delete();
        return redirect()->route('relief_requests.index')->with('success', 'Xóa thành công');
    }

    public function show(ReliefRequest $reliefRequest) {
        return view('relief_requests.show', compact('reliefRequest'));
    }

    public function getMapData() {
        // Thêm dữ liệu mẫu nếu chưa có
        if (ReliefRequest::count() == 0) {
            ReliefRequest::create([
                'name' => 'Nguyễn Văn A',
                'phone' => '0987654321',
                'latitude' => 21.0285,
                'longitude' => 105.8542,
                'location_name' => 'Quận Hoàn Kiếm, Hà Nội',
                'message' => 'Gia đình cần cứu trợ khẩn cấp do lũ lụt',
                'food_type' => 'Gạo',
                'food_quantity' => 50,
                'people_count' => 5,
                'status' => 'pending'
            ]);

            ReliefRequest::create([
                'name' => 'Trần Thị B',
                'phone' => '0912345678',
                'latitude' => 10.8231,
                'longitude' => 106.6297,
                'location_name' => 'Quận 1, TP.HCM',
                'message' => 'Cần hỗ trợ thực phẩm cho 20 hộ dân',
                'food_type' => 'Mì gói',
                'food_quantity' => 100,
                'people_count' => 20,
                'status' => 'processing'
            ]);
        }

        if (\App\Models\ReliefSupply::count() == 0) {
            \App\Models\ReliefSupply::create([
                'supply_type' => 'Gạo',
                'available_quantity' => 1000,
                'latitude' => 21.0333,
                'longitude' => 105.8500,
                'location_name' => 'Kho Hà Nội',
                'description' => 'Kho thực phẩm chính tại Hà Nội',
                'status' => 'available'
            ]);

            \App\Models\ReliefSupply::create([
                'supply_type' => 'Mì gói',
                'available_quantity' => 500,
                'latitude' => 10.8000,
                'longitude' => 106.7000,
                'location_name' => 'Kho TP.HCM',
                'description' => 'Kho thực phẩm tại TP.HCM',
                'status' => 'available'
            ]);
        }

        $requests = ReliefRequest::all();
        return response()->json([
            'requests' => $requests,
            'supplies' => \App\Models\ReliefSupply::all()
        ]);
    }
}
