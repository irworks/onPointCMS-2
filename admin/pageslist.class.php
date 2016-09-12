<?php
/**
 * Created by irworks on 12.09.16.
 * © Copyright irworks, 2016
 * @link https://github.com/irworks/onPointCMS-2
 */

/**
 * Module: Admin interface, get the list of all pages.
 * File: irworksWeb/pageslist.class.php
 * Depends: [NONE]
 */

namespace irworksWeb\GUI;

use irworksWeb\Controller\DB;
use irworksWeb\Controller\Template;
use Page;

require_once __DIR__ . '/adminPage.class.php';
class Pageslist extends AdminPage
{
    protected $renderedPageIDs = array();

    /**
     * Pageslist constructor.
     * This class prepares a list of pages for the admin interface.
     * @param DB $db
     */
    function __construct(DB $db) {
        parent::__construct($db, null);

        if($this->isLoggedIn()) {
            $pageHTML       = 'admin-pageslist.html';
            $pageItemHTML   = 'admin-pageslist-item.html';

            $this->tpl->loadHTML($pageHTML);

            $pagesContent = '';

            foreach ($this->pages as $page) {
                $pagesContent .= $this->renderPageItem($page, $pageItemHTML, $this->tpl);
            }

            $this->tpl->assign('pageItems', $pagesContent, $pageHTML);
            $this->siteContent .= $this->tpl->getFullHTML($pageHTML);
        }
    }

    /**
     * Renders a page item for linking in edit
     * @param Page $page
     * @param string $htmlTemplateName
     * @param Template $tpl
     * @return string
     */
    protected function renderPageItem(Page $page, $htmlTemplateName = 'admin-pageslist-item.html', Template $tpl) {
        if(in_array($page->getPageId(), $this->renderedPageIDs)) {
            return '';
        }
        $content = '';
        $tpl->loadHTML($htmlTemplateName);
        $tpl->assign('pageItemName', $page->getPageTitle(), $htmlTemplateName);

        $childContent = '';
        foreach ($page->getChildren() as $child) {
            $childContent .= $this->renderPageItem($child, $htmlTemplateName, new Template());
        }

        $tpl->assign('children', $childContent, $htmlTemplateName);

        $content .= $tpl->getFullHTML($htmlTemplateName);

        $this->renderedPageIDs[] = $page->getPageId();
        return $content;
    }
}