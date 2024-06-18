<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Layout</title>
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
</head>
<body>
    <footer style="margin-top:20px">
        <div class="footer-container">
            <div class="footer-section contact-info">
                <h4>Thông tin liên hệ</h4>
                <p>Địa chỉ: Số 123, Đường ABC, Thành phố XYZ</p>
                <p>Điện thoại: 0123 456 789</p>
                <p>Email: info@company.com</p>
            </div>
            <div class="footer-section quick-links">
                <h4>Liên kết nhanh</h4>
                <ul>
                    <li><a href="/">Trang chủ</a></li>
                    <li><a href="/products">Sản phẩm</a></li>
                    <li><a href="/services">Dịch vụ</a></li>
                    <li><a href="/contact">Liên hệ</a></li>
                    <li><a href="/support">Hỗ trợ</a></li>
                    <li><a href="/privacy-policy">Chính sách bảo mật</a></li>
                    <li><a href="/terms">Điều khoản sử dụng</a></li>
                </ul>
            </div>
            <div class="footer-section social-media">
                <h4>Theo dõi chúng tôi</h4>
                <div class="social-icons">
                    <a href="#"><img src="{{ asset('images/facebook-icon.png') }}" alt="Facebook" /></a>
                    <a href="#"><img src="{{ asset('images/zalo-icon.png') }}" alt="Zalo" /></a>
                </div>
            </div>
            <div class="footer-section newsletter">
                <h4>Đăng ký nhận tin</h4>
                <form action="/subscribe" method="post">
                    <input type="email" name="email" placeholder="Nhập email của bạn" required />
                    <button type="submit">Đăng ký</button>
                </form>
            </div>
            <div class="footer-section payment-methods">
                <h4>Phương thức thanh toán</h4>
                <div class="payment-icons">
                    <img src="{{ asset('images/visa-icon.png') }}" alt="Visa" />
                    <img src="{{ asset('images/cash-icon.png') }}" alt="Tiền Mặt" />
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Công ty TNHH ABC. Bảo lưu mọi quyền.</p>
        </div>
    </footer>
</body>
</html>
