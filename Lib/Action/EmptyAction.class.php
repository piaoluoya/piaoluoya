<?php
class EmptyAction extends Action {
    public function index() {
        header ( "Location: /404.html" );
    }
    
    public function _empty() {
        header ( "Location: /404.html" );
    }
}