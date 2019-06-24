<?php

namespace App\Entity\Base;

use App\Entity\Base\BaseEntity;
use Illuminate\Support\Facades\Config;

class LangEntity extends BaseEntity {

    public function getSelectedLangDataAttribute() {
        $selectedLang = getSelectedLang();

        $class = get_class($this);
        $formLang = $class::FORM_TYPE_LANGUAGE;

        $selectedLangData = $this;

        $mainLang = Config::get('cms.LANGUAGE');
        $languageAdd = Config::get('cms.LANGUAGE_ADD');

        if ($selectedLang != $mainLang) {
            if (in_array($selectedLang, $languageAdd)) {
                if (count($formLang)) {
                    foreach ($formLang as $form) {
                        $selectedLangData->$form = isset($selectedLangData[$form.'_'.$selectedLang]) ? $selectedLangData[$form.'_'.$selectedLang] : $selectedLangData->$form;
                    }
                }
            }
        }

        return $selectedLangData;
    }

}
