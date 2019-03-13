<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ ucwords($item->content->title) }}</td>
    <td>{{ mb_strimwidth(ucfirst($item->content->description), 0, 18,'...') }}</td>
    <td>{{ \Carbon\Carbon::parse($item->due_date)->diffForHumans()}}</td>
    <td class="text-right">
        <a href="{{ route('order.view', $item->id) }}" class="btn btn-primary btn-sm">View</a>
    </td>
</tr>