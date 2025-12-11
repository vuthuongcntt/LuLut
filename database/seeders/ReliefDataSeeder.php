<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ReliefRequest;
use App\Models\ReliefSupply;

class ReliefDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo dữ liệu mẫu cho ReliefRequest
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

        ReliefRequest::create([
            'name' => 'Lê Văn C',
            'phone' => '0965432109',
            'latitude' => 16.0544,
            'longitude' => 108.2022,
            'location_name' => 'Quận Hải Châu, Đà Nẵng',
            'message' => 'Yêu cầu cứu trợ sau bão lũ',
            'food_type' => 'Nước uống',
            'food_quantity' => 200,
            'people_count' => 30,
            'status' => 'completed'
        ]);

        // Tạo dữ liệu mẫu cho ReliefSupply
        ReliefSupply::create([
            'supply_type' => 'Gạo',
            'available_quantity' => 1000,
            'latitude' => 21.0333,
            'longitude' => 105.8500,
            'location_name' => 'Kho Hà Nội',
            'description' => 'Kho thực phẩm chính tại Hà Nội',
            'status' => 'available'
        ]);

        ReliefSupply::create([
            'supply_type' => 'Mì gói',
            'available_quantity' => 500,
            'latitude' => 10.8000,
            'longitude' => 106.7000,
            'location_name' => 'Kho TP.HCM',
            'description' => 'Kho thực phẩm tại TP.HCM',
            'status' => 'available'
        ]);

        ReliefSupply::create([
            'supply_type' => 'Nước uống',
            'available_quantity' => 300,
            'latitude' => 16.0000,
            'longitude' => 108.2000,
            'location_name' => 'Kho Đà Nẵng',
            'description' => 'Kho nước uống tại Đà Nẵng',
            'status' => 'low'
        ]);
    }
}
