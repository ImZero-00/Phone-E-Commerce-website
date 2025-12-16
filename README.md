# 📱 S-Phone - Website Thương Mại Điện Tử Điện Thoại

Website bán điện thoại trực tuyến được xây dựng bằng PHP, MySQL và Bootstrap.

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)

## 📋 Mục lục

- [Giới thiệu](#-giới-thiệu)
- [Tính năng](#-tính-năng)
- [Cấu trúc thư mục](#-cấu-trúc-thư-mục)
- [Yêu cầu hệ thống](#-yêu-cầu-hệ-thống)
- [Cài đặt](#-cài-đặt)
- [Cấu hình](#-cấu-hình)
- [Sử dụng](#-sử-dụng)
- [API](#-api)
- [Thanh toán](#-thanh-toán)
- [Tác giả](#-tác-giả)

## 🎯 Giới thiệu

**S-Phone** là một website thương mại điện tử chuyên bán điện thoại di động. Website cung cấp giao diện thân thiện, dễ sử dụng với đầy đủ các tính năng cần thiết cho một cửa hàng trực tuyến.

## ✨ Tính năng

### 👤 Người dùng
- ✅ Đăng ký / Đăng nhập / Đăng xuất
- ✅ Quên mật khẩu (xác thực qua thông tin cá nhân)
- ✅ Quản lý thông tin cá nhân
- ✅ Xem danh sách sản phẩm với bộ lọc và sắp xếp
- ✅ Xem chi tiết sản phẩm
- ✅ Thêm sản phẩm vào giỏ hàng
- ✅ Quản lý giỏ hàng (thêm, sửa, xóa)
- ✅ Thanh toán qua VNPay
- ✅ Xem lịch sử giao dịch

### 🔐 Quản trị viên (Admin)
- ✅ Quản lý người dùng (thêm, sửa, xóa)
- ✅ Quản lý sản phẩm (thêm, sửa, xóa)
- ✅ Xem thống kê giao dịch

## 📁 Cấu trúc thư mục

```
Phone-E-Commerce-website/
│
├── index.php                    # Trang chủ
│
├── admin/                       # 🔐 Quản trị
│   ├── product_management.php   # Quản lý sản phẩm
│   ├── user_management.php      # Quản lý người dùng
│   └── transaction_search.php   # Tra cứu giao dịch
│
├── api/                         # 🔌 API endpoints
│   └── products_api.php         # API danh sách sản phẩm
│
├── assets/                      # 📦 Tài nguyên tĩnh
│   ├── css/
│   │   └── style.css            # CSS chính
│   └── images/                  # Hình ảnh sản phẩm
│
├── auth/                        # 🔑 Xác thực
│   ├── login.php                # Đăng nhập
│   ├── logout.php               # Đăng xuất
│   ├── register.php             # Đăng ký
│   └── forgot_password.php      # Quên mật khẩu
│
├── cart/                        # 🛒 Giỏ hàng
│   ├── cart.php                 # Xem giỏ hàng
│   ├── add_to_cart.php          # Thêm vào giỏ
│   ├── update_cart.php          # Cập nhật giỏ
│   └── delete_cart_item.php     # Xóa khỏi giỏ
│
├── checkout/                    # 💳 Thanh toán
│   ├── checkout.php             # Xử lý đặt hàng
│   ├── checkout_vnpay.php       # Chuyển sang VNPay
│   ├── payment_confirm.php      # Xác nhận thanh toán
│   └── vnpay_return.php         # Callback từ VNPay
│
├── config/                      # ⚙️ Cấu hình
│   ├── db.php                   # Kết nối database
│   └── vnpay_config.php         # Cấu hình VNPay
│
├── pages/                       # 📄 Các trang chính
│   ├── products.php             # Danh sách sản phẩm
│   ├── product_detail.php       # Chi tiết sản phẩm
│   └── profile.php              # Thông tin cá nhân
│
├── templates/                   # 🎨 Templates dùng chung
│   ├── header.php               # Header
│   └── footer.php               # Footer
│
└── README.md                    # Tài liệu hướng dẫn
```

## 💻 Yêu cầu hệ thống

- **PHP** >= 7.4
- **MySQL** >= 5.7
- **Web Server**: Apache / Nginx / XAMPP / Laragon
- **Trình duyệt**: Chrome, Firefox, Safari, Edge (phiên bản mới nhất)

## 🚀 Cài đặt

### Bước 1: Clone dự án

```bash
git clone https://github.com/your-username/Phone-E-Commerce-website.git
cd Phone-E-Commerce-website
```

### Bước 2: Cấu hình Web Server

**Sử dụng XAMPP:**
1. Copy thư mục dự án vào `C:\xampp\htdocs\`
2. Khởi động Apache và MySQL từ XAMPP Control Panel
3. Truy cập `http://localhost/Phone-E-Commerce-website/`

**Sử dụng Laragon:**
1. Copy thư mục dự án vào `C:\laragon\www\`
2. Khởi động Laragon
3. Truy cập `http://phone-e-commerce-website.test/`

### Bước 3: Cấu hình Database

Mở file `config/db.php` và cập nhật thông tin kết nối:

```php
$host = 'localhost';
$db   = 'your_database_name';
$user = 'your_username';
$pass = 'your_password';
```

> 💡 **Lưu ý**: Các bảng database sẽ được tự động tạo khi chạy ứng dụng lần đầu.

## ⚙️ Cấu hình

### Cấu hình VNPay

Mở file `config/vnpay_config.php` và cập nhật thông tin:

```php
return [
    'vnp_TmnCode'    => 'YOUR_TMN_CODE',      // Mã website tại VNPay
    'vnp_HashSecret' => 'YOUR_HASH_SECRET',   // Chuỗi bí mật
    'vnp_Url'        => 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html',
    'vnp_ReturnUrl'  => 'http://your-domain.com/checkout/vnpay_return.php',
];
```

## 📖 Sử dụng

### Truy cập trang chủ
```
http://localhost/Phone-E-Commerce-website/
```

### Đăng nhập Admin
- Tạo tài khoản admin bằng cách đặt `is_admin = 1` trong database
- Đăng nhập tại `/auth/login.php`

### Các trang chính

| Trang | URL |
|-------|-----|
| Trang chủ | `/index.php` |
| Sản phẩm | `/pages/products.php` |
| Đăng nhập | `/auth/login.php` |
| Đăng ký | `/auth/register.php` |
| Giỏ hàng | `/cart/cart.php` |
| Quản lý sản phẩm (Admin) | `/admin/product_management.php` |
| Quản lý người dùng (Admin) | `/admin/user_management.php` |

## 🔌 API

### Lấy danh sách sản phẩm

```
GET /api/products_api.php
```

**Response:**
```json
[
  {
    "id": 1,
    "title": "iPhone 15 Pro Max 256GB",
    "price": 28990000,
    "image": "assets/images/phone1.jpg"
  },
  ...
]
```

## 💳 Thanh toán

Website hỗ trợ thanh toán qua **VNPay** - cổng thanh toán phổ biến tại Việt Nam.

### Quy trình thanh toán:
1. Người dùng chọn sản phẩm và thêm vào giỏ hàng
2. Tiến hành thanh toán
3. Chuyển hướng đến trang thanh toán VNPay
4. Hoàn tất thanh toán và quay lại website
5. Xác nhận đơn hàng thành công

## 🛡️ Bảo mật

- Mật khẩu được mã hóa bằng `password_hash()` với thuật toán bcrypt
- Sử dụng PDO prepared statements để chống SQL Injection
- Session được quản lý an toàn
- Xác thực chữ ký số từ VNPay

## 📸 Screenshots

### Trang chủ
![Homepage](assets/images/screenshots/homepage.png)

### Danh sách sản phẩm
![Products](assets/images/screenshots/products.png)

### Giỏ hàng
![Cart](assets/images/screenshots/cart.png)

## 🤝 Đóng góp

Mọi đóng góp đều được chào đón! Vui lòng:

1. Fork dự án
2. Tạo branch mới (`git checkout -b feature/AmazingFeature`)
3. Commit thay đổi (`git commit -m 'Add some AmazingFeature'`)
4. Push lên branch (`git push origin feature/AmazingFeature`)
5. Tạo Pull Request

## 📝 License

Dự án này được phân phối dưới giấy phép MIT. Xem file `LICENSE` để biết thêm chi tiết.

## 👨‍💻 Tác giả

**S-Phone Team**

- Website: [https://s-phone.com](https://s-phone.com)
- Email: contact@s-phone.com

---

<p align="center">
  Made with ❤️ in Vietnam 🇻🇳
</p>
