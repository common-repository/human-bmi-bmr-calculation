<?php
    /**
     * Requite class-wp-list-table.php file here
     */
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
    /**
     * Extends class wp list table by our class
     */
    class _bmi_bmr_result_list extends WP_List_Table {
        public function prepare_items() {
            $total_data   = $this->wp_list_table_data();
            $per_page     = 10;
            $current_page = $this->get_pagenum();
            $total_item   = count( $total_data );
            $this->set_pagination_args( [
                'total_items' => $total_item,
                'per_page'    => $per_page,
            ] );
            $this->items = array_slice( $total_data, (  ( $current_page - 1 ) * $per_page ), $per_page );
            $this->wp_list_table_data();
            $columns = $this->get_columns();
            // $hidden                = $this->get_hidden_columns();
            // $sortable              = $this->get_sortable_columns();
            // $this->_column_headers = [$columns, $hidden, $sortable];
            $this->_column_headers = [$columns];
        }

        public function wp_list_table_data() {
            global $wpdb;
            $table_name            = $wpdb->prefix . 'bmi_bmr_result';
            $selectFromBmiBmrTable = "SELECT * FROM $table_name WHERE patient_date='$_GET[date]'";
            $result                = $wpdb->get_results( $selectFromBmiBmrTable );
            $post_array            = [];
            if ( count( $result ) > 0 ) {
                foreach ( $result as $index => $value ) {
                    $post_array[] = [
                        // 'id'                => $value->id,
                        'patient_name'      => $value->patient_name,
                        'patient_gender'    => $value->patient_gender,
                        'patient_age'       => $value->patient_age,
                        'patient_height'    => $value->patient_height,
                        'patient_weight'    => $value->patient_weight,
                        'patient_bmi'       => $value->patient_bmi,
                        'patient_bmr'       => $value->patient_bmr,
                        'patient_condition' => $value->patient_condition,
                        'patient_date'      => $value->patient_date,
                    ];
                }
            }
            return $post_array;
        }

        public function get_columns() {
            $columns = [
                // 'cb'                => '<input type="checkbox"/>',
                'patient_name'      => 'Name',
                'patient_gender'    => 'Gender',
                'patient_age'       => 'Age',
                'patient_height'    => 'Height',
                'patient_weight'    => 'Weight',
                'patient_bmi'       => 'Bmi',
                'patient_bmr'       => 'Bmr',
                'patient_condition' => 'Bmi Condition',
                'patient_date'      => 'Patient Date',
            ];
            return $columns;
        }

        // public function column_cb( $item ) {
        //     return sprintf( '<input type="checkbox" name="post[]" value="%s"/>', $item['id'] );
        // }
        // public function column_title() {}
        // public function get_hidden_columns() {
        // }
        // public function get_sortable_columns() {
        // }
        // public function get_bulk_actions() {}
        // public function extra_tablenav() {}
        public function column_default( $item, $column_name ) {
            switch ( $column_name ) {
            // case 'cb':
            case 'patient_name':
            case 'patient_gender':
            case 'patient_age':
            case 'patient_height':
            case 'patient_weight':
            case 'patient_bmi':
            case 'patient_bmr':
            case 'patient_condition':
            case 'patient_date':
                return $item[$column_name];
            default:
                return 'No Data Found';
            }
        }
    }
    function _bmi_bmr_result_list_function() {
        //initialization
        $_class = new _bmi_bmr_result_list();
        $_class->prepare_items();
    ?>
    <div class="wrap">
        <?php $_class->display();?>
    </div>
<?php
    }

_bmi_bmr_result_list_function();
