@include('clients.header')

<div class="order-container">
    <div class="order-card">
        <div class="header-section">
            <h2 class="order-title">Đặt Hàng</h2>
            <p class="order-subtitle">Vui lòng điền đầy đủ thông tin để đặt hàng</p>
        </div>

        <form action="{{ route('order.store') }}" method="POST">
            @csrf
            <div class="form-section">
                <div class="form-group">
                    <label class="form-label" for="ho_va_ten">Họ và tên</label>
                    <div class="input-wrapper">
                        <input type="text" 
                               class="form-input" 
                               id="ho_va_ten" 
                               name="ho_va_ten" 
                               value="{{ old('ho_va_ten') }}" 
                               placeholder="Nhập họ và tên" 
                               required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="dia_chi">Địa chỉ giao hàng</label>
                    <div class="input-wrapper">
                        <input type="text" 
                               class="form-input" 
                               id="dia_chi" 
                               name="dia_chi" 
                               value="{{ old('dia_chi') }}" 
                               placeholder="Nhập địa chỉ giao hàng" 
                               required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="so_dien_thoai">Số điện thoại</label>
                    <div class="input-wrapper">
                        <input type="text" 
                               class="form-input" 
                               id="so_dien_thoai" 
                               name="so_dien_thoai" 
                               value="{{ old('so_dien_thoai') }}" 
                               placeholder="Nhập số điện thoại" 
                               required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="phuong_thuc_thanh_toan">Phương thức thanh toán</label>
                    <div class="input-wrapper">
                        <select class="form-input select" 
                                id="phuong_thuc_thanh_toan" 
                                name="phuong_thuc_thanh_toan" 
                                required>
                            <option value="" disabled selected>Chọn phương thức thanh toán</option>
                            <option value="Thanh toán khi nhận hàng">Thanh toán khi nhận hàng</option>
                            <option value="Thanh toán qua thẻ tín dụng">Thanh toán qua thẻ tín dụng</option>
                            <option value="Thanh toán qua ví điện tử">Thanh toán qua ví điện tử</option>
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-order">Xác Nhận Đặt Hàng</button>
        </form>
    </div>
</div>

<style>
.order-container {
    min-height: 80vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(135deg, #eef2f7 0%, #d9e2ec 100%);
    padding: 20px;
}

.order-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
    padding: 40px;
    width: 100%;
    max-width: 550px;
}

.header-section {
    text-align: center;
    margin-bottom: 30px;
}

.order-title {
    color: #1a2b49;
    font-size: 30px;
    font-weight: 700;
    margin-bottom: 10px;
}

.order-subtitle {
    color: #95a5a6;
    font-size: 15px;
}

.form-section {
    margin-bottom: 30px;
}

.form-group {
    margin-bottom: 25px;
}

.form-label {
    display: block;
    color: #2c3e50;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 8px;
}

.input-wrapper {
    position: relative;
}

.form-input {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #e0e6ed;
    border-radius: 10px;
    font-size: 16px;
    color: #2c3e50;
    background: #fff;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.form-input:focus {
    outline: none;
    border-color: #1abc9c;
    box-shadow: 0 0 5px rgba(26, 188, 156, 0.3);
}

.form-input::placeholder {
    color: #b0bec5;
}

.select {
    appearance: none;
    background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"><path fill="%2395a5a6" d="M7 10l5 5 5-5z"/></svg>') no-repeat right 15px center;
    background-size: 12px;
    padding-right: 35px;
}

.btn-order {
    display: block;
    width: 100%;
    padding: 14px;
    background: #1abc9c;
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease;
}

.btn-order:hover {
    background: #16a085;
    transform: translateY(-2px);
}
</style>