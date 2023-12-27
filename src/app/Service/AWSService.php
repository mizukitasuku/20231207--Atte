<?php

use Aws\S3\S3Client;

class FileUploadController extends Controller
{
    public function uploadFile(Request $request)
    {
        $s3Client = new S3Client([
            'version' => 'latest',
            'region'  => env('AWS_DEFAULT_REGION'),
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        // 以下にファイルアップロードのロジックを記述
    }
    public function uploadFile(Request $request)
    {
        // S3 クライアントのインスタンスを作成
        // ...

        // リクエストからファイルを取得
        $file = $request->file('Atte'); // フォームの input 名が 'file' の場合
        $filePath = $file->getPathName();
        $fileName = $file->getClientOriginalName();

        // S3 にファイルをアップロード
        $s3Client->putObject([
            'Bucket'     => env('AWS_BUCKET'),
            'Key'        => 'uploads/' . $fileName, // ファイルの保存場所と名前
            'SourceFile' => $filePath,
        ]);

        // 成功した場合のレスポンス
        return response()->json(['message' => 'File uploaded successfully']);
    }
}
