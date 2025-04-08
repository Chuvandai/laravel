@include('clients.header')


    <div class="container">
        <h2>Giỏ Hàng</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>Sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Giá</th>
                    <th>Dung lượng</th>
                    <th>Màu sắc</th>
                    <th>Số lượng</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($cart as $item)
              <tr>
                <td>{{ $item['name'] }}</td>
                <td><img src="{{ asset($item['image']) }}" width="50" alt="{{ $item['name'] }}"></td>
                <td>{{ number_format($item['price']) }}₫</td>
                <td>{{ $item['storage'] }}</td>
                <td>{{ $item['color'] }}</td>
                <td class="d-flex justify-center align-items-center">
                    <span style="margin-right: 5px;">{{ $item['quantity'] }}</span>
                    <form action="{{ route('card.remove')}}" method="POST" class="remove-item-form">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" value="{{ $item['id'] }}">
                        <button onclick="return confirm('Bạn có muốn xóa khỏi giỏ hàng ??')" class="btn btn-danger" type="submit">Xóa</button>
                    </form>
                    
                </td>
                
            </tr>
              @endforeach
            </tbody>    
        </table>
        <div class="nut">
           <div class="text-price  " style="color: red; font-weight:bold; " >
            <strong>Tổng tiền: </strong> 
            {{ number_format($totalPrice, 0, ',', '.') }} VNĐ
           </div>

          {{-- <a href="{{ route('order.index') }}" class="btn btn-primary">Đặt hàng</a> --}}
          <a href="{{ route('checkout') }}" class="btn btn-primary">Thanh toán</a>
        </div>
      
    </div>
    <style>
        .nut{
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px;
        }
    </style>
    @include('clients.footer')