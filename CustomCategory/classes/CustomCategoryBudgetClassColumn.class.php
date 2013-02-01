<?php

class CustomCategoryBudgetClassColumn extends MantisColumn {

    public $column = "budget_class_column";
    public $sortable = false;

    public function __construct() {
        $this->title = plugin_lang_get( 'budget_class', 'CustomCategory' );
    }

    public function display( $p_bug, $p_columns_target ) {
        if ( $p_bug->severity == 60 ) { # Legal
            echo 'Wettelijke aanpassingen';
        } else if ( $p_bug->project_id == 295 ||
            $p_bug->project_id == 285 ||
            $p_bug->project_id == 283 ) {
            echo 'Werking Certia';
        }
        else if ( $p_bug->project_id == 307 || # Other apps
            project_hierarchy_get_parent( $p_bug->project_id ) == 307 ) {
            echo 'Werking Certia';
        }
        else if ( $p_bug->project_id == 248 || # Service Desk
            $p_bug->project_id == 294 ) { # CB
            ## Non-roadmap project
            if ( $p_bug->category_id == 446 || # Change
                $p_bug->category_id == 446) { # Project, shoudldnt happen
                echo 'Evolutief onderhoud';
            } else if ( $p_bug->category_id == 445 ) { # Requesten
                echo 'Requesten';
            } else {
                echo 'Correctief onderhoud';
            }
        } else { # Roadmap project
            $t_bug_customer_table = plugin_table( 'bug_customer', 'ProjectManagement' );
            $t_bug_id = $p_bug->id;
            $t_query  = "SELECT customers
                           FROM $t_bug_customer_table
                          WHERE bug_id = $t_bug_id
                            AND type = 0";
            $t_result = db_query_bound( $t_query );

            while ( $t_row = db_fetch_array( $t_result ) ) {
                $t_customers = explode( PLUGIN_PM_CUST_CONCATENATION_CHAR, $t_row['customers'] );
            }
            if ( array_search( (string)PLUGIN_PM_ALL_CUSTOMERS, $t_customers, true ) ) {
                echo 'Roadmap projecten';
            } else {
                echo 'Maatwerk project';
            }
        }
    }

}