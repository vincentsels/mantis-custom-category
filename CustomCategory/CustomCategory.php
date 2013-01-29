<?php

class CustomCategoryPlugin extends MantisPlugin {

    function register() {
        $this->name        = 'Custom Categorization';
        $this->description = 'Allows bugs to be further categorized.';
        $this->page        = '';

        $this->version  = '0.1.0';
        $this->requires = array(
            'MantisCore' => '1.2.0'
        );

        $this->author  = 'Vincent Sels';
        $this->contact = 'vincent@selsitsolutions.com';
        $this->url     = '';
    }

    function hooks() {
        return array(
            'EVENT_FILTER_COLUMNS'		=> 'filter_columns'
        );
    }

    function filter_columns() {
        require_once('classes/CustomCategoryBudgetClassColumn.class.php');
        return array(
            'CustomCategoryBudgetClassColumn'
        );
    }
}
