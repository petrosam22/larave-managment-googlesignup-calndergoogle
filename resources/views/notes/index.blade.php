
@extends('home')


@section('content')
<div class="text-end mt-3">
    <button type="submit" class="btn btn-primary">
    <a class="text-white text-decoration-none" href="{{ route('note.create') }}">
            Create Note
        </a>
    </button>

</div>

<table class="table">
    <thead>
      <tr>
         <th scope="col">name</th>
        <th scope="col">description</th>
      </tr>
    </thead>
    <tbody>

        @foreach ( $notes as $note )

        <tr>

            <td>{{ $note->title }}</td>
            <td>{{ $note->description }}</td>
        </tr>

        @endforeach
    </tbody>
  </table>

@endsection
