<?php
namespace App\Utils;

use Form;

/**
 * Class Template
 *
 * Classe Helper p/ Trabalhar com Formulários.
 *
 * @package App\Utils
 */
class Template
{

    private $_colWidth = 12;
    private $icon = null;

    /**
     * @param null $icon
     */

    public function title(string $title, array $buttons = []) : string
    {
        $btns = '';
        foreach($buttons as $route => $label){
            $params = [];
            if(is_array($label)){
                $params = array_slice($label, 1);
                $label = $label[0];
            }
            $btns .= '<a class="btn btn-primary pull-right" href="'.route($route, $params).'">'.$label.'</a>';
        }
        return '
            <div class="row">
                <section class="col-md-12 content-header">
                    '.($btns ? '<h1 class="pull-left">'.$title.'</h1><h1 class="pull-right">'.$btns.'</h1>' :'<h1>'.$title.'</h1>').'
                </section>
            </div>
        ';
    }

    public function editBtn(string $route, array $params = []) : string
    {
        return '<a href="'.route($route, $params).'" class="btn btn-xs btn-mini btn-primary"><i class="icofont icofont-ui-edit"></i> Edit</a>';
    }

    public function deleteBtn(string $route, array $params = [], $msg = null) : string
    {
        if (is_null($msg)) {
            $msg = 'Are you sure?';
        }
        array_unshift($params, $route);
        return '
            '.Form::open(['route' => $params, 'method' => 'delete', 'style' => 'display:inline']).'
                <button type="submit"
                    class="swa-confirm btn btn-xs btn-mini btn-danger"
                    data-swa-btn-txt="Yes"
                    data-swa-title="Confirm"
                    data-swa-text="'.$msg.'"
                    >
                Delete
                </button>
            '.Form::close().'
        ';
    }

    public function colWidth($width = 12) : \App\Utils\Template
    {
        $this->_colWidth = $width;
        return $this;
    }

    public function formOpen($route, $files = false, $model = null, $params = []) : string
    {
        $class = 'row';
        if (isset($params['class'])) {
            $class = $params['class'];
            unset($params['class']);
        }
        $params = array_merge($params, ['route' => $route, 'files' => $files, 'class' => $class]);
        return Form::model($model, $params);
    }

    public function formClose() : string
    {
        return Form::close();
    }

    public function formHeading($name = '')
    {
        return '
            <div class="col-md-'.$this->_colWidth.'">
                <h5>'.$name.'</h5>
            </div>
        ';
    }

    public function formInput($name, $label, $isRequired = false, $helpBlockTxt = '', $optAttr = array()) : string
    {
        return $this->_drawInput('text', $name, $label, $isRequired, $helpBlockTxt, $optAttr);
    }

    public function formEmail($name, $label, $isRequired = false, $helpBlockTxt = '', $optAttr = array()) : string
    {
        return $this->_drawInput('email', $name, $label, $isRequired, $helpBlockTxt, $optAttr);
    }

    public function formDate($name, $label, $isRequired = false, $helpBlockTxt = '', $optAttr = array(), $customVal = null) : string
    {
        return $this->_drawInputDate($name, $label, $isRequired, $helpBlockTxt, $optAttr, $customVal);
    }

    public function formTextarea($name, $label, $isRequired = false, $helpBlockTxt = '', $optAttr = array())
    {
        return $this->_drawInput('textarea', $name, $label, $isRequired, $helpBlockTxt, $optAttr);
    }

    public function formSelect($name, $label, $options, $attributes = ['class' => 'form-control'], $helpBlockTxt = '', $selectedVals = null)
    {
        return $this->_drawSelect($name, $label, $options, $attributes, $helpBlockTxt, $selectedVals);
    }

    public function formPassword($name, $label, $isRequired = false, $helpBlockTxt = '', $optAttr = array()) : string
    {
        return $this->_drawInput('password', $name, $label, $isRequired, $helpBlockTxt, $optAttr);
    }

