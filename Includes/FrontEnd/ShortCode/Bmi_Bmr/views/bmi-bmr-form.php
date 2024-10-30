<?php
    global $wpdb;
    $table_name = $wpdb->prefix . 'bmi_bmr_result';
    function Bmi_Bmr_Calculation( $p_Gender, $p_Age, $p_Height, $p_Height_Unit, $p_Weight, $p_Weight_Unit ) {
        /**
         * BMI-BMR Calculation All Variable
         */
        //BMI
        $BMI_formula = 703;
        //BMR MALE
        $BMR_Male_formula_01 = 66.47;
        $BMR_Male_formula_02 = 6.23;
        $BMR_Male_formula_03 = 12.7;
        $BMR_Male_formula_04 = 6.8;
        //BMR FEMALE
        $BMR_Female_formula_01 = 655.1;
        $BMR_Female_formula_02 = 4.35;
        $BMR_Female_formula_03 = 4.7;
        $BMR_Female_formula_04 = 4.7;
        /**
         * Get Patient Height
         * All Height In Inch
         */
        if ( 'm' == $p_Height_Unit ) {
            $height = $p_Height * 39.3701;
        } elseif ( 'cm' == $p_Height_Unit ) {
            $height = $p_Height * 0.393701;
        } else {
            $height = $p_Height;
        }
        /**
         * Get Patient Weight
         * All Weight In Pound(ibs)
         */
        if ( 'kg' == $p_Weight_Unit ) {
            $weight = $p_Weight * 2.20462;
        } else {
            $weight = $p_Weight;
        }
        /**
         * Get Patient BMI Result
         */
        $BMI = ( $weight / ( $height * $height ) ) * $BMI_formula;
        /**
         * Get Patient BMR Result
         */
        if ( 'MALE' == $p_Gender ) {
            /**
             * Patient MALE
             */
            $BMR = $BMR_Male_formula_01 + ( $BMR_Male_formula_02 * $weight ) + ( $BMR_Male_formula_03 * $height ) - ( $BMR_Male_formula_04 * $p_Age );
        } else {
            /**
             * Patient FEMALE
             */
            $BMR = $BMR_Female_formula_01 + ( $BMR_Female_formula_02 * $weight ) + ( $BMR_Female_formula_03 * $height ) - ( $BMR_Female_formula_04 * $p_Age );
        }
        /**
         * BMI Result With Only One Decimal
         */
        $BMI = round( $BMI, 1 );
        /**
         * BMR Result With NO Decimal
         */
        $BMR = round( $BMR, 0 );
        /**
         * Return BMI BMR Result
         * Return An Array
         */
        return ['bmi' => $BMI, 'bmr' => $BMR];
    }

