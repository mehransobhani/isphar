<?php

namespace App\Classes\HomePageBuilder;

class HomePageBuilder
{
    private static $format=[
        "home_header"=>[],
        "home_futures"=>[],
        "home_futures_1"=>[
            "alias"=>"home_futures_items",
        ],
        "home_futures_2"=>[
            "alias"=>"home_futures_items",
        ],
        "home_futures_3"=>[
            "alias"=>"home_futures_items",
        ],
    ];
    private static $collection=[];
    public static function build($data)
    {
        foreach ($data as $item)
        {
            $alias=self::aliasExistsInFormat($item->alias);
            if($alias==null)
                continue;
            $object=new \stdClass();
            if($item->has_title)
            {
                $object->title=$item->title;
            }
            if($item->has_subtitle)
            {
                $object->title=$item->subtitle;
            }
            if($item->has_content)
            {
                $object->content=$item->content;
            }
            if($item->has_image)
            {
                $object->image=$item->image;
            }
            if(!isset(self::$collection[$alias]))
            self::$collection[$alias]=$object;
            else
            self::$collection[$alias][]=$object;
        }
        return self::$collection;
    }

    private static function aliasExistsInFormat($alias)
    {

        foreach (self::$format as $key => $value) {
             if ($key == $alias) {
                if (is_array($value) && isset($value['alias'])  ) {
                    return $value['alias'];
                }
                return $key;
            }
        }
        return null;
    }
}
