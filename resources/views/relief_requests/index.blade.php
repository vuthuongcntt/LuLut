@extends('layout.app')
@section('title', 'Yêu Cầu Cứu Trợ')

@section('content')
<div class="w-full px-4 py-6">
    <div class="mb-6 flex justify-end">
        <a href="{{ route('relief_requests.create') }}" 
           class="btn-custom flex items-center space-x-2">
            <i class="fas fa-plus"></i>
            <span>Thêm yêu cầu mới</span>
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
        <p class="font-medium">{{ session('success') }}</p>
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <i class="fas fa-list-check mr-2"></i>
            Danh sách yêu cầu cứu trợ
        </div>
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Người yêu cầu
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Địa điểm
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Chi tiết yêu cầu
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Trạng thái
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Thao tác
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($requests as $req)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-full bg-blue-100">
                                    <i class="fas fa-user text-blue-600"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $req->name }}</div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-phone mr-1"></i>
                                        {{ $req->phone }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $req->location_name }}</div>
                            <div class="text-xs text-gray-500">
                                <i class="fas fa-map-marker-alt text-red-500 mr-1"></i>
                                {{ number_format($req->latitude, 4) }}, {{ number_format($req->longitude, 4) }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-box text-yellow-500 mr-1"></i>
                                    <span>{{ $req->food_quantity }} phần</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-users text-blue-500 mr-1"></i>
                                    <span>{{ $req->people_count }} người</span>
                                </div>
                            </div>
                            @if($req->message)
                            <div class="text-xs text-gray-500 mt-1">
                                <i class="fas fa-comment text-gray-400 mr-1"></i>
                                {{ Str::limit($req->message, 50) }}
                            </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusConfig = [
                                    'pending' => [
                                        'color' => 'yellow',
                                        'text' => 'Đang chờ',
                                        'icon' => 'fa-clock'
                                    ],
                                    'processing' => [
                                        'color' => 'blue',
                                        'text' => 'Đang xử lý',
                                        'icon' => 'fa-spinner'
                                    ],
                                    'completed' => [
                                        'color' => 'green',
                                        'text' => 'Hoàn thành',
                                        'icon' => 'fa-check-circle'
                                    ],
                                    'cancelled' => [
                                        'color' => 'red',
                                        'text' => 'Đã hủy',
                                        'icon' => 'fa-times-circle'
                                    ]
                                ][$req->status] ?? [
                                    'color' => 'gray',
                                    'text' => $req->status,
                                    'icon' => 'fa-question-circle'
                                ];
                            @endphp
                            <span class="badge bg-{{ $statusConfig['color'] }}-100 text-{{ $statusConfig['color'] }}-700">
                                <i class="fas {{ $statusConfig['icon'] }} mr-1"></i>
                                <span>{{ $statusConfig['text'] }}</span>
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                                <a href="{{ route('relief_requests.show', $req) }}" 
                                   class="text-blue-600 hover:text-blue-900 px-2 py-1 rounded-md hover:bg-blue-50 transition">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('relief_requests.edit', $req) }}" 
                                   class="text-indigo-600 hover:text-indigo-900 px-2 py-1 rounded-md hover:bg-indigo-50 transition">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('relief_requests.destroy', $req) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Bạn có chắc muốn xóa yêu cầu này?')"
                                            class="text-red-600 hover:text-red-900 px-2 py-1 rounded-md hover:bg-red-50 transition">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center">
                            <div class="flex flex-col items-center justify-center space-y-4">
                                <div class="bg-gray-100 rounded-full p-3">
                                    <i class="fas fa-inbox text-4xl text-gray-400"></i>
                                </div>
                                <div class="text-gray-500">Chưa có yêu cầu cứu trợ nào</div>
                                <a href="{{ route('relief_requests.create') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                                    Thêm yêu cầu mới ngay
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