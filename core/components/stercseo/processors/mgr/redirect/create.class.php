<?php
/**
 * Create redirect
 *
 * @package stercseo
 * @subpackage processors
 */

class StercSeoCreateProcessor extends modObjectCreateProcessor
{
    public $classKey = 'seoUrl';
    public $languageTopics = array('stercseo:default');

    public function beforeSave()
    {
        $url = urlencode($this->object->get('url'));
        if ($existing = $this->modx->getObject($this->classKey, array('url' => $url))) {
            $this->addFieldError(
                'url',
                $this->modx->lexicon(
                    'stercseo.alreadyexists',
                    array('url' => $this->object->get('url'), 'id' => $existing->get('resource'), 'pagetitle' => '')
                )
            );
        }
        $this->object->set('url', $url);
        $resource = $this->modx->getObject('modResource', $this->object->get('resource'));
        if ($resource) {
            $this->object->set('context_key', $resource->get('context_key'));
        }
        return parent::beforeSave();
    }
}
return 'StercSeoCreateProcessor';
