<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Mail;

class AppController extends Controller
{


    /***
     * @Author:: Bikash Chhualsingh
     * @Date:: 22-June-2023
     *
     * @param $fileName :: name of file to encrypt the name
     * @return string|string[]
     */
    function _generateUniqueFilename($fileName, $fileLocation = NULL)
    {

        $ext = trim(substr(strrchr($fileName, '.'), 1));
        $new_name = trim(substr(md5(microtime()), 2, -5));
        $fileName = $new_name . '.' . $ext;
        $no = 1;
        $newFileName = $fileName;
        if ($fileLocation) {
            while (file_exists($fileLocation . $newFileName)) {
                $no++;
                $newFileName = substr_replace($fileName, "_$no.", strrpos($fileName, "."), 1);
            }
        }

        return $newFileName;
    }


    protected function _sendEmail($emailBody, $emailData = [], $useTemplate = 0)
    {
        if ($useTemplate) {
            Mail::send($emailBody['path'], $emailBody['variables'], function ($messages) use ($emailData) {
                $messages->to($emailData['to']);
                $messages->subject($emailData['subject']);
            });
        } else {
            Mail::html($emailBody, function ($messages) use ($emailData) {
                $messages->to($emailData['to']);
                $messages->subject($emailData['subject']);
            });
        }
    }


    function _getPrefix($userType)
    {
        switch ($userType) {
            case '0':
                $prefix = 'user';
                $prefix2 = 'user';
                break;
            case '3':
                $prefix = 'escorts';
                $prefix2 = 'escort';
                break;
            case '4':
                $prefix = 'center';
                $prefix2 = 'center';
                break;
            case '5':
                $prefix = 'agent';
                $prefix2 = 'agent';
                break;
            case '6':
                $prefix = 'staff';
                $prefix2 = 'staff';
                break;
            default:
                $prefix = '';
                $prefix2 = '';
                break;
        }

        return [$prefix, $prefix2];
    }
}
