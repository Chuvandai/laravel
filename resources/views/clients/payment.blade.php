@include('clients.header')

<div class="payment-container">
    <div class="payment-card">
        <h2 class="payment-title">Thông Tin Thanh Toán</h2>
        <p class="payment-subtitle">Vui lòng kiểm tra thông tin trước khi thanh toán</p>

        <form action="{{ route('payment.store', ['order' => $order->id]) }}" method="POST">
            @csrf
            <div class="form-section">
                <div class="form-group">
                    <label class="form-label">Họ và tên</label>
                    <div class="input-wrapper">
                        <input type="text" 
                               class="form-input readonly" 
                               id="ho_va_ten" 
                               name="ho_va_ten" 
                               value="{{ old('ho_va_ten', $order->ho_va_ten) }}" 
                               required 
                               readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Địa chỉ giao hàng</label>
                    <div class="input-wrapper">
                        <input type="text" 
                               class="form-input readonly" 
                               id="dia_chi" 
                               name="dia_chi" 
                               value="{{ old('dia_chi', $order->dia_chi) }}" 
                               required 
                               readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Số điện thoại</label>
                    <div class="input-wrapper">
                        <input type="text" 
                               class="form-input readonly" 
                               id="so_dien_thoai" 
                               name="so_dien_thoai" 
                               value="{{ old('so_dien_thoai', $order->so_dien_thoai) }}" 
                               required 
                               readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Phương thức thanh toán</label>
                    <div class="input-wrapper">
                        <select class="form-input select" 
                                id="phuong_thuc_thanh_toan" 
                                name="phuong_thuc_thanh_toan" 
                                required>
                            <option value="Thanh toán khi nhận hàng" 
                                    {{ $order->phuong_thuc_thanh_toan == 'Thanh toán khi nhận hàng' ? 'selected' : '' }}>
                                Thanh toán khi nhận hàng
                            </option>
                            <option value="Thanh toán qua thẻ tín dụng" 
                                    {{ $order->phuong_thuc_thanh_toan == 'Thanh toán qua thẻ tín dụng' ? 'selected' : '' }}>
                                Thanh toán qua thẻ tín dụng
                            </option>
                            <option value="Thanh toán qua ví điện tử" 
                                    {{ $order->phuong_thuc_thanh_toan == 'Thanh toán qua ví điện tử' ? 'selected' : '' }}>
                                Thanh toán qua ví điện tử
                            </option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Tổng tiền</label>
                    <div class="input-wrapper">
                        <input type="text" 
                               class="form-input readonly total" 
                               id="tong_tien" 
                               name="tong_tien" 
                               value="{{ old('tong_tien', number_format($order->tong_tien, 0, ',', '.')) }} VND" 
                               required 
                               readonly>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-submit">Thanh Toán Ngay</button>
        </form>
    </div>
</div>

<style>
.payment-container {
    min-height: 80vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #f4f6f9;
    padding: 20px;
}

.payment-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
    padding: 40px;
    width: 100%;
    max-width: 600px;
}

.payment-title {
    color: #2c3e50;
    font-size: 28px;
    font-weight: 700;
    text-align: center;
    margin-bottom: 10px;
}

.payment-subtitle {
    color: #7f8c8d;
    font-size: 16px;
    text-align: center;
    margin-bottom: 30px;
}

.form-section {
    margin-bottom: 30px;
}

.form-group {
    margin-bottom: 25px;
}

.form-label {
    display: block;
    color: #34495e;
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
    border: 1px solid #dfe6e9;
    border-radius: 8px;
    font-size: 16px;
    color: #2c3e50;
    background: #fff;
    transition: border-color 0.3s ease;
}

.form-input:focus {
    outline: none;
    border-color: #3498db;
}

.readonly {
    background: #f8f9fa;
    color: #7f8c8d;
}

.select {
    appearance: none;
    background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"><path fill="%237f8c8d" d="M7 10l5 5 5-5z"/></svg>') no-repeat right 15px center;
    background-size: 12px;
    padding-right: 35px;
}

.total {
    font-weight: 600;
    color: #e74c3c;
    font-size: 18px;
}

.btn-submit {
    display: block;
    width: 100%;
    padding: 14px;
    background: #3498db;
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s ease;
}

.btn-submit:hover {
    background: #2980b9;
}
</style>