@extends('layout.app')
@section('title', 'Dashboard Quản lý Cứu trợ')

@section('content')
<!-- Stats Cards -->
<div class="stats-grid fade-in">
    <div class="stat-card" style="--accent-color: linear-gradient(135deg, #ef4444, #dc2626)">
        <div class="stat-header">
            <div>
                <div class="stat-title">Yêu cầu chờ xử lý</div>
                <div class="stat-value">{{ $pendingRequests }}</div>
            </div>
            <div class="stat-icon" style="background: linear-gradient(135deg, #ef4444, #dc2626)">
                <i class="fas fa-clock"></i>
            </div>
        </div>
        <div class="stat-change positive">
            <i class="fas fa-arrow-down"></i>
            <span>Giảm 12% so với hôm qua</span>
        </div>
    </div>

    <div class="stat-card" style="--accent-color: linear-gradient(135deg, #f59e0b, #d97706)">
        <div class="stat-header">
            <div>
                <div class="stat-title">Tổng thực phẩm có sẵn</div>
                <div class="stat-value">{{ $totalSupplies }}</div>
            </div>
            <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706)">
                <i class="fas fa-warehouse"></i>
            </div>
        </div>
        <div class="stat-change positive">
            <i class="fas fa-arrow-up"></i>
            <span>Tăng 8% so với hôm qua</span>
        </div>
    </div>

    <div class="stat-card" style="--accent-color: linear-gradient(135deg, #10b981, #059669)">
        <div class="stat-header">
            <div>
                <div class="stat-title">Lần phân bổ</div>
                <div class="stat-value">{{ $distributions }}</div>
            </div>
            <div class="stat-icon" style="background: linear-gradient(135deg, #10b981, #059669)">
                <i class="fas fa-truck-moving"></i>
            </div>
        </div>
        <div class="stat-change positive">
            <i class="fas fa-arrow-up"></i>
            <span>Tăng 15% so với hôm qua</span>
        </div>
    </div>

    <div class="stat-card" style="--accent-color: linear-gradient(135deg, #3b82f6, #2563eb)">
        <div class="stat-header">
            <div>
                <div class="stat-title">Khu vực hoạt động</div>
                <div class="stat-value">12</div>
            </div>
            <div class="stat-icon" style="background: linear-gradient(135deg, #3b82f6, #2563eb)">
                <i class="fas fa-map-marked-alt"></i>
            </div>
        </div>
        <div class="stat-change positive">
            <i class="fas fa-arrow-up"></i>
            <span>+3 khu vực mới</span>
        </div>
    </div>
</div>

<!-- Main Dashboard Grid -->
<div class="dashboard-grid">
    <!-- Map Section -->
    <section class="dashboard-section">
        <div class="section-header">
            <h2 class="section-title">Bản đồ Tình hình Cứu trợ</h2>
            <div style="display: flex; gap: 0.5rem;">
                <button class="btn-secondary" onclick="refreshMapData()">
                    <i class="fas fa-sync-alt"></i>
                    Làm mới
                </button>
                <a href="{{ route('relief_requests.create') }}" class="btn-primary">
                    <i class="fas fa-plus"></i>
                    Tạo Yêu Cầu
                </a>
            </div>
        </div>
        
        <div class="map-container">
            <div id="disasterMap" style="height: 600px; width: 100%; border-radius: 16px;"></div>
            <!-- <div id="disasterMap" style="height: 70vh; width: 100%; border-radius: 16px;"></div> -->

            <!-- Map Legend -->
            <div class="map-legend">
                <div class="legend-item">
                    <div class="legend-color" style="background: #ef4444;"></div>
                    <span>Yêu cầu khẩn cấp</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color" style="background: #f59e0b;"></div>
                    <span>Đang xử lý</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color" style="background: #10b981;"></div>
                    <span>Đã hoàn thành</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color" style="background: #6b7280;"></div>
                    <span>Điểm cứu trợ</span>
                </div>
            </div>
        </div>
        
        <!-- Chart Section -->
        <div class="chart-container">
            <canvas id="distributionChart"></canvas>
        </div>
    </section>

    <!-- Recent Activity -->
    <section class="dashboard-section">
        <div class="section-header">
            <h2 class="section-title">Hoạt động gần đây</h2>
            <span class="status-badge status-active">Hoạt động</span>
        </div>
        
        <div class="priority-list">
            <div class="priority-item slide-in">
                <div class="priority-indicator priority-critical"></div>
                <div class="priority-content">
                    <div class="priority-title">Yêu cầu mới từ Hà Nội</div>
                    <div class="priority-details">Cần 500kg gạo cho 100 hộ dân bị lũ lụt</div>
                </div>
                <div class="priority-time">2 giờ trước</div>
            </div>
            
            <div class="priority-item slide-in">
                <div class="priority-indicator priority-high"></div>
                <div class="priority-content">
                    <div class="priority-title">Hoàn thành phân phối TP.HCM</div>
                    <div class="priority-details">Đã giao 1000kg thực phẩm cho 200 gia đình</div>
                </div>
                <div class="priority-time">4 giờ trước</div>
            </div>
            
            <div class="priority-item slide-in">
                <div class="priority-indicator priority-medium"></div>
                <div class="priority-content">
                    <div class="priority-title">Cập nhật kho hàng Đà Nẵng</div>
                    <div class="priority-details">Nhập thêm 2000kg gạo vào kho</div>
                </div>
                <div class="priority-time">6 giờ trước</div>
            </div>
        </div>
        
        <div style="margin-top: 1.5rem; display: flex; gap: 1rem;">
            <a href="{{ route('distributions.create') }}" class="btn-primary" style="flex: 1;">
                <i class="fas fa-plus"></i>
                Tạo kế hoạch phân phối
            </a>
            <a href="{{ route('relief_requests.index') }}" class="btn-secondary">
                <i class="fas fa-list"></i>
                Xem tất cả
            </a>
        </div>
    </section>
