<?php

namespace App\Entity\Base;

use Illuminate\Support\Facades\Config;

class Page extends CMS {
    const CMS_TYPE = 'Page';
    const FORM_REQUIRED = [];
    const ALLOW_DELETION = false;

    static function getPage(){
        $subtype = static::getClassName();

        return CMS::where('type', 'Page')->where('subtype', $subtype)->get()->first();
    }

    const INDEX_FIELD = [
        'name',
        'info',
        'sitemap',
    ];

    public function getValue($key, $listItem, $language){
        $tempKey = $key;

        if (!empty($language)) $tempKey .= '_'.$language;

        if (isset($this->json->$tempKey)) {
            return @$this->json->$tempKey;
        } else if (isset($listItem->$tempKey)) {
            return @$listItem->$tempKey;
        } else if (isset($this->$tempKey)) {
            return @$this->$tempKey;
        } else {
            return parent::getValue($key, $listItem, $language);
        }
    }

}
