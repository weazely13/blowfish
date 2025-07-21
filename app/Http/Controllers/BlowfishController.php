<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\BlowfishHelper;
use Illuminate\Support\Facades\Response;

class BlowfishController extends Controller
{
    public function index(Request $request)
    {
        return view('blowfish', [
            'input' => $request->old('input', ''),
            'result' => session('result', ''),
            'inputFileResult' => session('inputFileResult', '')
        ]);
    }

    public function encryptText(Request $request)
    {
        $text = $request->input('input');

        if (empty($text)) {
            return redirect('/')
                ->with('encrypt_input', $text)
                ->with('encrypted_result', '⚠️ Cannot encrypt empty input.');
        }

        $encrypted = BlowfishHelper::encryptText($text);

        return redirect('/')
            ->with('encrypt_input', $text)
            ->with('encrypted_result', $encrypted);
    }


    public function decryptText(Request $request)
    {
        $text = $request->input('input');

        if (empty($text)) {
            return redirect('/')
                ->with('decrypt_input', $text)
                ->with('decrypted_result', '⚠️ Please provide text to decrypt.');
        }

        $decrypted = BlowfishHelper::decryptText($text);

        return redirect('/')
            ->with('decrypt_input', $text)
            ->with('decrypted_result', $decrypted);
    }




    public function encryptFile(Request $request)
    {
        $file = $request->file('input_file');
        $originalName = $file->getClientOriginalName();
        $content = file_get_contents($file->getRealPath());

        $encrypted = BlowfishHelper::encryptFile($content);

        return response($encrypted)
            ->header('Content-Type', 'application/octet-stream')
            ->header('Content-Disposition', 'attachment; filename="' . $originalName . '.enc"')
            ->header('Content-Length', strlen($encrypted));
    }


    public function decryptFile(Request $request)
    {
        $file = $request->file('input_file');
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $content = file_get_contents($file->getRealPath());

        $decrypted = BlowfishHelper::decryptFile($content);

        return response($decrypted)
            ->header('Content-Type', 'application/octet-stream')
            ->header('Content-Disposition', 'attachment; filename="' . $originalName . '"')
            ->header('Content-Length', strlen($decrypted));
    }

}
