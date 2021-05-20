<?php

class JSV_360_ADMIN_NOTIFIER extends JSV_360_ADMIN_PAGE_ABSTRACT
{
    const PATH = 'jsv-license-notifier';
    
    protected $pageTitle = 'Notifier Settings';
    protected $menuTitle = 'Notifier';
    protected $template = 'jsv-360-admin-display-notifier';

    const NOTIFIER_IMAGE_ID = 'jsv360_notifier_image_id';

    protected $fields = [
        self::NOTIFIER_IMAGE_ID
    ];

    protected $customAjaxHooks = [
        'get_notifier_image' => 'getNotifierImage'
    ];

    public function getNotifierImage()
    {
        $imageId = $_GET[$this::NOTIFIER_IMAGE_ID];
        $image   = wp_get_attachment_image_src($imageId);
        $url     = $image && count( $image        ) > 0
            ? $image[0]
            : '';
        return wp_send_json_success(
            [
                'url' => $url
            ]
        );
    }
}