@extends('layouts.inner')

@section('css2')

@endsection


@section('content2')
<div class="form-box">
    <h2>ユーザー一覧情報</h2>
    <p>こちらのページでは、各登録ユーザーの一覧情報を確認することができます。</p>

    <!-- ユーザー一覧表示 -->
    <div class="form__text">
        <table>
            <thead>
                <tr>
                    <th>名前</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td><a href="{{ url('user-details/' . $user->id) }}">{{ $user->name }}</a></td>
                    {{-- 他のカラム --}}
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- ページネーションリンク -->
        <div class="pagination">
            {{ $users->links() }}
        </div>
    </div>
</div>

@endsection