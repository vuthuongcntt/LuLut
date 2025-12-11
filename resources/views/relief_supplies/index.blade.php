@extends('layout.app')
@section('title', 'Quản lý Kho Hàng')

@section('content')
<div class="w-full px-4 py-6">
    <div class="mb-6 flex justify-end">
        <a href="{{ route('relief_supplies.create') }}" 
           class="btn-custom flex items-center space-x-2">
            <i class="fas fa-plus"></i>
            <span>Thêm nguồn mới</span>
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
        <p class="font-medium">{{ session('success') }}</p>
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <i class="fas fa-warehouse mr-2"></i>
            Danh sách nguồn hàng cứu trợ
        </div>
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thông tin hàng</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Địa điểm</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số lượng</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($supplies as $supply)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-lg bg-blue-100 text-blue-600">
                                    <i class="fas fa-box-open text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $supply->supply_type }}</div>
                                    <div class="text-sm text-gray-500">{{ $supply->description ? Str::limit($supply->description, 50) : 'Không có mô tả' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $supply->location_name }}</div>
                            <div class="text-xs text-gray-500">
                                <i class="fas fa-map-marker-alt text-red-500 mr-1"></i>
                                {{ number_format($supply->latitude, 4) }}, {{ number_format($supply->longitude, 4) }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-semibold 
                                {{ $supply->available_quantity > 100 ? 'text-green-600' : 
                                   ($supply->available_quantity > 20 ? 'text-yellow-600' : 'text-red-600') }}">
                                {{ number_format($supply->available_quantity) }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusConfig = [
                                    'available' => [
                                        'color' => 'green',
                                        'text' => 'Sẵn sàng',
                                        'icon' => 'fa-check-circle'
                                    ],
                                    'low' => [
                                        'color' => 'yellow',
                                        'text' => 'Sắp hết',
                                        'icon' => 'fa-exclamation-circle'
                                    ],
                                    'out_of_stock' => [
                                        'color' => 'red',
                                        'text' => 'Hết hàng',
                                        'icon' => 'fa-times-circle'
                                    ]
                                ][$supply->status] ?? [
                                    'color' => 'gray',
                                    'text' => $supply->status,
                                    'icon' => 'fa-question-circle'
                                ];
                            @endphp
                            <span class="badge bg-{{ $statusConfig['color'] }}-100 text-{{ $statusConfig['color'] }}-700">
                                <i class="fas {{ $statusConfig['icon'] }} mr-1"></i>
                                <span>{{ $statusConfig['text'] }}</span>
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-3">
                            <a href="{{ route('relief_supplies.edit', $supply) }}" 
                               class="inline-flex items-center px-3 py-1 border border-blue-600 text-blue-600 hover:bg-blue-50 rounded-md transition duration-150">
                                <i class="fas fa-edit mr-1"></i>
                                <span>Sửa</span>
                            </a>
                            <form action="{{ route('relief_supplies.destroy', $supply) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Bạn có chắc muốn xóa nguồn hàng này?')"
                                        class="inline-flex items-center px-3 py-1 border border-red-600 text-red-600 hover:bg-red-50 rounded-md transition duration-150">
                                    <i class="fas fa-trash-alt mr-1"></i>
                                    <span>Xóa</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center">
                            <div class="flex flex-col items-center justify-center space-y-4">
                                <div class="bg-gray-100 rounded-full p-3">
                                    <i class="fas fa-box-open text-4xl text-gray-400"></i>
                                </div>
                                <div class="text-gray-500">Chưa có nguồn hàng cứu trợ nào được thêm vào</div>
                                <a href="{{ route('relief_supplies.create') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                                    Thêm nguồn hàng mới ngay
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection