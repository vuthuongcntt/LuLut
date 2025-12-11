1.	Giới thiệu 
- Relief-System là ứng dụng web phục vụ quản lý yêu cầu cứu trợ, nguồn hàng cứu trợ và điều phối phân phối trong tình huống thiên tai/khan hiếm.
- Ứng dụng cung cấp giao diện quản trị, API cho frontend và tích hợp bản đồ để hiển thị, định vị và tính lộ trình đến các điểm cứu trợ.
- Bản đồ sử dụng OpenStreetMap (OSM) + Leaflet cho hiển thị; Nominatim/Overpass/OSRM dùng cho geocoding, truy vấn dữ liệu không gian và routing.
2.	Mục tiêu và phạm vi
- Mục tiêu: hỗ trợ tổ chức cứu trợ quản lý, ưu tiên và phân phối nguồn lực hợp lý, minh bạch.
- Phạm vi bản MVP (bài giữa kỳ): đăng nhập/ phân quyền, quản lý yêu cầu cứu trợ, quản lý kho nguồn, lập phân phối, dashboard thống kê, tích hợp bản đồ (hiển thị điểm, chọn toạ độ, tìm kiếm địa điểm, tính lộ trình cơ bản).
3.	Yêu cầu
- Authentication: đăng ký, đăng nhập, quản lý session; phân quyền admin/user.
- Quản lý yêu cầu cứu trợ: tạo, chỉnh sửa, update trạng thái (pending, assigned, fulfilled, cancelled).
- Quản lý nguồn cung: thêm item, điều chỉnh tồn kho, trạng thái.
- Điều phối phân phối: gán supply cho request, tạo lịch trình phân phối, theo dõi trạng thái.
- Dashboard: thống kê tổng quan (số yêu cầu, tồn kho, phân phối).
- Bản đồ: hiển thị điểm cứu trợ, chọn toạ độ trên map, tìm kiếm địa điểm (geocoding), clustering marker, routing cơ bản.
4.	Yêu cầu phi chức năng
- Khai Bảo mật: lưu password băm, kiểm soát truy cập API, HTTPS.
- Hiệu năng: truy vấn trang kết hợp phân trang, caching cho bản đồ/tile (nếu host riêng).
- Khả năng mở rộng: tách dịch vụ routing/tiles khi cần.
- Tương thích di động: responsive UI.

5.	Chức năng chi tiết (mô tả & vai trò)
5.1	Authentication & Authorization
- Chức năng: đăng ký/đăng nhập, reset password, quản lý session.  
- Vai trò: bảo vệ thao tác CRUD; middleware kiểm soát route admin.  
- Lưu ý: password hash (bcrypt), CSRF protection (Laravel mặc định).
 <img width="744" height="419" alt="image" src="https://github.com/user-attachments/assets/c8fdf375-d91f-4276-96bc-084d54c56922" />

5.2	Quản lý người dùng
- Admin có thể quản lý tài khoản, phân quyền.  
- User có thể cập nhật thông tin cá nhân, xem trạng thái yêu cầu của mình.
<img width="789" height="444" alt="image" src="https://github.com/user-attachments/assets/81edd73f-ec8e-4cb9-868b-f3e788adbfea" />
<img width="794" height="446" alt="image" src="https://github.com/user-attachments/assets/4fb702f9-2be1-418b-9337-989a2d4ff641" />


5.3	Quản lý yêu cầu cứu trợ
- Tạo từ frontend: nhập tên, mô tả, số người, chọn vị trí bằng map (click hoặc geocoding).  
- Trạng thái theo workflow: pending -> assigned -> in_progress -> fulfilled/cancelled.  
- Vai trò: cơ sở dữ liệu cho phân phối và trực quan hoá trên bản đồ.
<img width="908" height="511" alt="image" src="https://github.com/user-attachments/assets/29ff4792-66f6-4c8f-8a2c-f4e56846341b" />
<img width="881" height="496" alt="image" src="https://github.com/user-attachments/assets/726934b7-ace6-4a45-98b1-73ac593962fd" />

5.4	Quản lý kho và nguồn cung
- Thêm/sửa loại hàng, số lượng tồn, vị trí kho.  
- Thông báo khi tồn kho thấp.  
- Vai trò: đảm bảo nguồn để phân phối.
<img width="913" height="513" alt="image" src="https://github.com/user-attachments/assets/edc51051-71b4-453c-b307-484baf9e8acd" />
<img width="884" height="497" alt="image" src="https://github.com/user-attachments/assets/e57a6d95-5698-4e6f-b179-d44588ff56d5" />

5.5	Phân phối
- Gán supply cho request (manual hoặc đề xuất tự động theo tồn kho và khoảng cách).  
- Tạo lịch trình và theo dõi trạng thái phân phối.  
- Lưu lịch sử để báo cáo/tính toán KPI.
<img width="864" height="486" alt="image" src="https://github.com/user-attachments/assets/ec1d5a07-690e-4ea7-b76a-ead3ea94ffed" />
<img width="867" height="488" alt="image" src="https://github.com/user-attachments/assets/ace6111b-0f1f-4292-8a95-a91b99f0c80e" />

5.6	Dashboard và báo cáo
- Thống kê: số request theo trạng thái, tồn kho tổng, số phân phối hoàn thành, vùng hoạt động (distinct locations).  
- Xuất báo cáo CSV/PDF (tùy chọn).
<img width="866" height="487" alt="image" src="https://github.com/user-attachments/assets/362c47be-25c7-4353-822d-7e78a04f885a" />

6.	Tích hợp bản đồ
6.1	Tổng quan
- Chọn Leaflet (client-side) + OpenStreetMap tiles (tile server) cho hiển thị.  
- Geocoding: Nominatim (OpenStreetMap).
- Truy vấn dữ liệu không gian: Overpass API (lấy POI, đường, ranh giới).  
- Routing: OSRM / GraphHopper / Valhalla (self-host hoặc dịch vụ).

6.2	Lý do chọn
- OSM/Leaflet là mã nguồn mở, không cần API key (nhưng phải tuân thủ chính sách sử dụng public servers).
- Miễn phí. 
- Dễ chuyển sang tự host khi cần hiệu năng cao hoặc SLA.

6.3	Chức năng bản đồ và cách hoạt động
- Hiển thị marker cho mỗi relief_request.  
- Marker màu khác nhau dựa trên status.
- Popup chi tiết khi click marker: tên, trạng thái, liên kết đến chi tiết.  
- Click map để lấy toạ độ (tạo request / sửa vị trí).   
- Clustering marker (MarkerCluster plugin) để hiển thị nhiều điểm.  
- Update điểm hiển thị theo vùng bản đồ (on map moveend -> gọi API backend   để lấy points trong bounds).

<img width="919" height="517" alt="image" src="https://github.com/user-attachments/assets/df9146be-0b54-4057-90ad-e102e70fc157" />
- Marker màu đỏ: chờ xử lý.

<img width="923" height="519" alt="image" src="https://github.com/user-attachments/assets/1e00484f-26d4-40f3-8079-a532273d3596" />
- Marker màu xanh lục: Vị trí kho.

<img width="925" height="520" alt="image" src="https://github.com/user-attachments/assets/ed0f6ecc-fe60-443d-9741-813c03f2be67" />
- Marker màu xanh: Địa điểm đã cứu trợ.

6.4	API (REST)
- GET /api/relief-points — lấy points (có params bounds, status, page)  
- GET /api/relief-points/{id} — chi tiết request  
- POST /api/relief-points — tạo mới (requires auth)  
- PUT /api/relief-points/{id} — cập nhật (requires auth)  
- POST /api/distributions — tạo phân phối  
- GET /api/dashboard — thống kê.  
7.	Tổng kết
Dự án Relief-System đã đạt được mục tiêu MVP: hệ thống cho phép thu thập và quản lý yêu cầu cứu trợ, quản lý nguồn cung, lập và theo dõi phân phối, cùng dashboard thống kê phục vụ quyết định.
Tích hợp bản đồ (Leaflet + OpenStreetMap) đã cung cấp các chức năng thiết yếu: hiển thị điểm cứu trợ, chọn tọa độ trực tiếp trên map, geocoding/báo địa chỉ (Nominatim), clustering và khả năng mở rộng cho routing (OSRM/GraphHopper). Điều này nâng cao khả năng trực quan hóa và hỗ trợ điều phối trên thực tế.
Kiến trúc Laravel + MySQL cùng API REST được thiết kế rõ ràng, dễ mở rộng và dễ bảo trì; frontend dùng Blade/Tailwind phù hợp cho MVP và cho phép chuyển sang SPA/mobile về sau.
