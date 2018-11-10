@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">Links</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Main Links</th>
                                <th scope="col">Shorted Links</th>
                                <th scope="col">Creation Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($links as $key => $link)
                            <tr>
                                <th scope="row">{{ ++$key }}</th>
                                <td style="max-width:250px;">
                                    <a href="{{ $link->main_url }}">
                                        <i class="fas fa-external-link-alt"></i>&nbsp;{{ $link->main_url }}
                                    </a>    
                                </td>
                                <td>
                                    <a href="{{ route('goto' ,['url' => $link->shortened_url]) }}">
                                        <i class="fas fa-external-link-alt"></i>&nbsp;{{ route('goto', ['url' => $link->shortened_url]) }}
                                    </a>
                                </td>
                                <td>
                                    {{ $link->created_at->diffForHumans()}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $links->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
