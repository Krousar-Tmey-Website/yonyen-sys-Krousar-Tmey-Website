<?php

return [
    'encoding' => 'UTF-8',
    'finalize' => true,
    'ignoreNonStrings' => false,
    'cachePath' => storage_path('app/purifier'),
    'cacheFileMode' => 0755,

    'settings' => [
        'default' => [
            'HTML.Doctype' => 'HTML 4.01 Transitional',
            'HTML.Allowed' => 'p[class|style],br,strong,b,em,i,u,span[class|style],a[href|title|target|rel|class|style],ul[class|style],ol[class|style],li[class|style],blockquote[class|style],h1[class|style],h2[class|style],h3[class|style],h4[class|style],h5[class|style],h6[class|style],figure[class|style],figcaption[class|style],img[src|alt|width|height|class|style],table[class|style],thead[class|style],tbody[class|style],tfoot[class|style],tr[class|style],th[colspan|rowspan|class|style],td[colspan|rowspan|class|style],caption[class|style],hr[class|style]',
            'CSS.AllowedProperties' => 'font,font-size,font-weight,font-style,font-family,text-decoration,text-align,color,background-color,margin,margin-left,margin-right,margin-top,margin-bottom,padding,padding-left,padding-right,padding-top,padding-bottom,border,border-left,border-right,border-top,border-bottom,width,height,max-width,min-width',
            'Attr.AllowedFrameTargets' => ['_blank', '_self', '_parent', '_top'],
            'AutoFormat.AutoParagraph' => false,
            'AutoFormat.RemoveEmpty' => false,
        ],
        'rich_text' => [
            'HTML.Doctype' => 'HTML 4.01 Transitional',
            'HTML.Allowed' => 'p[class|style],br,strong,b,em,i,u,span[class|style],a[href|title|target|rel|class|style],ul[class|style],ol[class|style],li[class|style],blockquote[class|style],h1[class|style],h2[class|style],h3[class|style],h4[class|style],h5[class|style],h6[class|style],figure[class|style],figcaption[class|style],img[src|alt|width|height|class|style],table[class|style],thead[class|style],tbody[class|style],tfoot[class|style],tr[class|style],th[colspan|rowspan|class|style],td[colspan|rowspan|class|style],caption[class|style],hr[class|style]',
            'CSS.AllowedProperties' => 'font,font-size,font-weight,font-style,font-family,text-decoration,text-align,color,background-color,margin,margin-left,margin-right,margin-top,margin-bottom,padding,padding-left,padding-right,padding-top,padding-bottom,border,border-left,border-right,border-top,border-bottom,width,height,max-width,min-width',
            'Attr.AllowedFrameTargets' => ['_blank', '_self', '_parent', '_top'],
            'URI.AllowedSchemes' => [
                'http' => true,
                'https' => true,
                'mailto' => true,
                'tel' => true,
                'data' => false,
            ],
            'AutoFormat.AutoParagraph' => false,
            'AutoFormat.RemoveEmpty' => false,
        ],
        'custom_definition' => [
            'id' => 'html5-definitions',
            'rev' => 1,
            'debug' => false,
            'elements' => [
                ['figure', 'Block', 'Optional: (figcaption, Flow) | (Flow, figcaption) | Flow', 'Common'],
                ['figcaption', 'Inline', 'Flow', 'Common'],
            ],
        ],
        'custom_attributes' => [
            ['a', 'rel', 'Text'],
            ['figure', 'class', 'Text'],
            ['figcaption', 'class', 'Text'],
            ['table', 'class', 'Text'],
            ['th', 'colspan', 'Number'],
            ['th', 'rowspan', 'Number'],
            ['td', 'colspan', 'Number'],
            ['td', 'rowspan', 'Number'],
        ],
    ],
];
