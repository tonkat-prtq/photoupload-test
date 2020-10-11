<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // バリデーションをしている
        $request->validate([
            'name'=>['required','string','max:255'],
            'file_path'=>['file','mimes:jpeg,png,jpg,bmb','max:2048'],
        ]);

        $path = '';

        // フォームから送られてきたパラメータに、file_pathがあれば それを変数$fileに入れて以下の処理を実行
        if($file = $request->file_path){

            // storeメソッド(サーバー上にアップロードしたファイルを保存するメソッド)でアップロード
            // publicディスクのuploadsディレクトリに保存される
            // 画像が保存されたディレクトリのパスを、変数$pathに入れている
            $path = $file->store('uploads', 'public');

            /*
            [補足]
            ディスクというのは、「ファイル保存の定義」
            ディスクにはデフォルトで３つの定義がある(local, public, s3)
            それぞれに、どのフォルダにどうやって保存するかってのが定義されている
            その定義は、config/filesystem.phpにある
            なにも指定しなければlocalが使われる
            */
            
        } 

        // dd($path, $request->file_path);

        // App\User::でUserクラスのインスタンスを生成し、create()でDBへのInsertを実行している
        // Userモデルのcreateメソッドを使ってDBにレコードを登録している
        \App\User::create([

            // $request->input('name')で、ユーザーが入力した'name'の値を取り出して、Userテーブルの'name'カラムに入れる
            'name'=>$request->input('name'),

            // 'file_path'カラムに$path(画像が保存されたディレクトリのパス)を入れる
            'file_path'=> $path,
        ]);

        // リダイレクト処理が行われる
        // web.phpに書いたルーティング情報を見に行く
        // users.indexに対応するコントローラのアクションメソッドを実行
        // その結果、上のindexアクションメソッド内にreturn view('users.index')と記述しているので、
        // views/users/index.blade.phpが表示される
        return redirect()->route('users.index');

        /*
        [補足]
        return view('users.index')は、該当するディレクトリに保存されているファイルを呼び出し、ブラウザに表示させているだけ
        なので、もし上のコードをreturn view('users.index')に書き換えた場合、
        indexアクションメソッドが実行されない?
        */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
