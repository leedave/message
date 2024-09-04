<?php

namespace Leedch\Message;

/**
 * Store and output Feedback messages (errors, success, notice etc)
 * @author leed
 */
class Message
{
    public static function outputMessages(): string
    {
        $response = "";
        if (!isset($_SESSION['messages'])) {
            return "";
        }

        if (isset($_SESSION['messages']['error'])) {
            $response .= static::outputErrorMessage(implode("<br>\n", $_SESSION['messages']['error']));
        }
        if (isset($_SESSION['messages']['success'])) {
            $response .= static::outputSuccessMessage(implode("<br>\n", $_SESSION['messages']['success']));
        }
        if (isset($_SESSION['messages']['info'])) {
            $response .= static::outputInfoMessage(implode("<br>\n", $_SESSION['messages']['info']));
        }

        unset($_SESSION['messages']);
        return "<div id=\"messages\">".$response."</div>\n";
    }

    protected static function outputErrorMessage(string $message): string
    {
        return "<div class=\"messageError\">".$message."</div>\n";
    }

    protected static function outputSuccessMessage(string $message): string
    {
        return "<div class=\"messageSuccess\">".$message."</div>\n";
    }

    protected static function outputInfoMessage(string $message): string
    {
        return "<div class=\"messageInfo\">".$message."</div>\n";
    }


    public static function addErrorMessage(string $message)
    {
        static::addMessage('error', $message);
    }

    public static function addSuccessMessage(string $message)
    {
        static::addMessage('success', $message);
    }

    public static function addInfoMessage(string $message)
    {
        static::addMessage('info', $message);
    }

    protected static function addMessage(string $type, string $message)
    {
        static::initMessages();
        if (!isset($_SESSION['messages'][$type])) {
            $_SESSION['messages'][$type] = [];
        }
        $_SESSION['messages'][$type][] = $message;
    }

    protected static function initMessages()
    {
        if (!isset($_SESSION['messages'])) {
            $_SESSION['messages'] = [];
        }
    }
}
