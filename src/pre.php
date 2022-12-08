<?php
/**
 * Created by PhpStorm.
 * User: kuno
 * Date: 08.12.2022
 * Time: 06:24
 */

namespace kriit24;

/*
 * USAGE
 * pre(array);
 * pre(object);
 * pre(string);
 * pre(array, console_style);
 * pre('note', array, console_style);
 */

function pre($array, $style = null, $style_2 = null)
{
    $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1);//this is for finding pre
    //$backtrace = [];//this is for live
    $shell = (php_sapi_name() == 'cli' ? true : false);


    $trace = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 1);
    $vLine = file( $trace[0]['file'] );
    $fLine = $vLine[ $trace[0]['line'] - 1 ];
    preg_match( "#\\$(\w+)#", $fLine, $match );
    $variable = isset($match[0]) ? $match[0] : '';

    if (!is_array($array) && !is_object($array) && (is_array($style) || is_object($style))) {

        $array .= ':"'.$variable.'"';
    }
    else if (!is_array($array) && !is_object($array) && !is_array($style) && !is_object($style)) {

        $array = $variable . ':"'.$array.'"';
    }
    else{

        $tmp = $array;
        $array = '"'.$variable.'"';
        $style = $tmp;
    }

    if (!is_array($array) && !is_object($array) && (is_array($style) || is_object($style))) {

        if ($shell) {

            if (is_array($style)) {

                echo $array . "\t";
                echo(!empty($backtrace) ? "\n" . 'pre@' . $backtrace[0]['file'] . ':' . ($backtrace[0]['line'] ?? '') . "\n\n" : '');
                print_r(array_map(function ($value) {

                    if (gettype($value) == 'string' && !is_numeric($value)) {

                        return "'" . $value . "'";
                    }
                    return $value;
                }, $style));

            }
            else {

                echo $array . "\t";
                echo(!empty($backtrace) ? '<br>pre@' . $backtrace[0]['file'] . ':' . ($backtrace[0]['line'] ?? '') . "\n\n" : '');
                print_r($style);
            }
            return;
        }

        print '<pre style="text-align:left;' . $style_2 . '">';
        if (is_array($style)) {

            echo $array . "\t";
            echo(!empty($backtrace) ? '<br>pre@' . $backtrace[0]['file'] . ':' . ($backtrace[0]['line'] ?? '') . '<br><br>' : '');
            print_r(array_map(function ($value) {

                if (gettype($value) == 'string' && !is_numeric($value)) {

                    return "'" . $value . "'";
                }
                return $value;
            }, $style));

        }
        else {

            echo $array . "\t";
            echo(!empty($backtrace) ? '<br>pre@' . $backtrace[0]['file'] . ':' . ($backtrace[0]['line'] ?? '') . '<br><br>' : '');
            print_r($style);
        }
        print '</pre>';
    }
    elseif (!is_array($array) && !is_object($array)) {

        if ($shell) {

            echo (!empty($backtrace) ? 'pre@' . $backtrace[0]['file'] . ':' . ($backtrace[0]['line'] ?? '') . "\n\n" : '') . $array . "\n";
            return;
        }

        echo '<pre style="text-align:left;' . $style . '">' . (!empty($backtrace) ? 'pre@' . $backtrace[0]['file'] . ':' . ($backtrace[0]['line'] ?? '') . '<br><br>' : '') . $array . '</pre>';
    }
    else {

        if ($shell) {

            if (is_array($array)) {

                echo(!empty($backtrace) ? "\n" . 'pre@' . $backtrace[0]['file'] . ':' . ($backtrace[0]['line'] ?? '') . "\n\n" : '');
                print_r(array_map(function ($value) {

                    if (gettype($value) == 'string' && !is_numeric($value)) {

                        return "'" . $value . "'";
                    }
                    return $value;
                }, $array));

            }
            else {

                echo(!empty($backtrace) ? '<br>pre@' . $backtrace[0]['file'] . ':' . ($backtrace[0]['line'] ?? '') . "\n\n" : '');
                print_r($array);
            }
            return;
        }

        print '<pre style="text-align:left;' . $style . '">';
        if (is_array($array)) {

            echo(!empty($backtrace) ? '<br>pre@' . $backtrace[0]['file'] . ':' . ($backtrace[0]['line'] ?? '') . '<br><br>' : '');
            print_r(array_map(function ($value) {

                if (gettype($value) == 'string' && !is_numeric($value)) {

                    return "'" . $value . "'";
                }
                return $value;
            }, $array));

        }
        else {

            echo(!empty($backtrace) ? '<br>pre@' . $backtrace[0]['file'] . ':' . ($backtrace[0]['line'] ?? '') . '<br><br>' : '');
            print_r($array);
        }
        print '</pre>';
    }
}