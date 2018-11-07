    <a href="{{ route('customers.edit', ['$id' => $customer->id]) }}" class="btn btn-success btn-sm">Edit</a>
    <form action="/customers/{{ $customer->id }}" method="post" id="deleteForm">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
    </form>