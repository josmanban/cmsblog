<?php

namespace Librerias;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Paginator
 *
 * @author jose
 */
class Paginator {

    //put your code here    
    private $controller;
    private $action;
    private $page;
    private $numItemsXPage;
    private $numItems;
    private $filters;

    function __construct($controller, $action, $page, $numItemsXPage, $numItems, $filters) {
        $this->controller = $controller;
        $this->action = $action;
        if (intval($page) < 1)
            $this->page = 1;
        else
            $this->page = intval($page);
        $this->numItemsXPage = $numItemsXPage;
        $this->numItems = $numItems;
    }

    public function getFilters() {
        return $this->filters;
    }

    public function setFilters($filters) {
        $this->filters = $filters;
    }

    public function getController() {
        return $this->controller;
    }

    public function setController($controller) {
        $this->controller = $controller;
    }

    public function getAction() {
        return $this->action;
    }

    public function setAction($action) {
        $this->action = $action;
    }

    public function getPage() {
        return $this->page;
    }

    public function setPage($page) {
        $this->page = $page;
    }

    public function getNumItemsXPage() {
        return $this->numItemsXPage;
    }

    public function setNumItemsXPage($numItemsXPage) {
        $this->numItemsXPage = $numItemsXPage;
    }

    public function getNumItems() {
        return $this->numItems;
    }

    public function setNumItems($numItems) {
        $this->numItems = $numItems;
    }

    public function getNumPages() {
        return ceil($this->numItems / $this->numItemsXPage);
    }

    public function getLimit() {
        return $this->numItemsXPage;
    }

    public function getOffset() {

        return ($this->page - 1) * $this->numItemsXPage;
    }

    public function getNextPage() {
        if ($this->page == $this->getNumPages())
            return -1;
        return $this->page + 1;
    }

    public function getPreviousPage() {
        if ($this->page == 1)
            return -1;
        return $this->page - 1;
    }

    public function getLastPage() {
        return $this->getNumPages();
    }

    public function getFirstPage() {
        return 1;
    }

    public function render() {
        $paginator = $this;
        require_once dirname(__FILE__) . '/../Templates/paginator.html.php';
    }

}

?>
