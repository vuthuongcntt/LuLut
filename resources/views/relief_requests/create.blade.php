@extends('layout.app')
@section('title', 'Tạo Yêu Cầu Cứu Trợ Mới')

@section('content')
<div class="w-full px-4 py-6">
    <div class="max-w-4xl">
        <div class="mb-6">
            <p class="text-gray-600">Vui lòng điền đầy đủ thông tin để chúng tôi có thể hỗ trợ tốt nhất</p>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
            <div class="p-6">
                <form action="{{ route('relief_requests.store') }}" method="POST">
                    @csrf
                    
                    <div class="space-y-6">
                        <!-- Thông tin người yêu cầu -->
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h2 class="text-lg font-semibold text-blue-800 mb-4">
                                <i class="fas fa-user-circle mr-2"></i>
                                Thông tin người yêu cầu
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Họ và tên
                                    </label>
                                    <input type="text" name="name" 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                                           value="{{ old('name') }}" 
                                           placeholder="Nhập họ tên người yêu cầu"
                                           required>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Số điện thoại liên hệ
                                    </label>
                                    <input type="tel" name="phone" 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                                           value="{{ old('phone') }}" 
                                           placeholder="Nhập số điện thoại"
                                           required>
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
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
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
                                            Kinh độ (Longitude)
                                        </label>
                                        <input type="number" name="longitude" 
                                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500" 
                                               step="0.00001" 
                                               value="{{ old('longitude', 105.8542) }}" 
                                               required>
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Địa chỉ cụ thể
                                    </label>
                                    <input type="text" name="location_name" 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500" 
                                           value="{{ old('location_name') }}" 
                                           placeholder="Nhập địa chỉ cụ thể của địa điểm cần cứu trợ"
                                           required>
                                </div>
                            </div>
                        </div>

                        <!-- Thông tin yêu cầu -->
                        <div class="bg-purple-50 p-4 rounded-lg">
                            <h2 class="text-lg font-semibold text-purple-800 mb-4">
                                <i class="fas fa-hands-helping mr-2"></i>
                                Chi tiết yêu cầu
                            </h2>
                            <div class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Loại thực phẩm cần hỗ trợ
                                        </label>
                                        <input type="text" name="food_type" 
                                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" 
                                               value="{{ old('food_type') }}" 
                                               placeholder="VD: Gạo, mì gói, nước uống...">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Số lượng cần (phần)
                                        </label>
                                        <div class="relative">
                                            <input type="number" name="food_quantity" 
                                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" 
                                                   min="1" 
                                                   value="{{ old('food_quantity', 1) }}" 
                                                   required>
                                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                <span class="text-gray-500">phần</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Số người cần hỗ trợ
                                    </label>
                                    <div class="relative">
                                        <input type="number" name="people_count" 
                                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" 
                                               min="1" 
                                               value="{{ old('people_count', 1) }}" 
                                               required>
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                            <span class="text-gray-500">người</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Nội dung yêu cầu cụ thể
                                    </label>
                                    <textarea name="message" 
                                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" 
                                              rows="4" 
                                              placeholder="Mô tả chi tiết tình hình và nhu cầu cần hỗ trợ..."
                                              required>{{ old('message') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="mt-6 flex items-center justify-end space-x-3">
                        <a href="{{ route('relief_requests.index') }}" 
                           class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-150">
                            <i class="fas fa-times mr-1"></i>
                            Hủy
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-150">
                            <i class="fas fa-paper-plane mr-1"></i>
                            Gửi yêu cầu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection