<?php

class JSV_360_Parser
{
    const SHORTCODE_ID = '360-jsv';

    const DEFAULT_URL = 'https:///azipdtpxfp.cloudimg.io/v7/https://www.360-javascriptviewer.com/images/ipod/ipod.jpg';

    /**
     * @var string $pluginName
     */
    private $pluginName;

    /**
     * @var string $version
     */
    private $version;

    /**
     * JSV_Parser constructor.
     * @param $pluginName
     * @param $version
     */
    public function __construct($pluginName, $version)
    {
        $this->pluginName = $pluginName;
        $this->version = $version;
    }

    /**
     * @param $content
     * @return string
     */
    public function parse($content)
    {
        $codes = [];
        foreach ($this->getShortCodes($content) as $shortCode) {
            $data = shortcode_parse_atts($shortCode);
            $codes[] = $this->getHtml($data);
        };

        return $this->replaceJsvShortCodes($content, $codes);
    }

    /**
     * @param $content
     * @return array|mixed
     */
    private function getShortCodes($content)
    {
        $questions = [];
        $pattern = sprintf('/\[%s(.*?)\]/', self::SHORTCODE_ID);
        if (preg_match_all($pattern, $content, $questions)) {
            $questions = array_key_exists(1, $questions) ? $questions[1] : array();
        }
        return $questions;
    }

    /**
     * @param $data
     *
     * @return string
     */
    private function getHtml($data)
    {
        $holderId = $this->getRandomId('holder');
        $imageId = $this->getRandomId('img');

        $dataAttributes = $this->getDataAttributes($data, $holderId, $imageId);
        $src = $this->getImageUrl($data);
        $mw = $this->getAttribute($data, 'max-width');
        $float = $this->getAttribute($data, 'float');
        $marginLeft = $this->getAttribute($data, 'margin-left');
        $marginRight = $this->getAttribute($data, 'margin-right');
        $marginTop = $this->getAttribute($data, 'margin-top');
        $marginBottom = $this->getAttribute($data, 'margin-bottom');
        $style = '';
        if($mw || $float || $marginLeft) {
            $style = 'style="';
            $style .= $mw ? sprintf('max-width:%spx; ', $mw) : '';
            $style .= $float ? sprintf('float:%s; ', $float) : '';
            $style .= $marginLeft ? sprintf('margin-left:%spx; ', $marginLeft) : '';
            $style .= $marginRight ? sprintf('margin-right:%spx; ', $marginRight) : '';
            $style .= $marginTop ? sprintf('margin-top:%spx; ', $marginTop) : '';
            $style .= $marginBottom ? sprintf('margin-bottom:%spx; ', $marginBottom) : '';
            $style .= '"';
        }

        $code = '<div %s id="%s" class="jsv-holder" %s><img id="%s" alt="your 360 images" src="%s"></div>';

        return sprintf($code, $dataAttributes, $holderId, $style, $imageId, $src);
    }

    /**
     * @param $dataAttributes
     *
     * @return mixed|string
     */
    private function getImageUrl($dataAttributes)
    {
        if (isset($dataAttributes['main-image-url'])) {
            return $dataAttributes['main-image-url'];
        }
        return self::DEFAULT_URL;
    }

    /**
     * @param $dataAttributes
     *
     * @return null|string
     */
    private function getMaxWidth($dataAttributes)
    {
        if (isset($dataAttributes['max-width'])) {
            return $dataAttributes['max-width'];
        }
        return null;
    }

    /**
     * @param $dataAttributes
     *
     * @return null|string
     */
    private function getAttribute($dataAttributes, $name)
    {
        if (isset($dataAttributes[$name])) {
            return $dataAttributes[$name];
        }
        return null;
    }


    /**
     * @param $type
     * @return string
     */
    private function getRandomId($type)
    {
        $permitted_chars = implode('', range('a', 'z'));
        return 'jsv-' . $type . '-' . substr(str_shuffle($permitted_chars), 0, 10);
    }

    /**
     * @param $content
     * @param $codes
     * @return string
     */
    private function replaceJsvShortCodes($content, $codes)
    {
        $bbCodes = [];
        $pattern = sprintf('/\[%s(.*?)\]/s', self::SHORTCODE_ID);
        preg_match_all($pattern, $content, $bbCodes);

        if (isset($bbCodes[0]) && is_array($bbCodes[0])) {
            foreach ($bbCodes[0] as $key => $bbCode) {
                $pos = strpos($content, $bbCode);
                if ($pos !== false) {
                    $content = substr_replace($content, $codes[$key], $pos, strlen($bbCode));
                }
            }
        }
        return $content;
    }

    /**
     * @param $data
     * @param $holderId
     * @param $imageId
     * @return string
     */
    private function getDataAttributes($data, $holderId, $imageId)
    {
        $arr = [];
        foreach ($data as $key => $value) {
            $saveKey = strtolower($key);
            $value = is_numeric($value) ? (int)$value : $value;
            $value = str_replace(['”', "'", '&#8221;'], "", $value);
            $arr[] = sprintf('data-%s="%s"', $saveKey, $value);
        }

        $arr[] = sprintf('data-main-holder-id="%s"', $holderId);
        $arr[] = sprintf('data-main-image-id="%s"', $imageId);
        return implode(' ', $arr);
    }
}