</div>

<style>
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--accent-color, linear-gradient(90deg, #667eea, #764ba2));
    border-radius: 20px 20px 0 0;
}

.stat-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.stat-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
}

.stat-title {
    color: #6b7280;
    font-size: 0.875rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
}

.stat-value {
    font-size: 2.5rem;
    font-weight: 800;
    color: #1f2937;
    margin-bottom: 0.5rem;
}

.stat-change {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    font-weight: 600;
}

.stat-change.positive {
    color: #059669;
}

.stat-change.negative {
    color: #dc2626;
}

.dashboard-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 2rem;
    margin-bottom: 2rem;
}

.dashboard-section {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #f3f4f6;
}

.section-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1f2937;
}

.map-container {
    height: 400px;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    position: relative;
}

.map-legend {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    padding: 1rem;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    z-index: 1000;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
}

.legend-color {
    width: 12px;
    height: 12px;
    border-radius: 50%;
}

.btn-secondary {
    background: #f3f4f6;
    color: #6b7280;
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-secondary:hover {
    background: #e5e7eb;
    transform: translateY(-1px);
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
}

.priority-list {
    max-height: 400px;
    overflow-y: auto;
}

.priority-item {
    display: flex;
    align-items: center;
    padding: 1rem;
    border-radius: 12px;
    margin-bottom: 0.75rem;
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    transition: all 0.3s ease;
}

.priority-item:hover {
    background: white;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transform: translateX(4px);
}

.priority-indicator {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    margin-right: 1rem;
    flex-shrink: 0;
}

.priority-critical { background: #ef4444; }
.priority-high { background: #f59e0b; }
.priority-medium { background: #10b981; }
.priority-low { background: #6b7280; }

.priority-content {
    flex: 1;
}

.priority-title {
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.25rem;
}

.priority-details {
    font-size: 0.875rem;
    color: #6b7280;
}

.priority-time {
    font-size: 0.75rem;
    color: #9ca3af;
    white-space: nowrap;
}

.chart-container {
    position: relative;
    height: 300px;
    margin-top: 1rem;
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.status-active {
    background: #dcfce7;
    color: #166534;
}

@media (max-width: 1024px) {
    .dashboard-grid {
        grid-template-columns: 1fr;
    }
    
    .stats-grid {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }
}

@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .stat-card {
        padding: 1.5rem;
    }
}
</style>
@endsection

@push('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
<script>
// Map
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing map...');
    const mapEl = document.getElementById('disasterMap');
    console.log('Map element:', mapEl);
    
    if (mapEl) {
        console.log('Creating map...');
        const map = L.map('disasterMap').setView([21.0285, 105.8542], 7);
        console.log('Map created:', map);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 18
        }).addTo(map);
        
        // Helper: escape HTML to mitigate stored XSS when inserting API data into DOM
        function escapeHtml(unsafe) {
            if (unsafe === null || unsafe === undefined) return '';
            return String(unsafe)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        // Load real data from API
        console.log('Fetching relief data...');
        fetch('/api/relief-data')
            .then(response => {
                console.log('API response:', response);
                return response.json();
            })
            .then(data => {
                console.log('Loaded relief data:', data);
                
                // Add relief request markers
                if (data.requests && data.requests.length > 0) {
                    data.requests.forEach(request => {
                        const color = request.status === 'pending' ? '#ef4444' : 
                                     request.status === 'processing' ? '#f59e0b' : '#10b981';
                        
                        const marker = L.circleMarker([request.latitude, request.longitude], {
                            radius: 8,
                            fillColor: color,
                            color: 'white',
                            weight: 2,
                            opacity: 1,
                            fillOpacity: 0.8
                        }).addTo(map);
                        
                        marker.bindPopup(`
                            <div style="padding: 10px; min-width: 250px;">
                                <h4 style="margin: 0 0 8px 0; color: #1f2937;">${escapeHtml(request.name)}</h4>
                                <p style="margin: 0 0 4px 0; font-size: 0.9rem;"><strong>📍 ${escapeHtml(request.location_name)}</strong></p>
                                <p style="margin: 0 0 4px 0; font-size: 0.9rem;">📞 ${escapeHtml(request.phone)}</p>
                                <p style="margin: 0 0 4px 0; font-size: 0.9rem;">🍚 Cần ${escapeHtml(request.food_quantity)}</p>
                                <p style="margin: 0 0 4px 0; font-size: 0.9rem;">👥 ${escapeHtml(request.people_count)}</p>
                                <p style="margin: 0 0 8px 0; font-size: 0.9rem;">
                                    <span class="badge" style="background: ${escapeHtml(color)}; color: white; padding: 2px 8px; border-radius: 4px;">
                                        ${escapeHtml(request.status)}
                                    </span>
                                </p>
                                <p style="margin: 0; font-size: 0.85rem; color: #6b7280; font-style: italic;">
                                    "${escapeHtml(request.message)}"
                                </p>
                            </div>
                        `);
                    });
                }
                
                // Add relief supply markers
                if (data.supplies && data.supplies.length > 0) {
                    data.supplies.forEach(supply => {
                        const marker = L.circleMarker([supply.latitude, supply.longitude], {
                            radius: 10,
                            fillColor: '#3b82f6',
                            color: 'white',
                            weight: 2,
                            opacity: 1,
                            fillOpacity: 0.7
                        }).addTo(map);
                        
                        marker.bindPopup(`
                            <div style="padding: 10px; min-width: 250px;">
                                <h4 style="margin: 0 0 8px 0; color: #1f2937;">📦 ${escapeHtml(supply.supply_type)}</h4>
                                <p style="margin: 0 0 4px 0; font-size: 0.9rem;"><strong>📍 ${escapeHtml(supply.location_name)}</strong></p>
                                <p style="margin: 0 0 4px 0; font-size: 0.9rem;">📊 Có sẵn: ${escapeHtml(supply.available_quantity)}</p>
                                <p style="margin: 0 0 8px 0; font-size: 0.9rem;">
                                    <span class="badge" style="background: #10b981; color: white; padding: 2px 8px; border-radius: 4px;">
                                        ${escapeHtml(supply.status)}
                                    </span>
                                </p>
                                ${supply.description ? `<p style="margin: 0; font-size: 0.85rem; color: #6b7280; font-style: italic;">${escapeHtml(supply.description)}</p>` : ''}
                            </div>
                        `);
                    });
                }
                
                // Fit map to show all markers
                if ((data.requests && data.requests.length > 0) || (data.supplies && data.supplies.length > 0)) {
                    const group = new L.featureGroup();
                    map.eachLayer(function(layer) {
                        if (layer instanceof L.CircleMarker) {
                            group.addLayer(layer);
                        }
                    });
                    if (group.getLayers().length > 0) {
                        map.fitBounds(group.getBounds().pad(0.1));
                    }
                }
            })
            .catch(error => {
                console.error('Error loading map data:', error);
                // Fallback to sample data if API fails
                addSampleMarkers(map);
            });
    }
    
    // Chart
    const ctx = document.getElementById('distributionChart');
    if (ctx && window.Chart) {
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Đã hoàn thành', 'Đang thực hiện', 'Chờ phê duyệt', 'Bị hủy'],
                datasets: [{
                    data: [45, 25, 20, 10],
                    backgroundColor: [
                        '#10b981',
                        '#f59e0b', 
                        '#3b82f6',
                        '#ef4444'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true
                        }
                    }
                }
            }
        });
    }
});

function addSampleMarkers(map) {
    // Fallback sample markers
    const markers = [
        { lat: 21.0285, lng: 105.8542, title: 'Hà Nội', type: 'critical' },
        { lat: 10.8231, lng: 106.6297, title: 'TP.HCM', type: 'high' },
        { lat: 16.0544, lng: 108.2022, title: 'Đà Nẵng', type: 'medium' }
    ];
    
    markers.forEach(marker => {
        const color = marker.type === 'critical' ? '#ef4444' : 
                     marker.type === 'high' ? '#f59e0b' : '#10b981';
        
        L.circleMarker([marker.lat, marker.lng], {
            radius: 8,
            fillColor: color,
            color: 'white',
            weight: 2,
            opacity: 1,
            fillOpacity: 0.8
        }).addTo(map).bindPopup(`
            <div style="padding: 10px;">
                <h3>${marker.title}</h3>
                <p>Mức độ: ${marker.type}</p>
            </div>
        `);
    });
}

function refreshMapData() {
    console.log('Refreshing map data...');
    // Reload the page to refresh map data
    location.reload();
}
</script>
@endpush