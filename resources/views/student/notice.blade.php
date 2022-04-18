@extends('layouts.student')
@section('content')
    <div class="container-fluid py-4">
        <div class="col-lg-4 col-md-6">
            <div class="card ">
                <div class="card-header pb-0">
                    <h6>{{ $post->title }}</h6>
                </div>
                <div class="card-body p-3">
                    <tbody>
                        <tr>
                            <td>
                                {{ $post->content }}
                            </td>
                        </tr>
                    </tbody>
                </div>
            </div>
        </div>
    </div>
@endsection
