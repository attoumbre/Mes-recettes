<?php

namespace Core\HTML;

class BootstrapForm extends Form
{
    /**
     * @param $html string Code HTML à entourer
     * @return string
     */
    protected function surround($html)
    {
        return "<div class=\"form-group\">{$html}</div>";
    }

    /**
     * @param $name string
     * @param $label
     * @param array $options
     * @return string
     */
    public function input($name, $label, $options = [])
    {
        // Valeur
        $valeur = (isset($options['valeur']) && $options['valeur'] != "") ? "value='" . $options['valeur'] . "'" : '';

        // Valeur Textarea
        $valeur_textarea = (isset($options['valeur_textarea']) && $options['valeur_textarea'] != "") ? $options['valeur_textarea'] : '';

        // Type
        $type = isset($options['type']) ? $options['type'] : 'text';

        // Class
        $class = isset($options['class']) ? $options['class'] : 'form-control';

        // Id
        $id = '';
        if (isset($options['id'])) {
            $id = 'id="' . $options['id'] . '"';
        }

        // Min_length
        $min_length = '';
        if (isset($options['min_length'])) {
            $min_length = 'minlength="' . $options['min_length'] . '"';
        }

        // Max_length
        $max_length = '';
        if (isset($options['max_length'])) {
            $max_length = 'maxlength="' . $options['max_length'] . '"';
        }

        // Min
        $min = '';
        if (isset($options['min'])) {
            $min = 'min="' . $options['min'] . '"';
        }

        // Max
        $max = '';
        if (isset($options['max'])) {
            $max = 'max="' . $options['max'] . '"';
        }

        // Step
        $step = '';
        if (isset($options['step'])) {
            $step = 'step="' . $options['step'] . '"';
        }

        // Placeholder
        $placeholder = '';
        if (isset($options['placeholder'])) {
            $placeholder = 'placeholder="' . $options['placeholder'] . '"';
        }

        // Required
        $required = '';
        if (isset($options['required']) && $options['required'] == true) {
            $required = 'required';
        }

        // Style
        $style = '';
        if (isset($options['style'])) {
            $style = 'style="' . $options['style'] . '"';
        }

        // Onclick
        $onclick = (isset($options['onclick']) && $options['onclick'] != "") ? "onclick='" . $options['onclick'] . "'" : '';

        // Onchange
        $onchange = '';
        if (isset($options['onchange'])) {
            $onchange = 'onchange="' . $options['onchange'] . '"';
        }

        // Label_class
        $label_class = isset($options['label_class']) ? $options['label_class'] : '';
        $label = '<label class="' . $label_class . '">' . $label . '</label>';

        // Accept file
        $accept_file = isset($options['accept_file']) ? "accept='" . $options['accept_file'] . "'" : '';


        // TextArea ou Input
        if ($type === 'textarea') {
            $input = '<textarea name="' . $name . '" class="' . $class . '" ' . $id . ' ' . $min_length . ' ' . $max_length . ' ' . $placeholder . ' ' . $style . ' ' . $onclick . ' ' . $onchange . ' ' . $required . '>' . $valeur_textarea . '</textarea>';
        } else {
            $input = '<input type="' . $type . '" name="' . $name . '" ' . $valeur . ' class="' . $class . '" ' . $id . ' ' . $min_length . ' ' . $max_length . ' ' . $min . ' ' . $max . ' ' . $step . ' ' . $placeholder . ' ' . $style . ' ' . $onclick . ' ' . $onchange . ' ' . $required . ' ' . $accept_file . '>';
        }

        // Surround
        if (isset($options['surround']) && $options['surround'] == false) {
            return $label . $input;
        }
        return $this->surround($label . $input);
    }


    public function select($name, $label, $options, $opt = [])
    {
        // Valeur
        $valeur = (isset($opt['valeur']) && $opt['valeur'] != "") ? $opt['valeur'] : '';

        // Label_class
        $label_class = isset($opt['label_class']) ? $opt['label_class'] : '';
        $label = '<label class="' . $label_class . '">' . $label . '</label>';

        // Class
        $class = isset($opt['class']) ? $opt['class'] : 'form-select';

        // Id
        $id = '';
        if (isset($opt['id'])) {
            $id = 'id="' . $opt['id'] . '"';
        }

        // Required
        $required = '';
        if (isset($options['required']) && $options['required'] == true) {
            $required = 'required';
        }

        // Onchange
        $onchange = '';
        if (isset($opt['onchange'])) {
            $onchange = 'onchange="' . $opt['onchange'] . '"';
        }

        // Data
        $data = [];
        if (isset($opt['data'])) {
            foreach ($opt['data'] as $key => $val) {
                $data2 = [];
                $nom_data = $key;
                foreach ($val as $val2) {
                    array_push($data2, "data-" . $nom_data . "='" . $val2 . "'");
                }
                $data += [$nom_data => $data2];
            }
        }


        // Construction du Select
        $input = '<select ' . $id . ' class="' . $class . '" name="' . $name . '" ' . $required . ' ' . $onchange . '>';
        $i = 0;
        foreach ($options as $k => $v) {
            if ((strlen($k) >= 7) && (substr($k, 0, 8) == "optgroup")) {
                $input .= "<optgroup label='$v'></optgroup>";
            } else {
                $attributes = '';
                if ($k == $valeur) {
                    $attributes = ' selected';
                }

                $data_value = "";
                foreach ($data as $d) {
                    $data_value .= $d[$i] . " ";
                }

                $input .= "<option " . $data_value . " value='$k'$attributes>$v</option>";
            }
            $i += 1;
        }
        $input .= '</select>';

        // Surround
        if (isset($opt['surround']) && $opt['surround'] == false) {
            return $label . $input;
        }
        return $this->surround($label . $input);
    }

    /**
     * @return string
     */
    public function submit()
    {
        return $this->surround('<button type="submit" class="btn btn-primary">Envoyer</button>');
    }

    public static function validate(array $form, array $fields)
    {
        // On parcourt chaque champ
        foreach ($fields as $field) {
            // Si le champ est absent ou vide dans le tableau
            if (!isset($form[$field]) || empty($form[$field])) {
                // On sort en retournant false
                return false;
            }
        }
        // Ici le formulaire est "valide"
        return true;
    }
}
