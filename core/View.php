<?php namespace core;

    class View {

        public function renderView ($view, $var = null) {
            if(file_exists(ROOTDIR.'/mvc/Views/'.strtolower($view). '.php'))  {
                if(is_array($var))       extract($var);
                include_once(ROOTDIR.'/mvc/Views/'.strtolower($view). '.php');
            } else   include_once(ROOTDIR.'/mvc/Views/error.php');

        } 
    }