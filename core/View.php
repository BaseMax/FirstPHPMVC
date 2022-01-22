<?php

namespace Core;

class View
{
    public static function render(string $view, array $parameters = []): void
    {
        $file = __DIR__ . "/../app/Views/$view.html";
        $code = "";
        // print "$file\n";
        if(file_exists($file) && is_file($file))
        {
            $code = file_get_contents($file);
            // print "$code\n";

            // foreach($parameters as $key=>$value)
            // {
            //     $code = str_replace("{{ $key }}", $value, $code);
            // }

            $regex = '/\{\{(\s*)(?<value>[a-zA-Z\-_][[a-zA-Z\-_0-9]+)(\s*)\}\}/i';
            $code = preg_replace_callback($regex, function($item) use ($parameters) {
                $key = $item["value"];
                if(isset($parameters[$key]))
                {
                    return $parameters[$key];
                }
                return ''; // Default value
            }, $code);
        }
        print $code;
    }
}
