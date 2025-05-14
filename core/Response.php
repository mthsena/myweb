<?php

namespace app;

require_once __DIR__ . '/Checker.php';

class Response
{
    public static function getBuffer($target, $params)
    {
        ob_start();
        extract($params, EXTR_OVERWRITE);
        require_once $target;
        return ob_get_clean();
    }

    public static function getHeaders($headers)
    {
        $target = $headers;
        array_walk($target, function (&$value, $key) {
            $value = $key  . ': ' . $value;
        });
        return trim(implode('; ', $target));
    }

    public static function minifyHtml($html)
    {
        $minify = new \voku\helper\HtmlMin();
        $minify->doOptimizeViaHtmlDomParser();
        $minify->doRemoveComments();
        $minify->doSumUpWhitespace();
        $minify->doRemoveWhitespaceAroundTags();
        $minify->doOptimizeAttributes();
        $minify->doRemoveHttpPrefixFromAttributes();
        $minify->doRemoveDefaultAttributes();
        $minify->doRemoveDeprecatedAnchorName();
        $minify->doRemoveDeprecatedScriptCharsetAttribute();
        $minify->doRemoveDeprecatedTypeFromScriptTag();
        $minify->doRemoveDeprecatedTypeFromStylesheetLink();
        $minify->doRemoveEmptyAttributes();
        $minify->doRemoveValueFromEmptyInput();
        $minify->doSortCssClassNames();
        $minify->doSortHtmlAttributes();
        $minify->doRemoveSpacesBetweenTags();
        $minify->doRemoveOmittedQuotes();
        $minify->doRemoveOmittedHtmlTags();
        return $minify->minify($html);
    }

    public static function data($headers, $code, $data)
    {
        http_response_code($code);
        header(self::getHeaders($headers), true, $code);
        echo $data;
    }

    public static function view($headers, $code, $view, $params)
    {
        $viewFile = Path::dir('/app/view' . $view . '.php');
        $viewOutput = self::getBuffer($viewFile, $params);
        $templateFile = Path::dir('/app/component/TemplateComponent.php');
        $templateOutput = self::getBuffer($templateFile, array_merge($params, ['view' => $viewOutput]));
        $output = Config::$isDebug ? $templateOutput : self::minifyHtml($templateOutput);
        self::data($headers, $code, $output);
    }
}
