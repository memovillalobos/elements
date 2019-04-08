<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ElementsController extends Controller
{
    protected $actions = [
        'create',
        'create',
        'create',
        'style',
        'remove'
    ];

    protected $tags = [
        'div',
        'button',
        'a',
        'img',
    ];

    protected $styles = [
        'padding' => [
            '20px',
            '10px 0px',
            '5px 10px',
        ],
        'margin' => [
            '0px auto',
            '10px',
            '10px 0px',
            '20px 40px',
        ],
        'border' => [
            'solid 5px red',
            'dotted 5px blue',
            'dashed 10px orange',
            'double 3px green'
        ],
        'opacity' => [
            '0.5',
            '1',
            '0.75'
        ],
        'background-color' => [
            'red',
            'yellow',
            'green',
            'white',
            'black'
        ],
        'color' => [
            'gray',
            'orange',
            'lime',
            'teal',
            'cyan'
        ],
        'font-family' => [
            'sans-serif',
            'serif'
        ],
        'font-size' => [
            '10px',
            '16px',
            '24px',
            '32px'
        ]
    ];

    protected $anchors = [
        'https://www.google.com',
        'https://www.microsoft.com',
        'https://www.apple.com',
    ];

    protected $images = [
        'https://upload.wikimedia.org/wikipedia/sco/thumb/b/bf/KFC_logo.svg/1024px-KFC_logo.svg.png',
        'https://missionmarketplaceoceanside.com/wp-content/uploads/2018/06/mcdonalds-logo.jpg',
        'https://cdn.foodlogistics.com/files/base/acbm/fl/image/2015/08/960w/wendys_co_logo.55d5ec69667bb.jpg',
        'http://www.vector-logo.net/logo_preview/eps/w/WHATABURGER_1.png',
    ];

    protected $content = [
        'Lorem ipsum dolor sit amet.',
        'Consectetur adipisicing elit.',
        'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
    ];

    protected $heights = [
        '50',
        '100',
        '150'
    ];

    public function index(Request $request)
    {
        $action = $this->actions[array_rand($this->actions)];
        $tag = $this->tags[array_rand($this->tags)];

        if ($request->filled('action') && in_array($request->action, $this->actions)) {
            $action = $request->action;
        }

        if ($request->filled('tag') && in_array($request->tag, $this->tags)) {
            $tag = $request->tag;
        }

        $response = [
            'action' => $action,
            'tag' => $tag
        ];

        if ($action == 'create') {
            $content = $this->content[array_rand($this->content)];
            if ($tag != 'img') {
                $response['content'] = $content;
            }
        }

        if ($action == 'create' || $action == 'style') {
            $properties = array_rand($this->styles, 5);
            foreach($properties as $property){
                $styles[$property] = $this->styles[$property][array_rand($this->styles[$property])];
            }
            $response['styles'] = $styles;
        }

        if ($action == 'create' && $tag == 'a') {
            $response['properties']['href'] = $this->anchors[array_rand($this->anchors)];
        }

        if ($action == 'create' && $tag == 'img') {
            $response['properties']['src'] = $this->images[array_rand($this->images)];
            $response['properties']['height'] = $this->heights[array_rand($this->heights)];
        }

        return response()->json($response);
    }

}