    public function formCheckbox($name, $label, $checkedValue = 'checked', $checked = null) : string
    {

        $rand_1 = rand(1, 500);
        $label_name = $name . '_' . $rand_1;
        return '
            <!-- /** '. $name .' **/ -->
            <div class="form-group col-md-'.$this->_colWidth.'">
                <div class="checkbox">
                ' . Form::checkbox($name, $checkedValue, $checked, ['id' => $label_name]). '
                ' . Form::label($label_name, $label) . '                    
                </div>
            </div>
        ';
    }

    public function formSubmit(string $label = 'Salvar', $class = '') : string
    {
        return '
         <div class="col-md-'.$this->_colWidth.'">
            <button type="submit" class="btn btn-primary  waves-effect waves-light '. $class .'">
                <i class="icofont icofont-save"></i> '.$label.'
            </button>
         </div>   
        ';
    }

    private function _drawSelect($name, $label, $options, $attributes, $isRequired = false, $helpBlockTxt = '', $values = null)
    {
        $labelCls = $isRequired ? 'is-required' : '';
        $error = $this->_getInputError($name);
        $errorCls = $error ? 'form-control-danger' : '';
        $help_block = $this->_getHelpBlock($helpBlockTxt);
        $default_value = array_key_exists('v-model', $attributes) ? '' : $values;
        return '
            <!-- /** '. $name .' **/ -->
            <div class="form-group col-md-'.$this->_colWidth.' '.$errorCls.'">
                '.Form::label($name, $label, ['class' => $labelCls]).'
                '.Form::select($name, $options, $default_value, $attributes).' 
                 '. $help_block .'  
                 '. $error.'
            </div>
        ';
    }
    private function _drawInputDate($name, $label, $isRequired = false, $helpBlockTxt = '', $optAttr = array(), $customVal = null) : string
    {
        $labelCls = $isRequired ? 'is-required' : '';
        $inputRequired = $isRequired ? 'required' : '';
        $error = $this->_getInputError($name);
        $errorCls = $error ? 'form-control-danger' : '';
        $help_block = $this->_getHelpBlock($helpBlockTxt);
        $attributes = array_merge(['class' => 'form-control pull-right', $inputRequired], $optAttr);
        return '
        <!-- /** '. $name .' **/ -->
        <div class="form-group col-md-'.$this->_colWidth.' '.$errorCls.'">
            '.Form::label($name, $label, ['class' => $labelCls]).'
            '. Form::date($name, $customVal, $attributes) .'
             '. $help_block .'
              '. $error .'
        </div>';
    }
    private function _drawInput($type, $name, $label, $isRequired = false, $helpBlockTxt = '', $optAttr = array()) : string
    {
        $labelCls = $isRequired ? 'is-required' : '';
        $inputRequired = $isRequired ? 'required' : '';
        $error = $this->_getInputError($name);
        $errorCls = $error ? 'form-control-danger' : '';
        $help_block = $this->_getHelpBlock($helpBlockTxt);
        $attributes = array_merge(['class' => 'form-control ' . $inputRequired, $inputRequired], $optAttr);
        $attributes = array_filter($attributes, 'strlen');
        // remove valor quando estiver com o vuejs
        $default_value = array_key_exists('v-model', $optAttr) ? '' : null;
        $input_group_start = '';
        $input_group_end = '';
        $form_label = Form::label($name, $label, ['class' => $labelCls]);
        $input = ($type != 'password') ?  Form::{$type}($name, $default_value, $attributes) : Form::{$type}($name, $attributes);

        return '
            <!-- /** '. $name .' **/ -->
            <div class="form-group col-md-'.$this->_colWidth.' '.$errorCls.'">
                '.$input_group_start.'
                '.$form_label.'
                '.$input.'
                '. $help_block .'
                '. $error .'
                '.$input_group_end.'
            </div>
        ';
    }

    private function _getInputError($name)
    {
        $errors = session()->get('errors');
        if(!$errors){
            return null;
        }
        $error = $errors->first($name);
        return $error ? '<div class="col-form-label">'.$error.'</div>' : null;
    }

    private function _getHelpBlock($text)
    {
        if (!empty($text)) {
            $str  = '<span class="help-block">';
            $str .= $text;
            $str .= '</span>';
            return $str;
        }
        return '';
    }

}