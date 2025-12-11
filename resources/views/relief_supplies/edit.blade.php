@extends('layout.app')
@section('title', 'Chỉnh sửa nguồn cứu trợ')

@section('content')
<div class="w-full px-4 py-6">
    <div class="max-w-4xl">
        <div class="mb-6">
            <p class="text-gray-600">Cập nhật thông tin chi tiết về nguồn cứu trợ</p>
        </div>

        <div class="card">
            <div class="card-header">
                <i class="fas fa-edit mr-2"></i>
                Chỉnh sửa nguồn cứu trợ
            </div>
            <div class="p-6">
                <form action="{{ route('relief_supplies.update', $reliefSupply) }}" method="POST">
                    @csrf 
                    @method('PUT')
                    
                    <div class="space-y-6">
                        <!-- Thông tin cơ bản -->
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-lg font-semibold text-blue-800">
                                    <i class="fas fa-box mr-2"></i>
                                    Thông tin cơ bản
                                </h2>
                                <span class="px-3 py-1 rounded-full text-sm 
                                    {{ $reliefSupply->status === 'available' ? 'bg-green-100 text-green-800' : 
                                       ($reliefSupply->status === 'low' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ $reliefSupply->status === 'available' ? 'Có sẵn' : 
                                       ($reliefSupply->status === 'low' ? 'Sắp hết' : 'Hết hàng') }}
                                </span>
                            </div>
                            
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Loại hàng cứu trợ
                                    </label>
                                    <input type="text" name="supply_type" 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                                           value="{{ $reliefSupply->supply_type }}" 
                                           required>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Số lượng hiện có
                                    </label>
                                    <div class="relative">
                                        <input type="number" name="available_quantity" 
                                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                                               min="0" 
                                               value="{{ $reliefSupply->available_quantity }}" 
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
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        <i class="fas fa-map-marker-alt text-red-500 mr-1"></i>
                                        Tên địa điểm
                                    </label>
                                    <input type="text" name="location_name" 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500" 
                                           value="{{ $reliefSupply->location_name }}" 
                                           required>
                                </div>
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
                                        <option value="available" {{ $reliefSupply->status === 'available' ? 'selected' : '' }}>
                                            Có sẵn
                                        </option>
                                        <option value="low" {{ $reliefSupply->status === 'low' ? 'selected' : '' }}>
                                            Sắp hết hàng
                                        </option>
                                        <option value="out_of_stock" {{ $reliefSupply->status === 'out_of_stock' ? 'selected' : '' }}>
                                            Hết hàng
                                        </option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Mô tả chi tiết
                                    </label>
                                    <textarea name="description" 
                                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" 
                                              rows="3">{{ $reliefSupply->description }}</textarea>
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
                            Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection