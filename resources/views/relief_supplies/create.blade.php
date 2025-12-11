@extends('layout.app')
@section('title', 'Thêm Nguồn Cứu Trợ Mới')

@section('content')
<div class="w-full px-4 py-6">
    <div class="max-w-4xl">
        <div class="mb-6">
            <p class="text-gray-600">Điền thông tin chi tiết về nguồn cứu trợ</p>
        </div>

        <div class="card">
            <div class="card-header">
                <i class="fas fa-plus mr-2"></i>
                Thêm nguồn cứu trợ mới
            </div>
            <div class="p-6">
                <form action="{{ route('relief_supplies.store') }}" method="POST">
                    @csrf
                    
                    <div class="space-y-6">
                        <!-- Thông tin cơ bản -->
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h2 class="text-lg font-semibold text-blue-800 mb-4">
                                <i class="fas fa-box mr-2"></i>
                                Thông tin cơ bản
                            </h2>
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Loại hàng cứu trợ
                                    </label>
                                    <input type="text" name="supply_type" 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                                           value="{{ old('supply_type') }}" 
                                           placeholder="VD: Gạo, Mì gói, Nước uống..." 
                                           required>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Số lượng (phần)
                                    </label>
                                    <div class="relative">
                                        <input type="number" name="available_quantity" 
                                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                                               min="0" 
                                               value="{{ old('available_quantity', 0) }}" 
                                               required>
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                            <span class="text-gray-500">phần</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Thông tin địa điểm -->
                        <div class="bg-green-50 p-4 rounded-lg">
                            <h2 class="text-lg font-semibold text-green-800 mb-4">
                                <i class="fas fa-map-marked-alt mr-2"></i>
                                Thông tin địa điểm
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        <i class="fas fa-map-marker-alt text-red-500 mr-1"></i>
                                        Vĩ độ (Latitude)
                                    </label>
                                    <input type="number" name="latitude" 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500" 
                                           step="0.00001" 
                                           value="{{ old('latitude', 21.0285) }}" 
                                           required>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        <i class="fas fa-map-marker-alt text-red-500 mr-1"></i>
                                        Kinh độ (Longitude)
                                    </label>
                                    <input type="number" name="longitude" 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500" 
                                           step="0.00001" 
                                           value="{{ old('longitude', 105.8542) }}" 
                                           required>
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Tên địa điểm
                                </label>
                                <input type="text" name="location_name" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500" 
                                       value="{{ old('location_name') }}" 
                                       placeholder="VD: Số 123 Đường ABC, Phường XYZ..." 
                                       required>
                            </div>
                        </div>

                        <!-- Thông tin bổ sung -->
                        <div class="bg-purple-50 p-4 rounded-lg">
                            <h2 class="text-lg font-semibold text-purple-800 mb-4">
                                <i class="fas fa-info-circle mr-2"></i>
                                Thông tin bổ sung
                            </h2>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Trạng thái
                                    </label>
                                    <select name="status" 
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 bg-white" 
                                            required>
                                        <option value="available">Có sẵn</option>
                                        <option value="low">Sắp hết hàng</option>
                                        <option value="out_of_stock">Hết hàng</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Mô tả chi tiết
                                    </label>
                                    <textarea name="description" 
                                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" 
                                              rows="3" 
                                              placeholder="Thêm thông tin chi tiết về nguồn cứu trợ...">{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="mt-6 flex items-center justify-end space-x-3">
                        <a href="{{ route('relief_supplies.index') }}" 
                           class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-150">
                            <i class="fas fa-times mr-1"></i>
                            Hủy
                        </a>
                        <button type="submit" 
                                class="btn-custom">
                            <i class="fas fa-save mr-1"></i>
                            Lưu thông tin
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection