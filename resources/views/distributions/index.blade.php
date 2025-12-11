@extends('layout.app')
@section('title', 'Quản Lý Phân Phối')

@section('content')
<div class="w-full px-4 py-6">
    <div class="mb-6 flex justify-end">
        <a href="{{ route('distributions.create') }}" 
           class="btn-custom flex items-center space-x-2">
            <i class="fas fa-plus"></i>
            <span>Tạo phân phối mới</span>
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
        <p class="font-medium">{{ session('success') }}</p>
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <i class="fas fa-truck mr-2"></i>
            Danh sách phân phối
        </div>
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Chi tiết yêu cầu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thông tin phân phối</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thời gian</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($distributions as $dist)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-full bg-blue-100">
                                    <i class="fas fa-user text-blue-600"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $dist->reliefRequest->name }}</div>
                                    <div class="text-sm text-gray-500">
                                        <span class="inline-flex items-center">
                                            <i class="fas fa-hashtag text-gray-400 mr-1"></i>
                                            Yêu cầu #{{ $dist->relief_request_id }}
                                        </span>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-map-marker-alt text-red-500 mr-1"></i>
                                        {{ $dist->reliefRequest->location_name }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <div class="text-sm font-medium text-gray-900">
                                    <i class="fas fa-box text-yellow-500 mr-1"></i>
                                    {{ $dist->reliefSupply->supply_type }}
                                </div>
                                <div class="flex items-center mt-1">
                                    <span class="badge bg-green-100 text-green-800">
                                        {{ number_format($dist->quantity_distributed) }} phần
                                    </span>
                                </div>
                                @if($dist->notes)
                                <div class="text-sm text-gray-500 mt-1">
                                    <i class="fas fa-comment text-gray-400 mr-1"></i>
                                    {{ $dist->notes }}
                                </div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                <i class="fas fa-clock text-indigo-500 mr-1"></i>
                                {{ $dist->distributed_at ? $dist->distributed_at->format('d/m/Y H:i') : 'N/A' }}
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $dist->distributed_at ? $dist->distributed_at->diffForHumans() : '' }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('distributions.destroy', $dist) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Bạn có chắc muốn xóa bản ghi phân phối này?')"
                                        class="text-red-600 hover:text-red-900 px-2 py-1 rounded-md hover:bg-red-50 transition duration-150">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center">
                            <div class="flex flex-col items-center justify-center space-y-4">
                                <div class="bg-gray-100 rounded-full p-3">
                                    <i class="fas fa-box-open text-4xl text-gray-400"></i>
                                </div>
                                <div class="text-gray-500">Chưa có bản ghi phân phối nào</div>
                                <a href="{{ route('distributions.create') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                                    Tạo phân phối mới ngay
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