?>
<div id="_bmi_bmr_form">
    <form action="" method="post">
        <div id="_table">
            <table>
                <tr>
                    <td colspan="4">
                        <!-- <input type="text" required=""> -->
                        <code class="_bmi_bmr_date">
                            <?php echo date( 'Y-m-d' ); ?>
                            (<?php echo date( 'l' ); ?>)
                        </code>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <label>Patient Name :</label>
                        <?php
                            function get_patient_name() {
                                $user_first_name = get_the_author_meta( 'first_name', get_current_user_id() );
                                $user_last_name  = get_the_author_meta( 'last_name', get_current_user_id() );
                                $user_nickname   = get_the_author_meta( 'nickname', get_current_user_id() );
                                if ( ! empty( $user_first_name ) && ! empty( $user_last_name ) ) {
                                    $name = $user_first_name . ' ' . $user_last_name;
                                } elseif ( ! empty( $user_first_name ) && empty( $user_last_name ) ) {
                                    $name = $user_first_name;
                                } elseif ( empty( $user_first_name ) && ! empty( $user_last_name ) ) {
                                    $name = $user_last_name;
                                } else {
                                    $name = $user_nickname;
                                }
                                return $name;
                            }

                        ?>
                        <input name="_bmi_bmr_patient_name" type="text" required="" value="<?php echo get_patient_name(); ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <label>Gender</label>
                        <select name="_bmi_bmr_patient_gender">
                            <option name="_bmi_bmr_patient_gender" value="MALE" selected="">Male</option>
                            <option name="_bmi_bmr_patient_gender" value="FEMALE">Female</option>
                        </select>
                    </td>
                    <td colspan="2">
                        <label>Age :</label>
                        <input name="_bmi_bmr_patient_age" type="number" required="">
                    </td>
                </tr>
                <tr>
                    <td class='dimentions'>
                        <label>Height</label>
                        <input name="_bmi_bmr_patient_height" type="number" required="">
                    </td>
                    <td class='dimentions'>
                        <label>Units</label>
                        <select name="_bmi_bmr_patient_height_unit">
                            <option name="_bmi_bmr_patient_height_unit" selected="" value="in">in</option>
                            <option name="_bmi_bmr_patient_height_unit" value="m">m</option>
                            <option name="_bmi_bmr_patient_height_unit" value="cm">cm</option>
                        </select>
                    </td>
                    <td class='dimentions'>
                        <label>Weight</label>
                        <input name="_bmi_bmr_patient_weight" type="number" required="">
                    </td>
                    <td class='dimentions'>
                        <label>Units</label>
                        <select name="_bmi_bmr_patient_weight_unit">
                            <option name="_bmi_bmr_patient_weight_unit" selected="" name="kg">kg</option>
                            <option name="_bmi_bmr_patient_weight_unit" value="ibs">ibs</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <!-- <input type="submit" value="Calculate"> -->
                        <button type="submit" name="_bmi_bmr_submit">Calculate</button>
                    </td>
                    <td colspan="2">
                        <button type="reset" value="Reset">Reset</button>
                    </td>
                </tr>
            </table>
        </div>
    </form>
    <?php
        if ( isset( $_POST['_bmi_bmr_submit'] ) ) {
            $_patient_name        = $_POST['_bmi_bmr_patient_name'];
            $_patient_gender      = $_POST['_bmi_bmr_patient_gender'];
            $_patient_age         = $_POST['_bmi_bmr_patient_age'];
            $_patient_height      = $_POST['_bmi_bmr_patient_height'];
            $_patient_height_unit = $_POST['_bmi_bmr_patient_height_unit'];
            $_patient_weight      = $_POST['_bmi_bmr_patient_weight'];
            $_patient_weight_unit = $_POST['_bmi_bmr_patient_weight_unit'];
            /**
             * BMI BMR Full Calculation Function
             * Array
             */
            $Bmi_Bmr_Results = Bmi_Bmr_Calculation( $_patient_gender, $_patient_age, $_patient_height, $_patient_height_unit, $_patient_weight, $_patient_weight_unit );
        ?>
        <br />
        <div id="_bmi_result">
            <table>
                <tr>
                    <td colspan="2">
                        BMI :<?php echo ' ' . $Bmi_Bmr_Results['bmi']; ?>
                    </td>
                    <td colspan="2">
                        BMR :<?php echo ' ' . $Bmi_Bmr_Results['bmr']; ?> kcal /<?php echo ' ' . round(  ( $Bmi_Bmr_Results['bmr'] * 4.184 ), 0 ); ?> kJ
                    </td>
                </tr>
            </table>
        </div>
        <br />
        <div id="_bmi_condition">
            <?php
                $bmiForCondition      = $Bmi_Bmr_Results['bmi'];
                    $img_url              = Hbmibmrc_ROOT_URL . 'assets/frontEnd/img/tick_mark.png';
                    $bmiForConditionImage = "<img src='$img_url'/>";
                ?>
            <table>
                <tr>
                    <td>BMI Value</td>
                    <td colspan="2">YOUR BMI</td>
                </tr>
                <tr>
                    <td>Unter 18.5</td>
                    <td>Underweight</td>
                    <td>
                        <?php
                            if ( 18.4 >= $bmiForCondition ) {
                                    echo $bmiForConditionImage;
                                    $patient_condition = 'Underweight';
                                }
                            ?>
                    </td>
                </tr>
                <tr>
                    <td>18.5 -24.9</td>
                    <td>Normal weight</td>
                    <td>
                        <?php
                            if (  ( 18.5 <= $bmiForCondition ) && ( 24.9 >= $bmiForCondition ) ) {
                                    echo $bmiForConditionImage;
                                    $patient_condition = 'Normal weight';
                                }
                            ?>
                    </td>
                </tr>
                <tr>
                    <td>25.0 - 29.9</td>
                    <td>Slight overweight</td>
                    <td>
                        <?php
                            if (  ( 25.0 <= $bmiForCondition ) && ( 29.9 >= $bmiForCondition ) ) {
                                    echo $bmiForConditionImage;
                                    $patient_condition = 'Slight overweight';
                                }
                            ?>
                    </td>
                </tr>
                <tr>
                    <td>30.0 - 34.9</td>
                    <td>Overweight</td>
                    <td>
                        <?php
                            if (  ( 30.0 <= $bmiForCondition ) && ( 34.9 >= $bmiForCondition ) ) {
                                    echo $bmiForConditionImage;
                                    $patient_condition = 'Overweight';
                                }
                            ?>
                    </td>
                </tr>
                <tr>
                    <td>35.0 - 39.9</td>
                    <td>Considerable overweight</td>
                    <td>
                        <?php
                            if (  ( 35.0 <= $bmiForCondition ) && ( 39.9 >= $bmiForCondition ) ) {
                                    echo $bmiForConditionImage;
                                    $patient_condition = 'Considerable overweight';
                                }
                            ?>
                    </td>
                </tr>
                <tr>
                    <td>Over 40.0</td>
                    <td>Adipositas Grade III</td>
                    <td>
                        <?php
                            if ( 40.0 <= $bmiForCondition ) {
                                    echo $bmiForConditionImage;
                                    $patient_condition = 'Adipositas Grade III';
                                }
                            ?>
                    </td>
                </tr>
            </table>
        </div>
    <?php
        //Database Insert
            $data_height           = $_patient_height . ' ' . $_patient_height_unit;
            $data_weight           = $_patient_weight . ' ' . $_patient_weight_unit;
            $data_bmi              = $Bmi_Bmr_Results['bmi'];
            $data_bmr              = $Bmi_Bmr_Results['bmr'] . 'kcal / ' . round(  ( $Bmi_Bmr_Results['bmr'] * 4.184 ), 0 ) . 'kJ';
            $date                  = date( 'Y-m-d' );
            $bmi_bmr_result_insert = "INSERT INTO
            $table_name
            (patient_name,patient_gender,patient_age,patient_height,patient_weight,patient_bmi,patient_bmr,patient_condition,patient_date)
            VALUES
            ('$_patient_name','$_patient_gender','$_patient_age','$data_height','$data_weight','$data_bmi','$data_bmr','$patient_condition','$date')
            ";
            $wpdb->query( $bmi_bmr_result_insert );
        }
    ?>
</div>