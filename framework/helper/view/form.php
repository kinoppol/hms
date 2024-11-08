<?php

function form_gen_select($id, $name, $selection, $default_selection)
{
    echo('<select class="form-select" id="'.$id.'" aria-label="Default" name="'.$name.'">');
    echo form_gen_option($selection, $default_selection);
    echo('</select>');
}

function form_gen_option($selection, $default_selection){
    $ret='';
    foreach ($selection as $key => $value) {
        $is_selected = ($value == $default_selection) ? 'selected' : '';
        $ret.='<option value="'.$key.'" '.$is_selected.'>'.$value.'</option>';
    }
    return $ret;
}