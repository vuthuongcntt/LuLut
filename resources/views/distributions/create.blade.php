@extends('layout.app')
@section('title', 'Tạo Phân Bổ Cứu Trợ')

@section('content')
<div class="w-full px-4 py-6">
    <div class="max-w-4xl">
        <div class="mb-6">
            <p class="text-gray-600">Chọn yêu cầu và nguồn phù hợp để tiến hành phân bổ</p>
        </div>

        <div class="card">
            <div class="card-header">
                <i class="fas fa-plus mr-2"></i>
                Tạo phân bổ cứu trợ mới
            </div>
            <div class="p-6">
                <form action="{{ route('distributions.store') }}" method="POST">
                    @csrf

                    <div class="space-y-6">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h2 class="text-lg font-semibold text-blue-800 mb-4">
                                <i class="fas fa-handshake mr-2"></i>
                                Chọn đối tượng
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="form-label">Yêu cầu cứu trợ</label>
                                    <select name="relief_request_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500" required>
                                        <option value="">-- Chọn yêu cầu --</option>
                                        @foreach ($requests as $req)
                                            <option value="{{ $req->id }}">{{ $req->name }} - {{ $req->location_name }} ({{ $req->food_quantity }} phần)</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label">Nguồn cứu trợ</label>
                                    <select name="relief_supply_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500" required>
                                        <option value="">-- Chọn nguồn --</option>
                                        @foreach ($supplies as $supply)
                                            <option value="{{ $supply->id }}">{{ $supply->supply_type }} - {{ $supply->location_name }} ({{ $supply->available_quantity }} phần)</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="bg-purple-50 p-4 rounded-lg">
                            <h2 class="text-lg font-semibold text-purple-800 mb-4">
                                <i class="fas fa-clipboard-list mr-2"></i>
                                Thông tin phân bổ
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="form-label">Số lượng phân bổ (phần)</label>
                                    <input type="number" name="quantity_distributed" min="1" value="{{ old('quantity_distributed', 1) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" required>
                                </div>
                                <div>
                                    <label class="form-label">Ghi chú</label>
                                    <textarea name="notes" rows="1" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">{{ old('notes') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end space-x-3">
                        <a href="{{ route('distributions.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">Hủy</a>
                        <button type="submit" class="btn-custom">Phân bổ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection