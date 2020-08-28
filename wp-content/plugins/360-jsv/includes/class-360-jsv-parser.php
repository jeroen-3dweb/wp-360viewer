<?php

class JSV_Parser
{
    const SHORTCODE_ID = '360-jsv';

    private $pluginName;
    private $version;

    public function __construct($pluginName, $version)
    {
        $this->pluginName = $pluginName;
        $this->version = $version;
    }

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

    private function getHtml($data)
    {
        $holderId = $this->getRandomId('holder');
        $imageId = $this->getRandomId('img');

        $src = 'https:///azipdtpxfp.cloudimg.io/v7/https://www.360-javascriptviewer.com/images/ipod/ipod.jpg';

        $code = '<div id="%s" class="jsv-holder"><img id="%s" alt="your 360 images" src="%s"> </div>';

        $code = sprintf($code, $holderId, $imageId, $src);

return $code;
        return sprintf('<h5>%s images</h5>', $data['images']);
    }

    private function getRandomId($type)
    {
        $permitted_chars = 'abcdefghijklmnopqrstuvwxyz';
        return 'jsv-' . $type . '-' . substr(str_shuffle($permitted_chars), 0, 10);
    }

    /**
     * @param $content
     * @param $codes
     * @return string
     */
    private function replaceJsvShortCodes($content, $codes)
    {
        $questions = [];
        $pattern = sprintf('/\[%s(.*?)\]/s', self::SHORTCODE_ID);
        preg_match_all($pattern, $content, $questions);

        if (isset($questions[0]) && is_array($questions[0])) {
            foreach ($questions[0] as $key => $question) {
                $content = str_replace($question, $codes[$key], $content);
            }
        }
        return $content;
    }
}