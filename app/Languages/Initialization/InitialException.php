<?php

namespace App\Languages\Initialization;
use Exception;

/**
 *  Handle InitLanguages Service的錯誤
 */
class InitialException extends Exception
{

    /**
     * 錯誤訊息
     */
    protected $message;

    /**
     * 錯誤檔案位置
     */
    protected $file;

    /**
     * 錯誤行數
     */
    protected $line;

    function __construct($message = null, $file = null, $line = null)
    {
        if(!empty($message)) $this->message = $message;
        if(!empty($file)) $this->file = $file;
        if(!empty($line)) $this->line = $line;
    }
}
