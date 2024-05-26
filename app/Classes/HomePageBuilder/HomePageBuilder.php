<?php

namespace App\Classes\HomePageBuilder;

class HomePageBuilder
{
    private static $ARRAY = "array";
    private static $OBJECT = "object";
    private static $STD = "std";

    public static function build($data)
    {
        $collection = new \stdClass();

        foreach ($data as $item) {
            [$alias, $type, $text] = self::aliasExistsInFormat($item->alias);
             if (!$alias || !$type)
                continue;
            $object = new \stdClass();
            if ($item->has_title) {
                $object->title = $item->title;
            }
            if ($item->has_subtitle) {
                $object->subtitle = $item->subtitle;
            }
            if ($item->has_content) {
                $object->content = $item->content;
            }
            if ($item->has_image) {
                $object->image = $item->image;
            }
            if ($type == self::$STD) {
                if (!isset($collection->$alias))
                    $collection->$alias = new \stdClass();
                $collection->$alias->$text = $item->title;
            }
            if ($type == self::$OBJECT)
                $collection->$alias = $object;
            if ($type == self::$ARRAY)
                $collection->$alias[] = $object;
        }
        return $collection;
    }

    private static function aliasExistsInFormat($alias)
    {
        foreach (config("homePageResponse") as $key => $value) {
            if ($key == $alias) {
                if (isset($value['alias'])) {
                    return [$value['alias'], $value['type'], $value['text'] ?? null];
                }
                return [$key, $value['type'], $value['text'] ?? null];
            }
        }
        return [null, null, null];
    }
}
