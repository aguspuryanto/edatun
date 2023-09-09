<?php


function is_logged_in($role = false)
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    }

    if ($role) {
        $role_id = $ci->session->userdata('role_id');

		if($role_id != $role) {
			redirect('auth/blocked');
		}
    }
}

function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

function get_form_input($model, $field="", $options=array()) {
    $attributes = array('class' => 'form-control', 'id' => 'input-' .  $field);

    if ($options) {
        foreach($options as $key => $val) {
            $attributes[$key] = $val;
        }
    }
    // echo json_encode($attributes);

    $key = array_search($field, array_column($model->rules(), 'field'));
    if($key >= 0) {
        $form = '<div class="form-group">
        <label>' . form_label($model->rules()[$key]['label']) . '</label>';

        if(isset($attributes['type']) && $attributes['type'] === 'textarea') {
            if ($field) $attributes['name'] = $field;
            $form .= form_textarea($attributes);

        } elseif(isset($attributes['type']) && $attributes['type'] === 'password') {
            $form .= form_input($attributes);

        } elseif(isset($attributes['type']) && $attributes['type'] === 'file') {
            $form .= form_input($attributes);

        } else {
            $form .= form_input($field, '', $attributes);
        }

        $form .= '<div id="error"></div>
        </div>';
        
        return $form;
    }
}
