<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('relief_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên người yêu cầu
            $table->string('phone'); // Số điện thoại
            $table->decimal('latitude', 10, 8); // Vĩ độ
            $table->decimal('longitude', 11, 8); // Kinh độ
            $table->string('location_name'); // Tên địa điểm
            $table->text('message'); // Tin nhắn yêu cầu
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending');
            $table->integer('food_quantity')->default(0); // Số lượng thực phẩm cần
            $table->string('food_type')->nullable(); // Loại thực phẩm cần
            $table->integer('people_count')->default(1); // Số người cần hỗ trợ
            $table->timestamps();
            $table->index(['latitude', 'longitude']);
        });

        Schema::create('relief_supplies', function (Blueprint $table) {
            $table->id();
            $table->string('supply_type'); // Loại cứu trợ
            $table->integer('available_quantity'); // Số lượng có sẵn
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('location_name');
            $table->text('description')->nullable();
            $table->enum('status', ['available', 'low', 'out_of_stock'])->default('available');
            $table->timestamps();
        });

        Schema::create('distributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('relief_request_id')->constrained()->onDelete('cascade');
            $table->foreignId('relief_supply_id')->constrained()->onDelete('cascade');
            $table->integer('quantity_distributed');
            $table->timestamp('distributed_at')->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('distributions');
        Schema::dropIfExists('relief_supplies');
        Schema::dropIfExists('relief_requests');
    }
};