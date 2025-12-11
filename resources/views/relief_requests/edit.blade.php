@extends('layout.app')
@section('title', 'Sửa Yêu Cầu Cứu Trợ')

@section('content')
<div class="w-full px-4 py-6">
    <div class="max-w-4xl">
        <div class="mb-6">
            <p class="text-gray-600">Cập nhật thông tin để chúng tôi hỗ trợ chính xác hơn</p>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
            <div class="p-6">
                <form action="{{ route('relief_requests.update', $reliefRequest) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="space-y-6">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h2 class="text-lg font-semibold text-blue-800 mb-4">
                                <i class="fas fa-user-circle mr-2"></i>
                                Thông tin người yêu cầu
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Họ và tên</label>
                                    <input type="text" name="name" value="{{ $reliefRequest->name }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại</label>
                                    <input type="tel" name="phone" value="{{ $reliefRequest->phone }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                                </div>
                            </div>
                        </div>

                        <div class="bg-green-50 p-4 rounded-lg">
                            <h2 class="text-lg font-semibold text-green-800 mb-4">
                                <i class="fas fa-map-marked-alt mr-2"></i>
                                Thông tin địa điểm
                            </h2>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Tên địa điểm</label>
                                    <input type="text" name="location_name" value="{{ $reliefRequest->location_name }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500" required>
                                </div>
                            </div>
                        </div>

                        <div class="bg-purple-50 p-4 rounded-lg">
                            <h2 class="text-lg font-semibold text-purple-800 mb-4">
                                <i class="fas fa-hands-helping mr-2"></i>
                                Chi tiết yêu cầu
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Loại thực phẩm</label>
                                    <input type="text" name="food_type" value="{{ $reliefRequest->food_type }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Số lượng (phần)</label>
                                    <input type="number" name="food_quantity" min="1" value="{{ $reliefRequest->food_quantity }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" required>
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Số người</label>
                                <input type="number" name="people_count" min="1" value="{{ $reliefRequest->people_count }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" required>
                            </div>

                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nội dung yêu cầu</label>
                                <textarea name="message" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" required>{{ $reliefRequest->message }}</textarea>
                            </div>
                        </div>

                        <div class="bg-yellow-50 p-4 rounded-lg">
                            <h2 class="text-lg font-semibold text-yellow-800 mb-4">
                                <i class="fas fa-info-circle mr-2"></i>
                                Trạng thái
                            </h2>
                            <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:ring-yellow-500 focus:border-yellow-500" required>
                                <option value="pending" {{ $reliefRequest->status === 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                <option value="processing" {{ $reliefRequest->status === 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                                <option value="completed" {{ $reliefRequest->status === 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                <option value="cancelled" {{ $reliefRequest->status === 'cancelled' ? 'selected' : '' }}>Hủy</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end space-x-3">
                        <a href="{{ route('relief_requests.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">Hủy</a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection