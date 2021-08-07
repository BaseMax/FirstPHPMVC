<?php

namespace Core;

class View
{
    public static function render(string $view, array $parameters = []): string
    {
        $file = "Views/$view.html";
        $code = "";
        if(file_exists($file) && is_file($file))
        {
            $code = file_get_contents($file);

            // foreach($parameters as $key=>$value)
            // {
            //     $code = str_replace("{{ $key }}", $value, $code);
            // }

            $regex = '/\{\{(\s*)(?<value>[a-zA-Z\-_][[a-zA-Z\-_0-9]+)(\s*)\}\}/i';
            preg_replace_callback($regex, $code, function($item) {
                $key = $item["value"];
                if(isset($parameters[$key]))
                {
                    return $parameters[$key];
                }
                return ''; // Default value
            });
        }
        return $code;
    }
}
