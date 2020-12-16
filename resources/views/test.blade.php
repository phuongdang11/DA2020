<table class="carts">
    <thead>
        <tr>
            <th>Tên</th>
            <th>Số Ly</th>
            <th>Giá</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cartitem as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->price }}</td>
            <td><a href="{{ route('ct.dl', $item->id) }}">del</a></td>
        </tr>
        @endforeach
    </tbody>
</table>