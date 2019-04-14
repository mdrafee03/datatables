<div class="details-container">
    <table class="details-table">
        <thead>
            <tr>
                <th>Book_name</td>
                <th>Sell or Return</td>
                <th>price</td>
                <th>Qty</td>
                <th>Total</td>
            </tr>
        </thead>
        <tbody>
            @foreach($cart->books as $books)
            <tr>
                <td>{{ $books->title }}</td>
                <td>{{ $books->pivot->sellOrReturn }}</td>
                <td>{{ $books->pivot->price }}</td>
                <td>{{ $books->pivot->quantity }}</td>
                <td>{{ $books->pivot->price }}</td>
            </tr>
            @endforeach
        </tbody>
</table>
</div>